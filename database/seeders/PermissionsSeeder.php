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
            EMPLOYEES_MANAGEMENT_PERMISSION,
            EMPLOYEES_PERMISSION,
            CREATE_EMPLOYEE_PERMISSION,
            READ_EMPLOYEE_PERMISSION,
            UPDATE_EMPLOYEE_PERMISSION,
            DELETE_EMPLOYEE_PERMISSION,
            SETTINGS_MANAGEMENT_PERMISSION,
            SETTINGS_PERMISSION,
            CREATE_SETTING_PERMISSION,
            READ_SETTING_PERMISSION,
            UPDATE_SETTING_PERMISSION,
            DELETE_SETTING_PERMISSION,
            DEBTS_MANAGEMENT_PERMISSION,
            DEBTS_ON_US_PERMISSION,
            DEBTS_FOR_US_PERMISSION,
            CREATE_DEBT_PERMISSION,
            READ_DEBT_PERMISSION,
            UPDATE_DEBT_PERMISSION,
            DELETE_DEBT_PERMISSION,
            VERIFY_DEBT_PERMISSION,
            DRAWS_MANAGEMENT_PERMISSION,
            MASA_DRAWS_PERMISSION,
            EXPENSES_PERMISSION,
            CREATE_EXPENSE_PERMISSION,
            READ_EXPENSE_PERMISSION,
            UPDATE_EXPENSE_PERMISSION,
            DELETE_EXPENSE_PERMISSION,
            WITHDRAWALS_PERMISSION,
            CREATE_WITHDRAWAL_PERMISSION,
            READ_WITHDRAWAL_PERMISSION,
            UPDATE_WITHDRAWAL_PERMISSION,
            DELETE_WITHDRAWAL_PERMISSION,
            CURRENCY_DELARS_MANAGEMENT_PERMISSION,
            CURRENCY_DELARS_PERMISSION,
            CREAT_CURRENCY_DELAR_PERMISSION,
            READ_CURRENCY_DELAR_PERMISSION,
            UPDATE_CURRENCY_DELAR_PERMISSION,
            DELETE_CURRENCY_DELAR_PERMISSION,
            CREATE_TRANSACTIONS_CURRENCY_DELAR_PERMISSION,
            SAFE_MANAGEMENT_PERMISSION,
            SAFE_PERMISSION,
            DEPOSITS_MANAGEMENT_PERMISSION,
            DEPOSITS_PERMISSION,
            CREATE_DEPOSIT_PERMISSION,
            READ_DEPOSIT_PERMISSION,
            UPDATE_DEPOSIT_PERMISSION,
            DELETE_DEPOSIT_PERMISSION,
            CONTRIBUTORS_MANAGEMENT_PERMISSION,
            CONTRIBUTORS_PERMISSION,
            CREAT_CONTRIBUTOR_PERMISSION,
            READ_CONTRIBUTOR_PERMISSION,
            UPDATE_CONTRIBUTOR_PERMISSION,
            DELETE_CONTRIBUTOR_PERMISSION,
            CREATE_TRANSACTIONS_CONTRIBUTOR_PERMISSION,
            GOLD_DELARS_MANAGEMENT_PERMISSION,
            GOLD_DELARS_PERMISSION,
            CREAT_GOLD_DELAR_PERMISSION,
            READ_GOLD_DELAR_PERMISSION,
            UPDATE_GOLD_DELAR_PERMISSION,
            DELETE_GOLD_DELAR_PERMISSION,
            CREATE_TRANSACTIONS_GOLD_DELAR_PERMISSION,
            CREATE_DEBT_TRANSACTIONS_PERMISSION,
            DELETE_DEBT_TRANSACTIONS_PERMISSION,
            INVENTORY_MANAGEMENT_PERMISSION,
            INVENTORY_PERMISSION,
            CREATE_INVENTORY_PERMISSION,
            DELETE_INVENTORY_PERMISSION,
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
