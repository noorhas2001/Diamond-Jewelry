<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
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
                'delar_id' => 1,
                'transaction_type' => 'استلام',
                'amount' => 1000.50,
                'currency_id' => 1,
                'date' => '2023-08-07 12:00:00',
                'notes' => 'Withdrawal for expenses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more transactions here if needed
        ];

        DB::table('transactions')->insert($transactions);
    }
}
