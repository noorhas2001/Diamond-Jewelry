<?php

namespace App\Observers;

use App\Models\CurrencyDelar;

class DelarObserver
{
    public function deleting(CurrencyDelar $currencyDelar): void
    {
        $this->deleteRelatedTransactions($currencyDelar);
    }

    private function deleteRelatedTransactions(CurrencyDelar $currencyDelar): void
    {
        if ($currencyDelar->transactions->isNotEmpty()) {
            $currencyDelar->transactions()->delete();
        }

    }
}
