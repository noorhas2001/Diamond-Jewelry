<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryDetailsResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    use ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $category = CategoryResource::collection(Category::orderByDesc('id')->paginate(10));

        $message = isArabicLang($request) ? 'نجحت العملية' : 'Success';

        return $this->apiResponse($category, $message);
    }


    public function details(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return handleErrors($validator);
        }

        $category = Category::where('id', $request->input('category_id'))->first();

        if ($category) {
            $message = isArabicLang($request) ? 'نجحت العملية' : 'success';

            return $this->apiResponse(new CategoryDetailsResource($category), $message);
        }

        $message = isArabicLang($request) ? 'هذه التصنيف غير موجودة' : 'This Category Not Found';

        return $this->apiResponse(null, $message, 404);
    }
}
