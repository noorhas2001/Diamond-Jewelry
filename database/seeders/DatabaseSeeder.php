<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CurrencySeeder::class,
            SettingSeeder::class,
            PermissionsSeeder::class,
            AdminSeeder::class,
            // BalanceSeeder::class,
            FeatureFlagSeeder::class,
        ]);
    }
}
