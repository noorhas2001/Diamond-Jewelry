<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;
use App\Models\Balance;
use App\Models\Course;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    use ApiResponseTrait;

    public function getUserSubscriptions(Request $request)
    {
        $user = auth()->user();
        if ($user) {

            $subscriptions = $user->subscriptions->reverse();

            if ($subscriptions->isNotEmpty()) {

                return $this->apiResponse(SubscriptionResource::collection($subscriptions), 'success');
            }

            $message = isArabicLang($request) ? 'لم يتم العثور على اشتراكات لهذا المستخدم' : 'No subscriptions found for this user';

            return $this->apiResponse(null, $message, NOT_FOUND);
        }

        $message = isArabicLang($request) ? 'لم يتم العثور على المستخدم' : 'User not found';

        return $this->apiResponse(null, $message, NOT_FOUND);
    }

    public function subscribe(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer|exists:courses,id',
            'payment_method_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }

        $user = auth()->id();

        if (!$user) {
            $message = isArabicLang($request) ? 'غير مصرح' : 'Unauthorized';

            return response()->json(['message' => $message], UNAUTHORIZED);
        }

        $existingSubscription = Subscription::where('user_id', $user)
            ->where('course_id', $request->input('course_id'))
            ->where('status', '<>', Subscription::CANCELED)
            ->exists();

        if ($existingSubscription) {
            $message = isArabicLang($request) ? 'لقد اشتركت بالفعل في هذه الدورة' : 'You have already subscribed in this course';

            return response()->json(['message' => $message], UNPROCESSABLE_CONTENT);
        }


        $coursePrice = Course::query()->where('id', $request->input('course_id'))->pluck('price')->first();
        $subscription = Subscription::create([
            'price' => $coursePrice,
            'user_id' => auth()->id(),
            'course_id' => $request->input('course_id'),
            'payment_method_id' => $request->input('payment_method_id'),
        ]);
        $subscription->save();
        Balance::query()->create([
            'amount' => $coursePrice,
            'sender_id' => $user,
            'receiver_id' => get_setting(ADMIN_ID),
            'currency_id' => get_setting('site_currency_id'),
            'description' => 'Subscription cost',
            'payment_type' => 'course',
            'payment_id' => $request->course_id
        ]);

        User::where('id', $user)->decrement('balance', $coursePrice);
        User::where('id', get_setting(ADMIN_ID))->increment('balance',
            $coursePrice);
        $message = isArabicLang($request) ? 'تم إرسال الاشتراك بنجاح' : 'Subscription submitted successfully';

        return response()->json(['message' => $message], CREATED);
    }

    public function handleErrors($validator): JsonResponse
    {
        return response()->json([
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors()
        ], UNPROCESSABLE_CONTENT);
    }
}
