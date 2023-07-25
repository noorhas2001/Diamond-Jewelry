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
            PlanSeeder::class,
            AdminSeeder::class,
            CategorySeeder::class,
            ResourceSeeder::class,
            FeatureFlagSeeder::class,
            CourseSeeder::class,
            SliderSeeder::class,
//            RatingSeeder::class,
//            BalanceSeeder::class,
            PaymentMethodSeeder::class,
//            ReservationSeeder::class,
//            ReservationTimeSeeder::class,
//            SubscriptionSeeder::class,
        ]);
    }
}
