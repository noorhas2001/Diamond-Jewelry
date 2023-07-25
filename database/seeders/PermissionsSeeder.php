<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [
            DEFAULT_PANEL_PERMISSION,
            RESOURCES_MANAGEMENT_PERMISSION,
            RESOURCES_PERMISSION,
            CREATE_RESOURCE_PERMISSION,
            READ_RESOURCE_PERMISSION,
            UPDATE_RESOURCE_PERMISSION,
            DELETE_RESOURCE_PERMISSION,
            CATEGORIES_PERMISSION,
            CREATE_CATEGORY_PERMISSION,
            READ_CATEGORY_PERMISSION,
            UPDATE_CATEGORY_PERMISSION,
            DELETE_CATEGORY_PERMISSION,
            RESERVATIONS_MANAGEMENT_PERMISSION,
            RESERVATIONS_PERMISSION,
            CREATE_RESERVATION_PERMISSION,
            READ_RESERVATION_PERMISSION,
            UPDATE_RESERVATION_PERMISSION,
            DELETE_RESERVATION_PERMISSION,
            CANCEL_RESERVATION_PERMISSION,
            VERIFY_PAYMENT_RESERVATION_PERMISSION,
            CALENDAR_PERMISSION,
            CREATE_CALENDAR_PERMISSION,
            READ_CALENDAR_PERMISSION,
            UPDATE_CALENDAR_PERMISSION,
            DELETE_CALENDAR_PERMISSION,
            COURSES_MANAGEMENT_PERMISSION,
            COURSES_PERMISSION,
            CREATE_COURSE_PERMISSION,
            READ_COURSE_PERMISSION,
            UPDATE_COURSE_PERMISSION,
            DELETE_COURSE_PERMISSION,
            SUBSCRIPTIONS_PERMISSION,
            CREATE_SUBSCRIPTION_PERMISSION,
            READ_SUBSCRIPTION_PERMISSION,
            UPDATE_SUBSCRIPTION_PERMISSION,
            DELETE_SUBSCRIPTION_PERMISSION,
            CANCEL_SUBSCRIPTION_PERMISSION,
            VERIFY_PAYMENT_SUBSCRIPTION_PERMISSION,
            STAFFS_MANAGEMENT_PERMISSION,
            STAFFS_PERMISSION,
            CREATE_STAFF_PERMISSION,
            READ_STAFF_PERMISSION,
            UPDATE_STAFF_PERMISSION,
            DELETE_STAFF_PERMISSION,
            ROLES_PERMISSION,
            CREATE_ROLE_PERMISSION,
            READ_ROLE_PERMISSION,
            UPDATE_ROLE_PERMISSION,
            DELETE_ROLE_PERMISSION,
            PLANES_MANAGEMENT_PERMISSION,
            PLANES_PERMISSION,
            CREATE_PLANE_PERMISSION,
            READ_PLANE_PERMISSION,
            UPDATE_PLANE_PERMISSION,
            DELETE_PLANE_PERMISSION,
            USERS_MANAGEMENT_PERMISSION,
            USERS_PERMISSION,
            CREATE_USER_PERMISSION,
            READ_USER_PERMISSION,
            UPDATE_USER_PERMISSION,
            DELETE_USER_PERMISSION,
            SETTINGS_MANAGEMENT_PERMISSION,
            SLIDERS_PERMISSION,
            CREATE_SLIDER_PERMISSION,
            READ_SLIDER_PERMISSION,
            UPDATE_SLIDER_PERMISSION,
            DELETE_SLIDER_PERMISSION,
            SETTINGS_PERMISSION,
            CREATE_SETTING_PERMISSION,
            READ_SETTING_PERMISSION,
            UPDATE_SETTING_PERMISSION,
            DELETE_SETTING_PERMISSION,
        ];

        foreach ($permissions as $permission) {
            Permission::CREATE(['name' => $permission]);
        }
        $id = Role::CREATE(['name' => User::SUPER_ADMIN_ROLE])->givePermissionTo($permissions)->id;

        Setting::query()->create([
            'name' => ADMIN_ROLE,
            'value' => $id,
        ]);

        Role::CREATE(['name' => User::USER_ROLE])->givePermissionTo([DEFAULT_PANEL_PERMISSION]);
    }
}
