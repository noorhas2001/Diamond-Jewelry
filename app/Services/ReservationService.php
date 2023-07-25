<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\ReservationTime;
use App\Models\Resource;
use App\Models\Balance;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReservationService
{
    public function store($request): RedirectResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            $request->input('pricing_option').'_input' => 'required|integer|min:1',
            'start_date' => ['required', 'date', 'after_or_equal:now'],
            'user_id' => 'required',
            'payment_method_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $pricingOption = $request->input('pricing_option');
            $pricingInput = $request->input($pricingOption.'_input');

            $resource = Resource::findOrFail($request->input('resource_id'));
            $cost = $this->calculateReservationCost($resource, $pricingOption, $pricingInput);

            $reservation = new Reservation();
            $reservation->name = $request->input('name');
            $reservation->added_by = auth()->id();
            $reservation->resource_id = $request->input('resource_id');
            $reservation->user_id = $request->input('user_id');
            $reservation->isHasUser = ($reservation->user_id !== null);
            $reservation->payment_method_id = $request->input('payment_method_id');

            $reservationTime = new ReservationTime();
            $reservationTime->start_time = $request->input('start_date');
            $reservationTime->end_time = $this->calculateEndDate($request->input('start_date'), $pricingOption, $pricingInput);
            $reservationTime->cost = $cost;

            $existingReservations = checkConflict($reservation, $reservationTime);

            if ($existingReservations->count() > 0) {
                flash(translate('messages.Overlaps'))->error();
                return redirect()->back();
            }

            $reservation->save();
            $reservationTime->reservation_id = $reservation->id;
            $reservationTime->save();
            Balance::query()->create([
                'amount' => $cost,
                'sender_id' => $request->user_id,
                'receiver_id' => get_setting(ADMIN_ID),
                'currency_id' => get_setting('site_currency_id'),
                'description' => 'Reservation cost',
                'payment_type' => 'resource',
                'payment_id' => $resource->id
            ]);

            User::where('id', $request->user_id)->decrement('balance', $cost);
            User::where('id', get_setting(ADMIN_ID))->increment('balance', $cost);
            flash(translate('messages.Added'))->success();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
            return $this->error();
        }

        return redirect()->back();
    }

    private function calculateReservationCost(Resource $resource, string $pricingOption, int $pricingInput): float
    {
        $hourPrice = $resource->price_by_hour;
        $dayPrice = $resource->price_by_day;
        $weekPrice = $resource->price_by_weak;
        $monthPrice = $resource->price_by_month;

        switch ($pricingOption) {
            case 'price_by_hour':
                return $pricingInput * $hourPrice;
            case 'price_by_day':
                return $pricingInput * $dayPrice;
            case 'price_by_weak':
                return $pricingInput * $weekPrice;
            case 'price_by_month':
                return $pricingInput * $monthPrice;
            default:
                return 0.0;
        }
    }

    private function calculateEndDate(string $startDate, string $pricingOption, int $pricingInput): string
    {
        $startDate = Carbon::parse($startDate);

        switch ($pricingOption) {
            case 'price_by_hour':
                return $startDate->addHours($pricingInput);
            case 'price_by_day':
                return $startDate->addDays($pricingInput);
            case 'price_by_weak':
                return $startDate->addWeeks($pricingInput);
            case 'price_by_month':
                return $startDate->addMonths($pricingInput);
            default:
                return $startDate;
        }
    }

    public function error(): RedirectResponse
    {
        flash(translate('messages.Wrong'))->error();
        return back();
    }
}
