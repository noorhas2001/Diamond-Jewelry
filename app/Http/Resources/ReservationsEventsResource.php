<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $name
 * @property mixed $reservationTimes
 */
class ReservationsEventsResource extends JsonResource
{
    protected array $paletteColors = [
        '#3E97FF', '#181C32', '#FFC700', '#FF5733', '#00FF00', '#FF00FF',
        '#FFA500', '#800080', '#00FFFF', '#FF1493', '#00CED1', '#FFD700',
        '#FF4500', '#9932CC', '#00BFFF', '#FF6347', '#7B68EE', '#20B2AA',
        '#8A2BE2', '#A52A2A', '#5F9EA0', '#D2691E', '#FF7F50', '#6495ED',
        '#DC143C', '#00FFFF', '#00008B', '#008B8B', '#B8860B', '#A9A9A9',
        '#006400', '#BDB76B', '#8B008B', '#556B2F', '#FF8C00', '#9932CC',
        '#8B0000', '#E9967A', '#8FBC8F', '#483D8B', '#2F4F4F', '#00CED1',
        '#FFDAB9', '#CD5C5C', '#9ACD32', '#9400D3', '#FF1493', '#FF00FF',
        '#B22222', '#20B2AA', '#00FF7F', '#808000', '#8B008B', '#FF4500',
        '#DB7093', '#800080', '#8B0000', '#BDB76B', '#FF8C00', '#4B0082',
        '#FF69B4', '#C71585', '#48D1CC', '#00CED1', '#FF1493', '#008B8B',
        '#CD5C5C', '#FFA07A', '#FF00FF', '#A020F0', '#FF4500', '#DB7093',
        '#E9967A', '#800080', '#A0522D', '#FFD700', '#ADFF2F', '#FF6347',
        '#00FF7F', '#FF8C00', '#9932CC', '#B8860B', '#008000', '#4B0082',
        '#008080', '#00FA9A', '#FF00FF', '#FF4500', '#FFD700', '#DDA0DD',
        '#FFA07A', '#FFA500', '#9ACD32', '#FA8072', '#FF6347', '#48D1CC',
        '#FF69B4', '#BA55D3', '#FF4500', '#FF8C00', '#ADFF2F', '#FFA500',
        '#FF00FF', '#008000', '#FF69B4', '#FFD700', '#FF7F50', '#00FF00',
        '#FFA07A', '#FFA500', '#FF6347', '#20B2AA', '#BA55D3', '#FFC0CB',
        '#FF1493', '#FF4500', '#FF00FF', '#7B68EE', '#FF6347', '#FFA07A',
        '#00FF7F', '#FF4500', '#FFD700', '#FF8C00', '#9932CC', '#B8860B',
        '#008000', '#4B0082', '#008080', '#00FA9A', '#FF00FF', '#FF4500',
    ];


    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $randomColor = $this->getRandomColorFromPalette($this->paletteColors);

        return [
            'title' => $this->name,
            'color' => $randomColor,
            'events' => $this->getReservationTimes(),
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


// Function to generate a random color from the palette and remove it to avoid repetition
    function getRandomColorFromPalette(array &$paletteColors): ?string
    {
        if (empty($paletteColors)) {
            return null; // Return null if no colors left in the palette
        }

        // Shuffle the palette colors randomly
        shuffle($paletteColors);

        // Get the first color from the shuffled palette
        return array_shift($paletteColors);
    }
}
