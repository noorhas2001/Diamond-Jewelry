<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyDelarSeeder extends Seeder
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
                'name' => 'يوسف ابو الروس',
                'phone' => '0598395320',
                'shekels_balance' => 1000.00,
                'dollars_balance' => 500.00,
                'dinars_balance' => 750.00,
                'notes' => 'تم سحب مبالغ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'جمال زهير ابو هاشم',
                'phone' => '0567086704',
                'shekels_balance' => 1500.00,
                'dollars_balance' => 600.00,
                'dinars_balance' => 400.00,
                'notes' => 'تم سحب مبالغ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'كرم فضل عاشور',
                'phone' => '0587521808',
                'shekels_balance' => 350.00,
                'dollars_balance' => 650.00,
                'dinars_balance' => 900.00,
                'notes' => 'تم سحب مبالغ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ضيف الله ابو سمهدانة',
                'phone' => '0567001210',
                'shekels_balance' => 200.00,
                'dollars_balance' => 150.00,
                'dinars_balance' => 250.00,
                'notes' => 'تم سحب مبالغ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more data entries here if needed
        ];

        DB::table('currency_delars')->insert($data);
    }
}
