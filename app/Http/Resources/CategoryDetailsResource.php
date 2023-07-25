<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $description
 * @property mixed $resources
 * @method iconUrl()
 * @method bannerUrl()
 */
class CategoryDetailsResource extends JsonResource
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
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'icon' => $this->iconUrl(),
                'banner' => $this->bannerUrl(),
                'resource' => CategoryResourcesResource::collection($this->resources)
            ],
        ];
    }
}
