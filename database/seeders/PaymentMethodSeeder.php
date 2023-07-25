<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $cache = PaymentMethod::query()->create(
            [
                'name' => 'Cache',
            ]
        );

        Setting::updateOrCreate(['name' => 'cache_payment_method_id'], ['value' => $cache->id]);
    }
}
