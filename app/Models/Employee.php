<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'salary', 'bonuses', 'phone'];

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function employeeExpenses()
    {
        $totalExpenses = Expense::where('employee_id', '=', $this->id)
            ->sum('amount');

        return $totalExpenses;
    }

    public function salaryAfter()
    {
        $totalSalary = $this->salary - $this->employeeExpenses();
        return $totalSalary;
    }
}
