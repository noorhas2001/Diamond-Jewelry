<?php

namespace App\Observers;

use App\Models\Employee;

class EmployeeObserver
{
    public function deleting(Employee $employee): void
    {
        $this->deleteRelatedExpenses($employee);
        $this->deleteRealtedWithdrawals($employee);
    }

    private function deleteRelatedExpenses(Employee $employee): void
    {
        if ($employee->expenses->isNotEmpty()) {
            $employee->expenses()->delete();
        }
    }

    private function deleteRealtedWithdrawals(Employee $employee): void
    {
        if ($employee->withdrawals->isNotEmpty()) {
            $employee->withdrawals()->delete();
        }
    }
}
