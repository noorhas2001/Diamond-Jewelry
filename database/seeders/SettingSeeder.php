<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::updateOrCreate(['name' => 'site_number'], ['value' => '0569465030']);
        Setting::updateOrCreate(['name' => 'site_email'], ['value' => 'info@example.com']);
        Setting::updateOrCreate(['name' => 'update_currency_online'], ['value' => '1']);

        Setting::updateOrCreate(['name' => 'admin_plan'], ['value' => '1']);
        Setting::updateOrCreate(['name' => 'user_plan'], ['value' => '2']);
        Setting::updateOrCreate(['name' => 'company_plan'], ['value' => '3']);
    }
}
