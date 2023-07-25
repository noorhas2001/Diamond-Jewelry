<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $sliders = SliderResource::collection(Slider::orderByDesc('id')->paginate(10));

        $message = isArabicLang($request) ? 'نجحت العملية' : 'Success';

        return $this->apiResponse($sliders, $message);
    }


    public function show(Request $request, $id): JsonResponse
    {
        $slider = Slider::find($id);

        if ($slider) {
            $message = isArabicLang($request) ? 'نجحت العملية' : 'Success';
            return $this->apiResponse(new SliderResource($slider), $message);
        }

        $message = isArabicLang($request) ? 'هذا الاعلان غير موجود' : 'This Slider Not Found';
        return $this->apiResponse(null, $message, 404);
    }
}
