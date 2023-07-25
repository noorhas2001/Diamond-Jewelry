<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        // Create a currency instance for dollars
        $dollar = new Currency([
            'name' => 'US Dollar',
            'symbol' => '$',
            'exchange_rate' => 1.0, // assuming the base currency is dollars
            'status' => 1,
            'code' => 'USD',
        ]);
        $dollar->save();
        $dollar->updateExchangeRate();

        // Create a currency instance for shekels
        $shekel = new Currency([
            'name' => 'Israeli Shekel',
            'symbol' => '₪',
            'exchange_rate' => 0.29, // assuming 1 dollar = 3.45 shekels
            'status' => 1,
            'code' => 'ILS',
        ]);
        $shekel->save();
        $shekel->updateExchangeRate();

    }
}
