<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $name
 * @property mixed $number_seats
 * @property mixed $price_by_hour
 * @property mixed $price_by_day
 * @property mixed $price_by_weak
 * @property mixed $price_by_month
 * @method imageUrl()
 */
class CategoryResourcesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $attributes = [
            'name' => $this->name,
            'number_seats' => $this->number_seats,
            'thumbnail_image' => $this->imageUrl(),
        ];

        if ($this->price_by_hour > 0) {
            $attributes['price_by_hour'] = $this->price_by_hour;
        }

        if ($this->price_by_day > 0) {
            $attributes['price_by_day'] = $this->price_by_day;
        }

        if ($this->price_by_weak > 0) {
            $attributes['price_by_weak'] = $this->price_by_weak;
        }

        if ($this->price_by_month > 0) {
            $attributes['price_by_month'] = $this->price_by_month;
        }

        return [
            'id' => $this->id,
            'attributes' => $attributes,
        ];
    }
}
