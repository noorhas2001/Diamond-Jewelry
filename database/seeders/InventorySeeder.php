<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'item' => 'حلق تركي',
                'weight' => 250.00 ,
                'equation' => 1.00 ,
                'total_weight' => 250.00
            ],
            [
                'item' => 'اسوار مصري',
                'weight' => 220.00 ,
                'equation' => 1.00 ,
                'total_weight' => 200.00
            ],
            [
                'item' => 'سنسال تركي',
                'weight' => 300.00 ,
                'equation' => 1.00 ,
                'total_weight' => 300.00
            ],
        ];

        DB::table('inventories')->insert($data);
    }
}
