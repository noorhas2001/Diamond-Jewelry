<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'person_name',
        'shekels_balance',
        'dollars_balance',
        'dinars_balance',
        'debt_date',
        'is_debt_from_others',
        'is_paid',
        'weight',
        'phone_number',
    ];

    public function debt_transactions(): HasMany
    {
        return $this->hasMany(DebtTransaction::class, 'person_id');
    }

    public function shekels_balance()
    {
        $income = $this->debt_transactions()
            ->where('currency_id', 2)
            ->where('transaction_type', 'سحب')
            ->sum('amount');

        $expense = $this->debt_transactions()
            ->where('currency_id', 2)
            ->where('transaction_type', 'سداد')
            ->sum('amount');

        return $this->shekels_balance + $income - $expense;
    }

    public function dollars_balance()
    {
        $income = $this->debt_transactions()
            ->where('currency_id', 1)
            ->where('transaction_type', 'سحب')
            ->sum('amount');

        $expense = $this->debt_transactions()
            ->where('currency_id', 1)
            ->where('transaction_type', 'سداد')
            ->sum('amount');

        return $this->dollars_balance + $income - $expense;
    }

    public function dinars_balance()
    {
        $income = $this->debt_transactions()
            ->where('currency_id', 3)
            ->where('transaction_type', 'سحب')
            ->sum('amount');

        $expense = $this->debt_transactions()
            ->where('currency_id', 3)
            ->where('transaction_type', 'سداد')
            ->sum('amount');

        return $this->dinars_balance + $income - $expense;
    }

    public function weight()
    {
        $income = $this->debt_transactions()
            ->where('transaction_type', 'سحب')
            ->sum('weight');

        $expense = $this->debt_transactions()
            ->where('transaction_type', 'سداد')
            ->sum('weight');

        return $this->weight + $income - $expense;
    }
}
