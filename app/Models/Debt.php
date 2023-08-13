<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'person_name',
        'amount',
        'debt_date',
        'is_debt_from_others',
        'currency_id',
        'is_paid',
        'weight',
        'phone_number',
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function debt_transactions(): HasMany
    {
        return $this->hasMany(DebtTransaction::class , 'person_id');
    }
}
