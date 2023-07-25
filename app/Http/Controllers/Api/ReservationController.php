<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\ReservationsByResource;
use App\Models\Balance;
use App\Models\Reservation;
use App\Models\ReservationTime;
use App\Models\Resource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function reserve(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'pricing_option' => ['required', 'in:price_by_hour,price_by_day,price_by_weak,price_by_month'],
            'pricing_input' => ['required', 'integer', 'min:1'],
            'start_date' => ['required', 'date', 'after_or_equal:now'],
            'resource_id' => ['required', 'exists:resources,id'],
            'payment_method_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        } else {
            $pricingOption = $request->input('pricing_option');
            $pricingInput = $request->input('pricing_input');

            $resource = Resource::find($request->input('resource_id'));
            $cost = $this->calculateReservationCost($resource, $pricingOption, $pricingInput);

            $reservation = new Reservation();
            $reservation->name = $request->input('name');
            $reservation->added_by = auth()->id();
            $reservation->resource_id = $request->input('resource_id');
            $reservation->payment_method_id = $request->input('payment_method_id');
            $reservation->user_id = auth()->id();

            $reservationTime = new ReservationTime();
            $reservationTime->start_time = $request->input('start_date');
            $reservationTime->end_time = $this->calculateEndDate($request->input('start_date'), $pricingOption,
                $pricingInput);
            $reservationTime->cost = $cost;

            $existingReservations = checkConflict($reservation, $reservationTime);

            if ($existingReservations->count() > 0) {
                $message = isArabicLang($request) ? 'تاريخ الحجز الجديد يتداخل مع حجوزات أخرى. الرجاء اختيار تاريخ آخر'
                    : 'The new reservation date overlaps with other reservations. Please choose another date';
                return response()->json([
                    'message' => $message,
                ], UNPROCESSABLE_CONTENT);

            } else {
                $reservation->save();
                $reservationTime->reservation_id = $reservation->id;
                $reservationTime->save();
                Balance::query()->create([
                    'amount' => $cost,
                    'sender_id' => auth()->id(),
                    'receiver_id' => get_setting(ADMIN_ID),
                    'currency_id' => get_setting('site_currency_id'),
                    'description' => 'Reservation Cost',
                    'payment_type' => 'resource',
                    'payment_id' => $request->resource_id,
                ]);

                User::where('id', auth()->id())->decrement('balance', $cost);
                User::where('id', get_setting(ADMIN_ID))->increment('balance', $cost);

                $message = isArabicLang($request) ? 'تم الاضافة بنجاح' : 'Added successfully';
                return response()->json([
                    'message' => $message,
                    'data' => [
                        'id' => $reservation->id,
                        'name' => $reservation->name,
                        'added_by' => $reservation->added_by,
                        'resource_id' => $reservation->resource_id,
                        'payment_method_id' => $reservation->payment_method_id,
                        'user_id' => $reservation->user_id,
                        'cost' => $cost,
                        'updated_at' => $reservation->updated_at,
                        'created_at' => $reservation->created_at,
                    ],
                ]);

            }

        }
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

    public function cancelReservation(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'reservation_id' => ['required', 'exists:reservations,id'],
        ]);

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        } else {
            $user = auth()->id();
            $reservation = Reservation::find($request->input('reservation_id'));
            $siteCurrencyId = get_setting('site_currency_id');
            $cost = $reservation->costReservationTimes();

            if ($reservation && $reservation->user_id == $user) {

                if ($reservation->isCanceled()) {

                    $message = isArabicLang($request) ? 'لقد تم الغاء الحجز بالفعل' : 'Reservation already cancelled!';
                    return response()->json([
                        'message' => $message,
                    ], UNPROCESSABLE_CONTENT);

                } elseif ($reservation->isFinished()) {

                    $message = isArabicLang($request) ? 'لا يمكنك اجراء هذه العملية لان الحجز قد انتهى بالفعل' : 'You cannot perform this operation because the reservation has already expired';
                    return response()->json([
                        'message' => $message,
                    ], UNPROCESSABLE_CONTENT);

                } else {
                    (Reservation::query()->where('id', $reservation->id)->update(['status' => Reservation::CANCELED]));
                    Balance::query()->create([
                        'amount' => $cost * -1,
                        'sender_id' => get_setting(ADMIN_ID),
                        'receiver_id' => auth()->id(),
                        'currency_id' => $siteCurrencyId,
                        'description' => 'Reservation Canceled',
                        'payment_type' => 'resource',
                        'payment_id' => $reservation->resource->id,
                    ]);

                    User::where('id', $reservation->user_id)->increment('balance', $cost);
                    User::where('id', get_setting(ADMIN_ID))->decrement('balance', $cost);

                    $message = isArabicLang($request) ? 'تم الغاء الحجز بنجاح' : 'Reservation cancelled Successfuly';
                    return response()->json([
                        'message' => $message,
                    ], OK);
                }
            } else {
                $message = isArabicLang($request) ? 'الحجز غير موجود او غير مصرح للمستخدم' : 'Reservation not found or unauthorized';
                return response()->json([
                    'message' => $message,
                ], UNPROCESSABLE_CONTENT);
            }
        }
    }

    public function getUserReservations(): JsonResponse
    {
        $user = auth()->user();

        $reservations = ReservationResource::collection($user->reservations->reverse());

        return response()->json([
            'data' => $reservations,
        ]);
    }

    public function resourceReservations(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'resource_id' => ['required', 'exists:resources,id'],
        ]);

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }

        $resourceId = $request->input('resource_id');
        $reservations = Reservation::where('resource_id', $resourceId)->get();

        $reservationResource = ReservationsByResource::collection($reservations);

        return $reservationResource;
    }

    public function handleErrors($validator): JsonResponse
    {
        return response()->json([
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors(),
        ], UNPROCESSABLE_CONTENT);
    }

}
