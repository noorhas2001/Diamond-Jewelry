<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurrencyDelar extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'shekels_balance', 'dollars_balance', 'dinars_balance', 'notes'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'delar_id');
    }

    // public function shekels_balance(): int
    // {
    //     $withdrawalTransactions = $this->transactions->where('transaction_type', 'سحب')
    //         ->where('currency_id', 2);

    //     $withdrawalAmount = $withdrawalTransactions->sum('amount');

    //     return $this->shekels_balance - $withdrawalAmount;
    // }
    // public function dollars_balance(): int
    // {
    //     $withdrawalTransactions = $this->transactions->where('transaction_type', 'سحب')
    //         ->where('currency_id', 1);

    //     $withdrawalAmount = $withdrawalTransactions->sum('amount');

    //     return $this->dollars_balance - $withdrawalAmount;
    // }
    // public function dinars_balance(): int
    // {
    //     $withdrawalTransactions = $this->transactions->where('transaction_type', 'سحب')
    //         ->where('currency_id', 3);

    //     $withdrawalAmount = $withdrawalTransactions->sum('amount');

    //     return $this->dinars_balance - $withdrawalAmount;
    // }

}
