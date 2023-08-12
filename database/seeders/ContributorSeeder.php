<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContributorSeeder extends Seeder
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
                'name' => 'خالد عبد القادر',
                'phone' => '0598395320',
                'shekels_balance' => 1000.00,
                'dollars_balance' => 500.00,
                'dinars_balance' => 750.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'محمد محمود',
                'phone' => '0567086704',
                'shekels_balance' => 1500.00,
                'dollars_balance' => 600.00,
                'dinars_balance' => 400.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('contributors')->insert($data);
    }
}
