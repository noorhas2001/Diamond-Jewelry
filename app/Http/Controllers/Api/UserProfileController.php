<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    use ApiResponseTrait;

    public function getUserProfile(Request $request): JsonResponse
    {
        $user = auth()->user();

        if ($user) {
            $message = isArabicLang($request) ? 'تمت العملية بنجاح' : 'Success';
            return $this->apiResponse(new UserResource($user), $message);
        }

        $message = isArabicLang($request) ? 'هذا المستخدم غير موجود' : 'This User Not Found';

        return $this->apiResponse(null, $message, NOT_FOUND);
    }
}
