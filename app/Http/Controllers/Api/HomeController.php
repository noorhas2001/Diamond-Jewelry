<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\ResourceResource;
use App\Http\Resources\SliderResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\Resource;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    use ApiResponseTrait;

    public function index(): JsonResponse
    {
        $sliders = SliderResource::collection(Slider::orderByDesc('id')->paginate(4));
        $categories = CategoryResource::collection(Category::orderByDesc('id')->paginate(5));
        $courses = CourseResource::collection(Course::orderByDesc('id')->paginate(5));
        $resources = ResourceResource::collection(Resource::orderByDesc('id')->paginate(5));

        $data = [
            'message' => 'success',
            'sliders' => $sliders,
            'categories' => $categories,
            'courses' => $courses,
            'resources' => $resources,
        ];

        return response()->json($data);
    }
}
