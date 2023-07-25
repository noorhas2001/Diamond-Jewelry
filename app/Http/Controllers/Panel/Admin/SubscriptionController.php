<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Notifications\VerifiedSubscriptionPaymentNotification;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Course;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:'.SUBSCRIPTIONS_PERMISSION)->only('index');
        $this->middleware('permission:'.CREATE_SUBSCRIPTION_PERMISSION)->only('create', 'store');
        $this->middleware('permission:'.READ_SUBSCRIPTION_PERMISSION)->only('show');
        $this->middleware('permission:'.UPDATE_SUBSCRIPTION_PERMISSION)->only('edit', 'update');
        $this->middleware('permission:'.DELETE_SUBSCRIPTION_PERMISSION)->only('destroy', 'destroyShow');
        $this->middleware('permission:'.CANCEL_SUBSCRIPTION_PERMISSION)->only('cancel');
        $this->middleware('permission:'.VERIFY_PAYMENT_SUBSCRIPTION_PERMISSION)->only('verifiedSubscriptionPayment');
    }


    public function index(): Factory|View|Application
    {
        $subscriptions = Subscription::orderByDesc('id')->get();
        $courses = Course::orderByDesc('id')->pluck('id', 'name');
        $users = User::typeUser()->orderByDesc('id')->get();

        return view('admin.dashboard.subscriptions.index', compact('subscriptions', 'courses', 'users'));
    }


    public function show($id): Factory|View|Application
    {
        $subscription = Subscription::findOrFail($id);
        $courses = Course::orderByDesc('id')->pluck('id', 'name');
        $users = User::typeUser()->orderByDesc('id')->get();
        return view('admin.dashboard.subscriptions.show', compact('subscription', 'courses', 'users'));
    }


    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [

            'price' => ['required'],
        ]);
        if ($validator->fails()) {
            return $this->error();
        }

        $basePrice = Course::query()->where('id', $request->input('course_id'))->pluck('price')->first();

        if ($request->input('price') == $basePrice) {
            $isBasePrice = true;
        } else {
            $isBasePrice = false;
        }

        try {
            $subscription = Subscription::find($id);
            if ($subscription->update([
                'price' => $request->price,
                'isBasePrice' => $isBasePrice,
            ])) {
                flash(translate('messages.Updated'))->success();
            }
            return back();
        } catch (Exception) {
            return $this->error();
        }
    }


    public function create(): RedirectResponse
    {
        return back();
    }


    public function edit($id): RedirectResponse
    {
        return back();
    }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => ['required'],
            'course_id' => ['required'],
            'price' => ['required'],
        ]);

        $basePrice = Course::query()->where('id', $request->input('course_id'))->pluck('price')->first();

        if ($request->input('price') == $basePrice) {
            $isBasePrice = true;
        } else {
            $isBasePrice = false;
        }

        $existingSubscription = Subscription::where('user_id', $request->input('user_id'))
            ->where('course_id', $request->input('course_id'))
            ->where('status', '<>', Subscription::CANCELED)
            ->exists();


        try {
            if ($existingSubscription) {
                flash(translate('messages.AlreadyAdded'))->error();
            } else {
                $subscription = Subscription::create([
                    'user_id' => $request->user_id,
                    'course_id' => $request->course_id,
                    'price' => $request->price,
                    'isBasePrice' => $isBasePrice,
                ]);
                $subscription->save();
                $balance = Balance::query()->create([
                    'amount' => $request->price,
                    'sender_id' => $request->user_id,
                    'receiver_id' => get_setting(ADMIN_ID),
                    'currency_id' => get_setting('site_currency_id'),
                    'description' => 'Subscription cost',
                    'payment_type' => 'course',
                    'payment_id' => $request->course_id
                ]);


                User::where('id', $balance->sender_id)->decrement('balance', $request->price);
                User::where('id', $balance->receiver_id)->increment('balance',
                    $request->price);

                flash(translate('messages.Added'))->success();
            }

            return back();
        } catch (Exception) {
            return $this->error();
        }
    }


    public function deleteSelected(Request $request): JsonResponse
    {
        try {
            $selectedData = $request->selectedData;
            $deletedSubscriptions = [];
            $notDeletedSubscriptions = [];
            foreach ($selectedData as $id) {
                $subscription = Subscription::find($id);
                if ($subscription) {
                    if ($subscription->canDeleted()) {
                        $deletedSubscriptions[$subscription->id] = $subscription->name;
                        $subscription->delete();
                    } else {
                        $notDeletedSubscriptions[$subscription->id] = $subscription->name;
                    }
                }
            }
            return Response()->json([
                'message' => [
                    'deletedsubScriptions' => $deletedSubscriptions,
                    'notDeletedSubscriptions' => $notDeletedSubscriptions,
                ]
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong')
            ]);
        }

    }


    public function destroy($id): JsonResponse
    {
        try {
            $subscription = Subscription::findOrFail($id);

            if (!$subscription->canDeleted()) {
                return response()->json([
                    'status' => 'error',
                    'message' => translate('messages.CannotDelete')
                ]);
            }

            $subscription->delete();

            if ($subscription) {
                return response()->json([
                    'status' => 'success',
                    'message' => translate('messages.Deleted')
                ]);
            }
        } catch (Exception) {
            return response()->json([
                'status' => 'error',
                'message' => translate('messages.Wrong')
            ]);
        }
    }

    public function destroyShow($id): RedirectResponse
    {
        try {
            $subscription = Subscription::find($id);

            if ($subscription) {
                if ($subscription->status == Subscription::CANCELED || $subscription->isFinished()) {
                    $subscription->delete();
                    flash(translate('messages.Deleted'))->success();
                } else {
                    flash(translate('messages.DonotDeleteBeforeCancelSubscription'))->error();
                }
            }
            return redirect(route('subscriptions.index'));
        } catch (Exception) {
            return $this->error();
        }
    }

    public function cancel($id)
    {
        try {
            $subscription = Subscription::find($id);
            $siteCurrencyId = get_setting('site_currency_id');
            if ($subscription->isCanceled()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => translate('messages.AlreadyCanceled')
                ]);
            } elseif ($subscription->isFinished()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => translate('messages.DontCancelFinished')
                ]);
            } else {
                if (Subscription::query()->where('id', $id)->update(['status' => Subscription::CANCELED])) {
                    $balance = Balance::query()->create([
                        'amount' => $subscription->price * -1,
                        'sender_id' => get_setting(ADMIN_ID),
                        'receiver_id' => $subscription->user_id,
                        'currency_id' => $siteCurrencyId,
                        'description' => 'Subscription Canceled',
                        'payment_type' => 'course',
                        'payment_id' => $subscription->course_id
                    ]);

                    User::where('id', $balance->receiver_id)->increment('balance', $subscription->price);
                    User::where('id', $balance->sender_id)->decrement('balance', $subscription->price);

                    return response()->json([
                        'status' => 'success',
                        'message' => translate('messages.Canceled')
                    ]);
                }
            }
            return back();
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

    public function verifiedSubscriptionPayment($id): JsonResponse
    {
        try {
            $subscription = Subscription::find($id);
            if ($subscription) {
                if ($subscription->is_verified_payment) {
                    return Response()->json([
                        'status' => 'error',
                        'message' => translate('messages.cannotPayThePaidSubscription')
                    ]);
                } elseif ($subscription->isCanceled() || $subscription->isFinished()) {
                    return Response()->json([
                        'status' => 'error',
                        'message' => 'لا يمكنك تاكيد الدفع للحجوزات الملغية او المنتهية'
                    ]);
                } else {
                    $subscription->update(['is_verified_payment' => 1]);
                    $user = User::find($subscription->user_id);
                    $user->notify(new VerifiedSubscriptionPaymentNotification($subscription));
                    return Response()->json([
                        'status' => 'success',
                        'message' => translate('messages.subscriptionHasBeenSuccessfullyPaid')
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
