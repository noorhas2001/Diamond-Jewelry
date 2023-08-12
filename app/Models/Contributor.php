<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contributor extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name', 'phone', 'shekels_balance', 'dollars_balance', 'dinars_balance'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'contributor_id');
    }
}
