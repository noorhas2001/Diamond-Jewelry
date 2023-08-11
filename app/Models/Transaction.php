<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['delar_id', 'transaction_type', 'amount', 'currency_id', 'date', 'notes'];

    public function currencyDelars(): BelongsTo
    {
        return $this->belongsTo(CurrencyDelar::class ,'delar_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
