<?php

namespace App\Services;

use App\Models\FeatureFlag;
use Illuminate\Pagination\LengthAwarePaginator;

class FeatureFlagService
{
    public function toggleEnabledStatus(FeatureFlag $featureFlag): void
    {
        $featureFlag->enabled = !$featureFlag->enabled;
        $featureFlag->save();
    }

    public function getPaginatedFeatureFlags(string $keyword = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = FeatureFlag::query();

        if ($keyword) {
            $query->where('name', 'like', '%'.$keyword.'%');
        }

        return $query->paginate($perPage);
    }

    public function findFeatureFlagById(int $id): FeatureFlag
    {
        return FeatureFlag::findOrFail($id);
    }
}
