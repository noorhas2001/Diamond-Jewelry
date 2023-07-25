<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property mixed $title
 * @property mixed $sub_title
 * @property mixed|null $description
 * @property false|mixed|string $link
 * @property mixed $rate
 * @method static findOrFail($id)
 * @method static paginate(int $int)
 * @method static orderByDesc(string $string)
 */
class Slider extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title' , 'sub_title' , 'description' , 'link' ,
    ];

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

    public function linkName(): ?string
    {
        $link = json_decode($this->link);

        switch ($link->type) {
            case 'category':
                $category = Category::findOrFail($link->id);
                return $category->name;
            case 'resource':
                $resource = Resource::findOrFail($link->id);
                return $resource->name;
            case 'course':
                $course = Course::findOrFail($link->id);
                return $course->name;
            default:
                return null;
        }
    }
    public function courseHours(): ?string
    {
        $link = json_decode($this->link);

        switch ($link->type) {
            case 'course':
                $course = Course::findOrFail($link->id);
                return $course->hours;
            default:
                return null;
        }
    }

    public function linkImage(): ?string
    {
        $link = json_decode($this->link);

        switch ($link->type) {
            case 'category':
                $category = Category::findOrFail($link->id);
                return Media::find($category->banner)?->getUrl();

            case 'resource':
                $resource = Resource::findOrFail($link->id);
                return Media::find($resource->thumbnail_img)?->getUrl();

            case 'course':
                $course = Course::findOrFail($link->id);
                return Media::find($course->image)?->getUrl();

            default:
                return null;
        }
    }

    public function modelId(): ?string
    {
        $link = json_decode($this->link);

        return $link->id;
    }

    public function modelType(): ?string
    {
        $link = json_decode($this->link);

        return $link->type;
    }
}
