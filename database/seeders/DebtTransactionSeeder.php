<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DebtTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'person_id' => 1,
                'transaction_type' => 'سداد',
                'amount' => 0.00,
                'weight' => 50.00,
                'date' => '2023-08-07 12:00:00',
                'notes' => 'سداد مبلغ جزئي',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 1,
                'transaction_type' => 'سحب',
                'amount' => 50,
                'weight' => 0.00,
                'date' => '2023-08-07 12:00:00',
                'notes' => 'سداد مبلغ جزئي',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more transactions here if needed
        ];

        DB::table('debt_transactions')->insert($transactions);
    }
}
