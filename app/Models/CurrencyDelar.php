<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurrencyDelar extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'shekels_balance', 'dollars_balance', 'dinars_balance', 'notes'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'delar_id');
    }

    public function shekels_balance()
    {
        $income = $this->transactions()
            ->where('currency_id', 2)
            ->where('transaction_type', 'استلام')
            ->sum('amount');

        $expense = $this->transactions()
            ->where('currency_id', 2)
            ->where('transaction_type', 'دفعة')
            ->sum('amount');

        return $this->shekels_balance + $income - $expense;
    }

    public function dollars_balance()
    {
        $income = $this->transactions()
            ->where('currency_id', 1)
            ->where('transaction_type', 'استلام')
            ->sum('amount');

        $expense = $this->transactions()
            ->where('currency_id', 1)
            ->where('transaction_type', 'دفعة')
            ->sum('amount');

        return $this->dollars_balance + $income - $expense;
    }

    public function dinars_balance()
    {
        $income = $this->transactions()
            ->where('currency_id', 3)
            ->where('transaction_type', 'استلام')
            ->sum('amount');

        $expense = $this->transactions()
            ->where('currency_id', 3)
            ->where('transaction_type', 'دفعة')
            ->sum('amount');

        return $this->dinars_balance + $income - $expense;
    }

    public function current_balance()
    {
        $depositShekels = Deposit::where('currency_id', '2')->sum('amount');

        function getDebtTransactionSum($isDebtFromOther, $currencyId, $transactionType)
        {
            return Debt::where('is_debt_from_other', $isDebtFromOther)
                ->whereHas('debtTransactions', function ($query) use ($currencyId, $transactionType) {
                    $query->where('currency_id', $currencyId)
                        ->where('transaction_type', $transactionType);
                })
                ->get()
                ->sum(function ($debt) {
                    return $debt->debtTransactions->sum('amount');
                });
        }

        // Calculate sums for 'سداد' and 'سحب' transactions
        $deptOnUsShekelsTransactionSdad = getDebtTransactionSum(1, 2, 'سداد');
        $deptOnUsShekelsTransactionSaheb = getDebtTransactionSum(1, 2, 'سحب');

        $deptForUsShekelsTransactionSdad = getDebtTransactionSum(0, 2, 'سداد');
        $deptForUsShekelsTransactionSaheb = getDebtTransactionSum(0, 2, 'سحب');

        $employeeWithdrawals = Withdrawal::sum('amount');

        $goldDelarsTransactionsEstelam = GoldTransaction::where('transaction_type', 'استلام')->sum('workmanship');
        $goldDelarsTransactionsDofaa = GoldTransaction::where('transaction_type', 'دفعة')->sum('workmanship');

        $currencyDelarTransactionEstelam = Transaction::where('contributor_id', null)
            ->where('transaction_type', 'استلام')
            ->where('currency_id', '2')
            ->sum('amount');

        $currencyDelarTransactionDofaa = Transaction::where('contributor_id', null)
            ->where('transaction_type', 'دفعة')
            ->where('currency_id', '2')
            ->sum('amount');

        $contributorTransactionEstelam = Transaction::where('delar_id', null)
            ->where('transaction_type', 'استلام')
            ->where('currency_id', '2')
            ->sum('amount');

        $contributorTransactionDofaa = Transaction::where('delar_id', null)
            ->where('transaction_type', 'دفعة')
            ->where('currency_id', '2')
            ->sum('amount');

        $expenses = Expense::where('is_from_masa', '0')->where('currency_id', '2')->sum('amount');

        $masaExpenses = Expense::where('is_from_masa', '1')->where('currency_id', '2')->sum('amount');

        $finalValue = (
            $depositShekels +
            $deptOnUsShekelsTransactionSdad +
            $deptForUsShekelsTransactionSdad +
            $goldDelarsTransactionsEstelam +
            $currencyDelarTransactionEstelam +
            $contributorTransactionEstelam
        ) - (
            $deptOnUsShekelsTransactionSaheb +
            $deptForUsShekelsTransactionSaheb +
            $employeeWithdrawals +
            $goldDelarsTransactionsDofaa +
            $currencyDelarTransactionDofaa +
            $contributorTransactionDofaa +
            $expenses +
            $masaExpenses
        );

    }
}
