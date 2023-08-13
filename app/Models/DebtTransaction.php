<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DebtTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['person_id' , 'transaction_type' , 'weight' ,'amount' ,'date' ,'notes'];


    public function debt(): BelongsTo
    {
        return $this->belongsTo(Debt::class , 'person_id');
    }
}
