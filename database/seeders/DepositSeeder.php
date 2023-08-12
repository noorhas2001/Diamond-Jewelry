<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deposits')->insert([
            [
                'notes' => 'بيع اسوارة',
                'currency_id' => 3,
                'amount' =>  300,
                'deposit_date' => '2023-07-23 5:00:00',
            ],
            [
                'notes' => 'بيع خاتم',
                'currency_id' => 3,
                'amount' =>  500,
                'deposit_date' => '2023-07-23 5:00:00',
            ],
            [
                'notes' => 'بيع حلق',
                'currency_id' => 3,
                'amount' =>  250,
                'deposit_date' => '2023-07-23 5:00:00',
            ],
        ]);
    }
}
