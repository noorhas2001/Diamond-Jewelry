<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Withdrawal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {

            Withdrawal::create([
                'employee_id' => $employee->id,
                'amount' => 50,
                'date' => now(),
                'notes' => 'يوسف سحب مبلغ ضروري'
            ]);
        }
    }
}
