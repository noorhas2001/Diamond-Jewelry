<?php

namespace App\Observers;

use App\Models\Debt;

class DebtObserver
{
    public function deleting(Debt $debts): void
    {
        $this->deleteRelatedTransactions($debts);
    }

    private function deleteRelatedTransactions(Debt $debts): void
    {
        if ($debts->debt_transactions->isNotEmpty()) {
            $debts->debt_transactions()->delete();
        }

    }
}
