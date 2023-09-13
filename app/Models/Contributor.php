<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contributor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone', 'shekels_balance', 'dollars_balance', 'dinars_balance'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'contributor_id');
    }

    public function shekels_balance()
    {
        $income = $this->transactions()
            ->where('currency_id', 2)
            ->where('transaction_type', 'استلام')
            ->sum('amount');

        $expense = $this->transactions()
            ->where('currency_id', 2)
            ->where('transaction_type', 'دفعة')
            ->sum('amount');

        return $this->shekels_balance + $income - $expense;
    }

    public function dollars_balance()
    {
        $income = $this->transactions()
            ->where('currency_id', 1)
            ->where('transaction_type', 'استلام')
            ->sum('amount');

        $expense = $this->transactions()
            ->where('currency_id', 1)
            ->where('transaction_type', 'دفعة')
            ->sum('amount');

        return $this->dollars_balance + $income - $expense;
    }

    public function dinars_balance()
    {
        $income = $this->transactions()
            ->where('currency_id', 3)
            ->where('transaction_type', 'استلام')
            ->sum('amount');

        $expense = $this->transactions()
            ->where('currency_id', 3)
            ->where('transaction_type', 'دفعة')
            ->sum('amount');

        return $this->dinars_balance + $income - $expense;
    }

}
