<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $added_by
 * @property mixed $resource_id
 * @property mixed $price
 * @property mixed $start_date
 * @property mixed $hours
 * @property mixed $end_date
 * @property mixed $description
 * @property mixed $active
 * @method rate()
 * @method imageUrl()
 * @method isRated()
 * @method ratings()
 */
class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $userRating = $this->ratings()->where('user_id', auth()->id())->first();

        return [
            'id' => $this->id,
            'isRated' => $this->isRated(),
            'user_rate' => $userRating ? $userRating->value : null,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'active' => $this->active,
                'resource_id' => $this->resource_id,
                'hours' => $this->hours,
                'price' => $this->price,
                'rate' => $this->rate(),
                'avatar' => $this->imageUrl(),
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ],
        ];
    }
}
