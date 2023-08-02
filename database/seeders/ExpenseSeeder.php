<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('expenses')->insert([
            [
                'employee_id' => 1,
                'description' => 'سحب مواصلات',
                'currency_id' => 2,
                'amount' =>  3.00,
                'draw_date' => '2023-07-23 5:00:00',
                'is_from_masa' => false,

            ],
            [
                'employee_id' => null,
                'description' => 'تم سحب مبلغ بقيمة 150 شيكل لاثاث المحل',
                'amount' =>  150.00,
                'currency_id' => 2,
                'draw_date' => '2023-07-23 8:00:00',
                'is_from_masa' => true,

            ],
            [
                'employee_id' => 1,
                'description' => 'سحب فطور',
                'currency_id' => 2,
                'amount' =>  5.00,
                'draw_date' => '2023-07-23 3:00:00',
                'is_from_masa' => false,

            ],
            [
                'employee_id' => 2,
                'description' => 'سحب غذاء',
                'currency_id' => 2,
                'amount' =>  10.00,
                'draw_date' => '2023-07-23 11:00:00',
                'is_from_masa' => false,

            ],
        ]);

    }
}
