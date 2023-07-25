<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $user
 * @property mixed $number_seats
 * @property mixed $id
 * @property mixed $name
 * @property mixed $price
 * @property mixed $category
 *\ @property mixed $price_by_hour
 * @property mixed $price_by_day
 * @property mixed $price_by_weak
 * @property mixed $price_by_month
 * @property mixed $reservations
 * @property mixed $description
 * @method imageUrl()
 */
class ResourceResource extends JsonResource
{

    public function toArray($request): array
    {
        $attributes = [
            'name' => $this->name,
            'description' => $this->description,
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

        $reservations = ReservationsEventsResource::collection($this->reservations->reverse());

        return [
            'id' => $this->id,
            'attributes' => $attributes,
            'reservations' => $reservations,
        ];
    }
}

