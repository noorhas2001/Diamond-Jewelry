<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $course = CourseResource::collection(Course::orderByDesc('id')->paginate(10));

        $message = isArabicLang($request) ? 'نجحت العملية' : 'Success';

        return $this->apiResponse($course, $message);
    }

    public function details(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return $this->handleErrors($validator);
        }

        $course = Course::where('id', $request->input('course_id'))->first();

        if ($course) {
            $message = isArabicLang($request) ? 'نجحت العملية' : 'Success';
            return $this->apiResponse(new CourseResource($course), $message);
        }

        $message = isArabicLang($request) ? 'هذه الدورة غير موجودة' : 'This Course Not Found';
        return $this->apiResponse(null, $message, 404);
    }


    public function handleErrors($validator): JsonResponse
    {
        return response()->json([
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors()
        ], 422);
    }


}
