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
            'name' => DOLLAR,
        ]);
        $dollar->save();
        // Create a currency instance for shekels
        $shekel = new Currency([
            'name' => SHEKEL,
        ]);
        $shekel->save();

        // Create a currency instance for dinaries
        $dinar = new Currency([
            'name' => DINAR,
        ]);
        $dinar->save();

    }
}
