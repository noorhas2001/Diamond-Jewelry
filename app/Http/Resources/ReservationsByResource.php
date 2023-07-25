<?php

namespace App\Http\Resources;

use App\Models\Resource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationsByResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'resource' => new ResourceResource(Resource::find($this->resource_id)),
            'reservations' => new ReservationResource($this),
        ];
    }
}
