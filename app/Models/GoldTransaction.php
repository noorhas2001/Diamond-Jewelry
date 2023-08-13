<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoldTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
        [
        'gold_delar_id',
        'transaction_type',
        'item',
        'weight',
        'workmanship',
        'notes',
    ];

    public function goldDelars(): BelongsTo
    {
        return $this->belongsTo(GoldDelar::class, 'gold_delar_id');
    }

}
