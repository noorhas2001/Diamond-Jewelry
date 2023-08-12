<?php

namespace App\Observers;

use App\Models\Contributor;

class ContributorObserver
{
    public function deleting(Contributor $contributor): void
    {
        $this->deleteRelatedTransactions($contributor);
    }

    private function deleteRelatedTransactions(Contributor $contributor): void
    {
        if ($contributor->transactions->isNotEmpty()) {
            $contributor->transactions()->delete();
        }

    }
}
