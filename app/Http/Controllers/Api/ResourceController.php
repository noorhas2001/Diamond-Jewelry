<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    use ApiResponseTrait;

    public function index(): JsonResponse
    {
        $resource = ResourceResource::collection(Resource::orderByDesc('id')->paginate(10));

        return $this->apiResponse($resource, 'success');
    }


    public function details(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'resource_id' => 'required|integer|exists:resources,id',
        ]);

        if ($validator->fails()) {
            return handleErrors($validator);
        }

        $resource = Resource::find($request->resource_id);

        if ($resource) {
            return $this->apiResponse(new ResourceResource($resource), 'success');
        }

        $message = isArabicLang($request) ? 'لم يتم العثور على هذا المورد' : 'This Resource Not Found';

        return $this->apiResponse(null, $message, 404);
    }
}
