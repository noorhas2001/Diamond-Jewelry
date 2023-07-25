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
 * @method static create(array $array)
 * @method static findOrFail($id)
 * @method static paginate(int $int)
 * @method static find($id)
 * @method static where(string $string, string $string1, string $string2)
 * @method static count()
 * @method static pluck(string $string, string $string1)
 * @method static inRandomOrder()
 * @method static orderByDesc(string $string)
 * @property mixed $id
 * @property mixed $reservations
 * @property mixed $ name
 * @property mixed $description
 * @property mixed $added_by
 * @property mixed $category_id
 * @property mixed $number_seats
 * @property mixed $price_by_hour
 * * @property mixed $price_by_day
 * * @property mixed $price_by_weak
 *  * * @property mixed $price_by_month
 *  @property mixed $published
 * @property mixed $imagePath
 * @property mixed $thumbnail_img
 *
 */
class Resource extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    const RESOURCE_IMAGE_TAG = 'resource_image';

    protected $guarded = [];

    public function addAssetImage($path, $image_tag)
    {
        return $this->addMediaFromUrl(url(asset($path)))->toMediaCollection($image_tag);
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function imageUrl()
    {
        return Media::find($this->thumbnail_img)?->getUrl();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function reservationTimes(): HasManyThrough
    {
        return $this->hasManyThrough(ReservationTime::class, Reservation::class);
    }

    public function sliders(): HasMany
    {
        return $this->hasMany(Slider::class);
    }

    public function canDeleted(): bool
    {
        if (($this->reservations()->exists() && $this->reservations()->first()->isPending())
        ) {
            return false;
        } else {
            return true;
        }
    }
}
