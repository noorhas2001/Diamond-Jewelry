<?php

namespace App\Http\Controllers;

use App\Models\FeatureFlag;
use App\Services\FeatureFlagService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Factory;
use Illuminate\View\View;

class FeatureFlagController extends Controller
{
    protected FeatureFlagService $featureFlagService;

    public function __construct(FeatureFlagService $featureFlagService)
    {
        $this->featureFlagService = $featureFlagService;
    }

    public function index(Request $request): Factory|View
    {
        $keyword = $request->input('keyword');
        $featureFlags = $this->featureFlagService->getPaginatedFeatureFlags($keyword);

        return view('admin.dashboard.configurations.feature_activations', compact('featureFlags'));
    }

    public function update(Request $request): JsonResponse
    {
        if (!Gate::allows('update', FeatureFlag::class)) {
            abort(403, 'Unauthorized');
        }

        $featureFlag = $this->featureFlagService->findFeatureFlagById($request->id);
        $this->featureFlagService->toggleEnabledStatus($featureFlag);

        return response()->json([
            'enabled' => $featureFlag->enabled,
            'status' => 'success',
            'message' => __('messages.FeatureFlagUpdated')
        ]);
    }
}
