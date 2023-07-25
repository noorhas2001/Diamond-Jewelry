<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $resource_id
 * @property mixed $cost
 * @property mixed $start_date
 * @property mixed $end_date
 * @property mixed $is_verified_payment
 * @property mixed $payment_method
 * @method status()
 */
class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {

        return [
            'id' => $this->id,
            'status' => $this->status(),
            'attributes' => [
                'name' => $this->name,
                'resource_id' => $this->resource_id,
                'cost' => $this->costReservationTimes(),
                'reservation_times' => $this->getReservationTimes(),
                'payment_method' => $this->payment_method->name,
                'is_verified_payment' => (bool) $this->is_verified_payment,
            ],
        ];
    }

    private function getReservationTimes(): array
    {
        $reservationTimes = $this->reservationTimes;
        $events = [];

        foreach ($reservationTimes as $reservationTime) {
            $events[] = [
                'start_date' => $reservationTime->start_time,
                'end_date' => $reservationTime->end_time,
            ];
        }

        return $events;
    }
}
