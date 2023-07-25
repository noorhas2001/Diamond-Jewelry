<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @method static paginate(int $int)
 * @method static find($id)
 * @method static findOrFail($id)
 * @method static count()
 * @method static pluck(string $string, string $string1)
 * @method static orderByDesc(string $string)
 * @property mixed $resources
 * @property mixed $banner
 * @property mixed $icon
 * @property mixed $name
 * @property mixed $description
 */
class Category extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    const CATEGORY_ICON_IMAGE_TAG = 'category_icon_image';
    const CATEGORY_BANNER_IMAGE_TAG = 'category_banner_image';

    protected $fillable = [
        'name', 'description', 'icon', 'banner'
    ];

    public function addAssetImage($path, $image_tag)
    {
        return $this->addMediaFromUrl(url(asset($path)))->toMediaCollection($image_tag);
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function iconUrl()
    {
        return Media::find($this->icon)?->getUrl();
    }

    public function bannerUrl()
    {
        return Media::find($this->banner)?->getUrl();
    }

    public function canDeleted():bool
    {
        if($this->resources()->exists()){
            return 0;
        }else{
            return 1;
        }
    }
}
