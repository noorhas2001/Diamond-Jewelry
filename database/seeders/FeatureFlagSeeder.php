<?php

namespace Database\Seeders;

use App\Models\FeatureFlag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureFlagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeatureFlag::query()->insert(
            [
                [
                    'name' => 'otp_phone',
                    'enabled' => true,
                ],
                [
                    'name' => 'chart_feature',
                    'enabled' => true,
                ],
            ]
        );
    }
}
