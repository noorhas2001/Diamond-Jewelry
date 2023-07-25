<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static updateOrCreate(string[] $array, string[] $array1)
 */
class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'value'];

}
