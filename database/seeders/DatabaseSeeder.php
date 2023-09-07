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
            EmployeeSeeder::class,
            // DebtSeeder::class,
            // ExpenseSeeder::class,
            // WithdrawalSeeder::class,
            CurrencyDelarSeeder::class,
            TransactionSeeder::class,
            ContributorSeeder::class,
            DepositSeeder::class,
            GoldDelarSeeder::class,
            // GoldTransactionSeeder::class,
            // DebtTransactionSeeder::class,
            // InventorySeeder::class,
        ]);
    }
}
