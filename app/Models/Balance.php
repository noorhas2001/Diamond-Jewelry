<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'amount',
        'description',
        'currency_id',
        'sender_id',
        'receiver_id',
        'payment_type',
        'payment_id',
    ];
}
