<?php

namespace App\Policies;

use App\Models\FeatureFlag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeatureFlagPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): void
    {
        //
    }

    public function view(User $user, FeatureFlag $featureFlag): void
    {
        //
    }

    public function create(User $user): void
    {
        //
    }

    public function update(User $user)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, FeatureFlag $featureFlag): void
    {
        //
    }

    public function restore(User $user, FeatureFlag $featureFlag): void
    {
        //
    }

    public function forceDelete(User $user, FeatureFlag $featureFlag): void
    {
        //
    }
}
