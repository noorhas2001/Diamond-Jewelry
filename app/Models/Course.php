<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @method static find($id)
 * @method static paginate(int $int)
 * @method static findOrFail($id)
 * @method static create(array $array)
 * @method static count()
 * @method static sum(string $string)
 * @method static pluck(string $string, string $string1)
 * @method static inRandomOrder()
 * @method static orderByDesc(string $string)
 * @property mixed $end_date
 * @property mixed $ratings
 * @property mixed $price
 * @property mixed $id
 * @property mixed $name
 * @property mixed $active
 * @property mixed $added_by
 * @property mixed $resource_id
 * @property mixed $hours
 * @property mixed $number_seats
 * @property mixed $description
 * @property mixed $start_date
 * @property mixed $image
 * @property mixed $reservationTimes
 * @property mixed $reservations
 * @property mixed $lecture_hours
 */
class Course extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    public const PENDING = 'Pending';
    public const FINISHED = 'Finished';
    const COURSE_IMAGE_TAG = 'course_image';

    protected $fillable = [
        'name',
        'active',
        'price',
        'description',
        'hours',
        'added_by',
        'lecture_hours',
        'number_seats',
        'course_days',
        'start_date',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function reservationTimes(): HasManyThrough
    {
        return $this->hasManyThrough(ReservationTime::class, Reservation::class);
    }

    public function addAssetImage($path, $image_tag)
    {
        return $this->addMediaFromUrl(url(asset($path)))->toMediaCollection($image_tag);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(): BelongsTo
    {

        return $this->belongsTo(User::class, 'added_by');
    }

    public function status(): string
    {
        return $this->getStatusAttribute() ? 'Pending' : 'Finished';
    }

    public function getStatusAttribute(): bool
    {
        $reservations = $this->reservations;

        if ($reservations->isEmpty()) {
            return false;
        }

        foreach ($reservations as $reservation) {
            $reservationTimes = $reservation->reservationTimes;

            if ($reservationTimes->isEmpty()) {
                return false;
            }

            foreach ($reservationTimes as $reservationTime) {
                if ($reservationTime->status() == self::PENDING) {
                    return true; // If any reservation time has a true status, return true
                }
            }
        }

        return false; // If all reservation times have false status, return false
    }

    public function isPending(): bool
    {
        return $this->status() == self::PENDING;
    }

    public function isFinished(): bool
    {
        return $this->status() == self::FINISHED;
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function rate(): float
    {
        return (double) number_format($this->ratings->avg('value'), 1);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function imageUrl()
    {
        return Media::find($this->image)?->getUrl();
    }

    public function isRated(): bool
    {
        return $this->ratings()->where('user_id', auth()->id())->exists();
    }

    public function canDeleted(): bool
    {
        if ($this->isFinished() || !$this->subscriptions()->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
