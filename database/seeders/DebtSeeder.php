<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Debt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DebtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencyIds = Currency::pluck('id')->toArray();

        $debts = [
            [
                'person_name' => 'John Doe',
                'amount' => 1000.00,
                'debt_date' => '2023-07-29 08:30:00',
                'is_debt_from_others' => true,
                'currency_id' => $currencyIds[array_rand($currencyIds)],
                'is_paid' => false,
                'weight' => null,
                'phone_number' => '0567086704',
            ],
            [
                'person_name' => 'Jane Smith',
                'amount' => 500.50,
                'debt_date' => '2023-07-30 14:15:00',
                'is_debt_from_others' => false,
                'currency_id' => $currencyIds[array_rand($currencyIds)],
                'is_paid' => false,
                'weight' => null,
                'phone_number' => '0598325681',


            ],
            [
                'person_name' => 'Jane Smith',
                'amount' => 300.50,
                'debt_date' => '2023-07-30 14:15:00',
                'is_debt_from_others' => false,
                'currency_id' => $currencyIds[array_rand($currencyIds)],
                'is_paid' => false,
                'weight' => null,
                'phone_number' => '0598325681',


            ],
            [
                'person_name' => 'Jane Smith',
                'amount' => null,
                'debt_date' => '2023-07-30 14:15:00',
                'is_debt_from_others' => true,
                'currency_id' => null,
                'is_paid' => false,
                'weight' => 150.00,
                'phone_number' => '0598325681',

            ],
            [
                'person_name' => 'Jane Smith',
                'amount' => 200.50,
                'debt_date' => '2023-07-30 14:15:00',
                'is_debt_from_others' => false,
                'currency_id' => $currencyIds[array_rand($currencyIds)],
                'is_paid' => false,
                'weight' => null,
                'phone_number' => '0598325681',


            ],
            [
                'person_name' => 'Jane Smith',
                'amount' => 900.50,
                'debt_date' => '2023-07-30 14:15:00',
                'is_debt_from_others' => true,
                'currency_id' => $currencyIds[array_rand($currencyIds)],
                'is_paid' => false,
                'weight' => null,
                'phone_number' => '0598325681',


            ],
        ];

        Debt::insert($debts);
    }

}
