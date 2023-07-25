<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $sub_title
 * @property mixed $description
 * @property mixed $link
 * @property mixed $rate
 * @method linkImage()
 * @method modelType()
 * @method modelId()
 * @method courseHours()
 */
class SliderResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->linkImage(),
            'id' => $this->modelId(),
        ];

        if ($this->modelType() === 'course') {
            $attributes['courseHours'] = $this->courseHours();
        }
        return [
            'id' => $this->id,
            'type' => 'slider',
            'value' => $this->modelType(),
            'attributes' => $attributes
        ];
    }
}
