<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\ReservationTime;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ReservationTimeController extends Controller
{

    public function destroy($id): JsonResponse
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

    public function cancel($id)
    {
        try {
            $reservationTime = ReservationTime::find($id);
            if ($reservationTime) {
                if ($reservationTime->isCanceled()) {
                    return response()->json([
                        'status' => 'warning',
                        'message' => translate('messages.AlreadyCanceled'),
                    ]);
                } elseif ($reservationTime->isFinished()) {
                    return response()->json([
                        'status' => 'warning',
                        'message' => translate('messages.DontCancelFinished'),
                    ]);
                } else {

                    if (ReservationTime::query()->where('id', $id)->update(['status' => 0])) {
                        if ($reservationTime->reservation->isHasUser) {
                            Balance::query()->create([
                                'amount' => $reservationTime->cost * -1,
                                'sender_id' => get_setting(ADMIN_ID),
                                'receiver_id' => $reservationTime->reservation->user_id,
                                'currency_id' => get_setting('site_currency_id'),
                                'description' => 'Reservation Canceled',
                                'payment_type' => 'resource',
                                'payment_id' => $reservationTime->reservation->resource->id,
                            ]);

                            User::where('id', $reservationTime->reservation->user_id)->increment('balance',
                                $reservationTime->cost);
                            User::where('id', get_setting(ADMIN_ID))->decrement('balance',
                                $reservationTime->cost);
                        }

                        return response()->json([
                            'status' => 'success',
                            'message' => translate('messages.Canceled'),
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('messages.not_found'),
                ]);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => $this->error(),
            ]);
        }
    }

    public function error(
        $message = null
    ): RedirectResponse{
        flash(translate($message ?? 'messages.Wrong'))->error();
        return back();
    }
}
