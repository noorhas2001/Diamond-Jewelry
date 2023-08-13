<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoldTransactionSeeder extends Seeder
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
                'gold_delar_id' => '1',
                'weight' => 100.00,
                'workmanship' => 2,
                'transaction_type' => 'دفعة',
                'item' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'gold_delar_id' => '2',
                'weight' => 100.00,
                'workmanship' => 2,
                'transaction_type' => 'استلام',
                'item' => 'اساور',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('gold_transactions')->insert($data);
    }
}
