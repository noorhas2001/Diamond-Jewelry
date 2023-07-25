<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        Slider::factory([
            'link' => '{"id": "1", "type": "category"}',
        ])->count(1)->create();
        Slider::factory([
            'link' => '{"id": "1", "type": "course"}',
        ])->count(1)->create();
        Slider::factory([
            'link' => '{"id": "1", "type": "resource"}',
        ])->count(1)->create();

    }
}
