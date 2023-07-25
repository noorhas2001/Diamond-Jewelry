<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $reservation_id
 * @property mixed $start_time
 * @property mixed $end_time
 * @property bool|mixed $status
 * @property int|mixed $cost
 */
class ReservationTime extends Model
{
    use HasFactory, SoftDeletes;

    const PENDING = 'Pending';
    const FINISHED = 'Finished';
    public const CANCELED = 'Canceled';

    protected $fillable = [
        'reservation_id',
        'start_time',
        'end_time',
        'cost'
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function status(): string
    {
        if (!$this->status) {
            return self::CANCELED;
        } else {
            if ($this->end_time > now()) {
                return self::PENDING;
            } else {
                return self::FINISHED;
            }
        }
    }

    public function isPending(): bool
    {
        return $this->status() == self::PENDING;
    }

    public function isFinished(): bool
    {
        return $this->status() == self::FINISHED;
    }

    public function isCanceled(): bool
    {
        return $this->status() == self::CANCELED;
    }
}
