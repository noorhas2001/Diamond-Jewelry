<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoldDelar extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'total_weight', 'total_workmanship', 'phone_number'];

    public function goldTransactions(): HasMany
    {
        return $this->hasMany(GoldTransaction::class, 'gold_delar_id');
    }

    public function totalWeight()
    {
        $income = $this->goldTransactions()
            ->where('transaction_type', 'استلام')
            ->sum('weight');

        $expense = $this->goldTransactions()
            ->where('transaction_type', 'دفعة')
            ->sum('weight');

        return $this->total_weight + $income - $expense;

    }

    public function totalWorkManShip()
    {
        $income = $this->goldTransactions()
            ->where('transaction_type', 'استلام')
            ->sum('workmanship');

        $expense = $this->goldTransactions()
            ->where('transaction_type', 'دفعة')
            ->sum('workmanship');

        return $this->total_workmanship + $income - $expense;

    }
}
