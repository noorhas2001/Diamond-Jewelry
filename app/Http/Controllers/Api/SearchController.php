<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Resource;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');

        $resources = Resource::where('name', 'like', '%'.$name.'%')->orderByDesc('id')->get([
            'id', 'name', 'thumbnail_img'
        ]);
        $courses = Course::where('name', 'like', '%'.$name.'%')->orderByDesc('id')->get(['id', 'name', 'image']);
        $categories = Category::where('name', 'like', '%'.$name.'%')->orderByDesc('id')->get(['id', 'name', 'icon']);

        $resourceData = [];
        foreach ($resources as $resource) {
            $resourceData[] = [
                'id' => $resource->id,
                'name' => $resource->name,
                'image' => $resource->imageUrl(),
            ];
        }

        $courseData = [];
        foreach ($courses as $course) {
            $courseData[] = [
                'id' => $course->id,
                'name' => $course->name,
                'image' => $course->imageUrl(),
            ];
        }

        $categoryData = [];
        foreach ($categories as $category) {
            $categoryData[] = [
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->iconUrl(),
            ];
        }

        $results = [
            'resources' => $resourceData,
            'courses' => $courseData,
            'categories' => $categoryData,
        ];

        if (empty($resourceData) && empty($courseData) && empty($categoryData)) {
            $message = isArabicLang($request) ? 'لا يوجد بيانات تطابق البحث' : 'No data matching this search process';
            return response()->json([
                'message' => $message
            ], NOT_FOUND);
        }

        return response()->json($results);
    }

}
