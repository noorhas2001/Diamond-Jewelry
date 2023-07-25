<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run()
    {
        $id = $this->createPlan(
            name: 'admin_plan',
            description: 'every thing is allowed ',
            price: 100,
        );

        Setting::query()->create([
            'name' => ADMIN_PLAN,
            'value' => $id,
        ]);

        $this->createPlan(
            name: 'user_plan',
            description: ' no every is allowed ',
            price: 70,
        );

        $this->createPlan(
            name: 'company_plan',
            description: ' no every is allowed ',
            price: 50,
        );
    }

    public function createPlan($name, $description, $price)
    {
        $id = Plan::query()->create(
            [
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ]
        )->id;

        return $id;
    }
}
