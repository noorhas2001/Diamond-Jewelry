<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static paginate(int $int)
 * @method static find($id)
 * @method static orderByDesc(string $string)
 * @property mixed $status
 * @property mixed $course
 */
class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'price',
        'course_id',
        'isBasePrice',
        'payment_method_id',
        'is_verified_payment',
    ];

    public const PENDING = 'Pending';
    public const FINISHED = 'Finished';
    public const CONFIRMED = 'Confirmed';
    public const CANCELED = 'Canceled';

    public function status(): string
    {
        if ($this->status == self::CANCELED) {
            return self::CANCELED;
        } else {
            return $this->course->status();
        }
    }

    public function isPending(): string
    {
        return $this->status() == self::PENDING;
    }

    public function isFinished(): string
    {
        return $this->status() == self::FINISHED;
    }

    public function isCanceled(): bool
    {
        return $this->status() == self::CANCELED;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }


    public function canDeleted(): bool
    {
        if($this->status == Subscription::CANCELED || $this->isFinished()){
            return true;
        }
        return false;
    }
}
