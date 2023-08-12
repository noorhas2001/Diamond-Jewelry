<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['amount', 'currency_id' ,'notes' ,'deposit_date'];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
