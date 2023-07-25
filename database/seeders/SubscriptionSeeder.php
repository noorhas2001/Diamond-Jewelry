<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    for ($i = 1; $i <= 25; $i++) {
        Subscription::create([
            'status' => Subscription::CONFIRMED,
            'user_id' => User::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            'price' => 0.0, // Set the desired price
            'isBasePrice' => true,
            'is_verified_payment' => false,
            'payment_method_id' => 1,
        ]);
    }
}
}
