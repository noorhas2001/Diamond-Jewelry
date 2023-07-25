<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CourseRatingController extends Controller
{
    public function rate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|integer|between:1,5',
            'course_id' => 'required|integer|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }

        $user = auth()->id();

        if (!$user) {
            $message = isArabicLang($request) ? 'غير مصرح' : 'Unauthorized';
            return response()->json(['message' => $message], UNAUTHORIZED);
        }

        $existingRating = Rating::where('user_id', $user)
            ->where('course_id', $request->input('course_id'))
            ->exists();

        if ($existingRating) {
            $message = isArabicLang($request) ? 'لقد قمت بالفعل بتقييم هذه الدورة' : 'You have already rated this course';
            return response()->json(['message' => $message], UNPROCESSABLE_CONTENT);
        }

        $rating = Rating::create([
            'value' => $request->input('value'),
            'user_id' => auth()->id(),
            'course_id' => $request->input('course_id'),
        ]);

        $rating->save();

        $message = isArabicLang($request) ? 'تم إرسال التقييم بنجاح' : 'Rating submitted successfully';
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
