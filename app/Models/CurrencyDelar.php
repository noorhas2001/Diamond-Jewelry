<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurrencyDelar extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'shekels_balance', 'dollars_balance', 'dinars_balance', 'notes'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'delar_id');
    }
}
