<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static paginate(int $int)
 * @method static findOrFail($id)
 * @method static find($id)
 * @method static orderByDesc(string $string)
 * @property mixed $id
 * @property mixed $name
 * @property mixed $end_date
 * @property int|mixed|string|null $added_by
 * @property mixed $resource_id
 * @property float|int|mixed $cost
 * @property mixed $start_date
 * @property mixed $user_id
 * @property mixed $status
 * @property mixed $payment_method_id
 * @property mixed $reservationTimes
 * @property bool|mixed $isHasUser
 * @property false|mixed $is_verified_payment
 * @property mixed $course_id
 */
class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    public const PENDING = 'Pending';
    public const FINISHED = 'Finished';
    public const CONFIRMED = 'Confirmed';
    public const CANCELED = 'Canceled';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'added_by',
        'resource_id',
        'user_id',
        'price_by_hour',
        'price_by_day',
        'price_by_weak',
        'price_by_month',
        'payment_method_id',
        'is_verified_payment',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }


    //  ToDo : Add Canceled status in The Function

    public function status(): string
    {
        if ($this->status == self::CANCELED) {
            return self::CANCELED;
        }

        return $this->getStatus() ? 'Pending' : 'Finished';
    }

    public function getStatus(): bool
    {
        $reservationTimes = $this->reservationTimes;

        if ($reservationTimes->isEmpty()) {
            return false;
        }

        foreach ($reservationTimes as $reservationTime) {
            if ($reservationTime->status() == self::PENDING) {
                return true; // If any reservation time has a true status, return true
            }
        }
        return false; // If all reservation times have false status, return false
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

    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function reservationTimes(): HasMany
    {
        return $this->hasMany(ReservationTime::class);
    }

    public function costReservationTimes(): int
    {
        return $this->reservationTimes->sum('cost');
    }


    public function costReservationTimesWithoutFinished(): int
{
    $sumCost = 0;
    $reservationTimes = $this->reservationTimes;

    foreach ($reservationTimes as $reservationTime) {
        if ($reservationTime->isPending()) {
            $sumCost += $reservationTime->cost;
        }
    }

    return $sumCost;
}

}
