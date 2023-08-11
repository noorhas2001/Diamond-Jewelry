<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;

/**
 * @property mixed $exchange_rate
 * @property mixed $code
 */
class Currency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'symbol', 'exchange_rate', 'status', 'code'];

}
