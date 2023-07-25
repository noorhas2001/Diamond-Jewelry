<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $price
 * @property mixed $payment_method
 * @property mixed $course_id
 * @property mixed $is_verified_payment
 * @method status()
 */
class SubscriptionResource extends JsonResource
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
                'course_id' => $this->course_id,
                'price' => $this->price,
                'payment_method' => $this->payment_method->name,
                'is_verified_payment' => (bool) $this->is_verified_payment,
            ],
        ];
    }
}
