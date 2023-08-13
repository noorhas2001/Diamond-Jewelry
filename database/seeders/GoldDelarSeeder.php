<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoldDelarSeeder extends Seeder
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
                'name' => 'قصي الغرابلي',
                'total_weight' => 100.00,
                'total_workmanship' => 200.00,
                'phone_number' => '0567086704',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'احمد سامي الغرابلي',
                'total_weight' => 100.00,
                'total_workmanship' => 200.00,
                'phone_number' => '0599188054',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('gold_delars')->insert($data);
    }
}
