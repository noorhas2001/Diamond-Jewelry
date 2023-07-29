<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employeesData = [
            [
                'name' => 'عبد الغرابلي',
                'salary' => 500.00,
                'bonuses' => 0.00,
                'phone' => '0567661000'
            ],
            [
                'name' => 'علي جربوع',
                'salary' => 500.00,
                'bonuses' => 0.50,
                'phone' => '0567661000'
            ],
        ];

        foreach ($employeesData as $data) {
            Employee::create($data);
        }
    }
}
