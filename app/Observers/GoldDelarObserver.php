<?php

namespace App\Observers;

use App\Models\GoldDelar;

class GoldDelarObserver
{
    public function deleting(GoldDelar $goldDelar): void
    {
        $this->deleteRelatedTransactions($goldDelar);
    }

    private function deleteRelatedTransactions(GoldDelar $goldDelar): void
    {
        if ($goldDelar->goldTransactions->isNotEmpty()) {
            $goldDelar->goldTransactions()->delete();
        }

    }

}
