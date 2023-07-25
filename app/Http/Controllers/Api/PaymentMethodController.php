<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class PaymentMethodController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $payment_method = PaymentMethodResource::collection(PaymentMethod::orderByDesc('id')->paginate(10));

        $message = isArabicLang($request) ? 'تمت العملية بنجاح' : 'Success';

        return $this->apiResponse($payment_method, $message);
    }
}
