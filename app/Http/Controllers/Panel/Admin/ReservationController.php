<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Course;
use App\Models\PaymentMethod;
use App\Models\Reservation;
use App\Models\ReservationTime;
use App\Models\Resource;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\VerifiedReservationPaymentNotification;
use App\Rules\AvailableStartDateRule;
use App\Services\ReservationService;
use Carbon\Carbon;
use Exception;
use http\Env\Response;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Throwable;

class ReservationController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->middleware('permission:'.RESERVATIONS_PERMISSION)->only('index');
        $this->middleware('permission:'.CREATE_RESERVATION_PERMISSION)->only('create', 'store');
        $this->middleware('permission:'.READ_RESERVATION_PERMISSION)->only('show');
        $this->middleware('permission:'.UPDATE_RESERVATION_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:'.DELETE_RESERVATION_PERMISSION)->only('destroy', 'deleteSelected',
            'destroyFromCalendar', 'destroyShow');
        $this->middleware('permission:'.CANCEL_RESERVATION_PERMISSION)->only('cancel');
        $this->middleware('permission:'.VERIFY_PAYMENT_RESERVATION_PERMISSION)->only('verifiedReservationPayment');
        $this->reservationService = $reservationService;
    }

    public function index(): Factory|View|Application
    {
        if (request()->has('keyword')) {
            $reservations = Reservation::where('name', 'like', '%'.request()->keyword.'%')->orderByDesc('id')->paginate(10);
        } else {
            $reservations = Reservation::orderByDesc('id')->get();
        }
        $resources = Resource::orderByDesc('id')->get();
        $users = User::typeUser()->orderByDesc('id')->get();
        $payment_methods = PaymentMethod::orderByDesc('id')->pluck('id', 'name');
        $courses = Course::orderByDesc('id')->pluck('id', 'name');

        return view('admin.dashboard.reservations.index',
            compact('reservations', 'resources', 'users', 'payment_methods', 'courses'));
    }


    public function create(): RedirectResponse
    {
        return back();
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->reservationService->store($request);
    }

    public function show($id): Factory|View|Application
    {
        $reservation = Reservation::findOrFail($id);
        $resources = Resource::orderByDesc('id')->get();
        $reservationTimes = $reservation->reservationTimes;
        return view('admin.dashboard.reservations.show', compact('reservation', 'resources', 'reservationTimes'));
    }


    public function edit($id): RedirectResponse
    {
        return back();
    }


    public function update(Request $request, $id): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:now'],
        ]);


        if ($validator->fails()) {
            return $this->error();
        }


        try {
            $reservation = Reservation::find($id);

            $oldStartDate = $reservation->start_date;
            $oldEndDate = $reservation->end_date;
            $newStartDate = $request->start_date;

            $timeDifference = Carbon::parse($oldStartDate)->diff(Carbon::parse($oldEndDate));
            $newEndDate = Carbon::parse($newStartDate)->add($timeDifference);


            $conflictingReservations = Reservation::where(function ($query) use ($newStartDate, $newEndDate) {
                $query->whereBetween('start_date', [$newStartDate, $newEndDate])
                    ->orWhereBetween('end_date', [$newStartDate, $newEndDate])
                    ->orWhere(function ($query) use ($newStartDate, $newEndDate) {
                        $query->where('start_date', '<', $newStartDate)
                            ->where('end_date', '>', $newEndDate);
                    });
            })->where('id', '<>', $id)->get();

            if ($request->resource_id) {
                $conflictingReservations = Reservation::where(function ($query) use ($newStartDate, $newEndDate) {
                    $query->whereBetween('start_date', [$newStartDate, $newEndDate])
                        ->orWhereBetween('end_date', [$newStartDate, $newEndDate])
                        ->orWhere(function ($query) use ($newStartDate, $newEndDate) {
                            $query->where('start_date', '<', $newStartDate)
                                ->where('end_date', '>', $newEndDate);
                        });
                })->where('id', '<>', $id)->where('resource_id', '=', $request->resource_id)->get();
            }
            if ($conflictingReservations->isNotEmpty()) {
                flash(translate('messages.Overlaps'))->error();
                return back()->withInput();
            }


            $updateData = [
                'name' => $request->name,
                'start_date' => $newStartDate,
                'end_date' => $newEndDate,
            ];

            if ($request->resource_id) {
                $updateData['resource_id'] = $request->resource_id;
            }

            if ($request->user_id) {
                $updateData['user_id'] = $request->user_id;
            }

            if ($reservation->update($updateData)) {
                flash(translate('messages.Updated'))->success();
            }
            return back();
        } catch (Exception) {
            return $this->error();
        }
    }

    public function array_push_assoc($array, $key, $value)
    {
        $array[$key] = $value;
        return $array;
    }

    public function destroyFromCalendar($id): JsonResponse
    {
        try {
            $reservationTime = ReservationTime::find($id);

            if ($reservationTime) {
                if ($reservationTime->isPending()) {
                    return response()->json([
                        'status' => 'warning',
                        'message' => translate('messages.DonotDeleteBeforeCancelReservation')
                    ]);
                }
                if ($reservationTime->isCanceled() || $reservationTime->isFinished()) {
                    $reservationTime->delete();
                    return response()->json([
                        'status' => 'success',
                        'message' => translate('messages.Deleted')
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => translate('messages.DonotDeleteBeforeCancelReservation')
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('messages.not_found')
                ]);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => $this->error()
            ]);
        }
    }


    public function destroy($id): JsonResponse
    {
        try {
            $reservation = Reservation::find($id);

            if ($reservation) {
                if ($reservation->isPending()) {
                    return response()->json([
                        'status' => 'warning',
                        'message' => translate('messages.DonotDeleteBeforeCancelReservation')
                    ]);
                }
                if ($reservation->isCanceled() || $reservation->isFinished()) {
                    $reservation->delete();
                    return response()->json([
                        'status' => 'success',
                        'message' => translate('messages.Deleted')
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => translate('messages.DonotDeleteBeforeCancelReservation')
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('messages.not_found')
                ]);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => $this->error()
            ]);
        }
    }


    public function destroyShow($id): RedirectResponse
    {
        try {
            $reservation = Reservation::find($id);

            if ($reservation) {
                if ($reservation->status == Reservation::CANCELED || $reservation->isFinished()) {
                    $reservation->delete();
                    flash(translate('messages.Deleted'))->success();
                } else {
                    flash(translate('messages.DonotDeleteBeforeCancelReservation'))->error();
                }
            }
            return redirect(route('reservations.index'));
        } catch (Exception) {
            return $this->error();
        }
    }

    public function cancel($id)
    {
        try {
            $reservation = Reservation::find($id);
            $siteCurrencyId = get_setting('site_currency_id');
            if ($reservation->isCanceled()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => translate('messages.AlreadyCanceled')
                ]);
            } elseif ($reservation->isFinished()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => translate('messages.DontCancelFinished')
                ]);
            } else {
                if (Reservation::query()->where('id', $id)->update(['status' => Reservation::CANCELED])) {
                    $reservation->reservationTimes()->update(['status' => 0]);
                    if($reservation->isHasUser) {
                        Balance::query()->create([
                            'amount' => $reservation->costReservationTimesWithoutFinished() * -1,
                            'sender_id' => get_setting(ADMIN_ID),
                            'receiver_id' => $reservation->user_id,
                            'currency_id' => $siteCurrencyId,
                            'description' => 'Reservation Canceled',
                            'payment_type' => 'resource',
                            'payment_id' => $reservation->resource->id
                        ]);

                        User::where('id', $reservation->user_id)->increment('balance',
                            $reservation->costReservationTimes());
                        User::where('id', get_setting(ADMIN_ID))->decrement('balance',
                            $reservation->costReservationTimes());
                    }

                    return response()->json([
                        'status' => 'success',
                        'message' => translate('messages.Canceled')
                    ]);
                }
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => $this->error()
            ]);
        }
    }

    public function error(): RedirectResponse
    {
        flash(translate('messages.Wrong'))->error();
        return back();
    }

    public function deleteSelected(Request $request)
    {
        try {
            $selectedData = $request->selectedData;
            $deletedReservations = [];
            $notDeletedReservations = [];
            foreach ($selectedData as $id) {
                $reservation = Reservation::find($id);
                if ($reservation) {
                    if ($reservation->status == Reservation::CANCELED || $reservation->isFinished()) {
                        $deletedReservations[$reservation->id] = $reservation->name;
                        $reservation->delete();
                    } else {
                        $notDeletedReservations[$reservation->id] = $reservation->name;
                    }
                }
            }
            return Response()->json([
                'message' => [
                    'deletedReservations' => $deletedReservations,
                    'notDeletedReservations' => $notDeletedReservations,
                ]
            ]);
        } catch (Exception $ex) {
            return $this->error();
        }

    }


    public function verifiedReservationPayment($id): JsonResponse
    {
        try {
            $reservation = Reservation::find($id);
            if ($reservation) {
                if ($reservation->is_verified_payment) {
                    return Response()->json([
                        'status' => 'error',
                        'message' => translate('messages.cannotPayThePaidReservation')
                    ]);
                } elseif ($reservation->isCanceled() || $reservation->isFinished()) {
                    return Response()->json([
                        'status' => 'error',
                        'message' => translate('messages.cannotPayThePaidReservation')
                    ]);
                } else {
                    $reservation->update(['is_verified_payment' => 1]);
                    if ($reservation->user_id) {
                        $user = User::find($reservation->user_id);
                        $user->notify(new VerifiedReservationPaymentNotification($reservation));
                    }
                    return Response()->json([
                        'status' => 'success',
                        'message' => translate('messages.reservationHasBeenSuccessfullyPaid')
                    ]);
                }
            }

            return Response()->json([
                'status' => 'error',
                'message' => 'Not Found',
            ], 404);
        } catch (Exception $e) {
            return Response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}

