<?php

namespace App\Http\Controllers;

use App\Models\Contributor;
use App\Models\CurrencyDelar;
use App\Models\Debt;
use App\Models\Deposit;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\FeatureFlag;
use App\Models\GoldDelar;
use App\Models\GoldTransaction;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RestrectedPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . SAFE_PERMISSION)->only('showSafePage');
    }

    public function showSafePage(): View
    {
        $data = $this->collectData();

        return view('admin.dashboard.restrecated', $data);
    }

    public function checkPassword(Request $request): RedirectResponse
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            flash('كلمة المرور المدخلة غير صحيحة , الرجاء المحاولة مرة اخرى')->error();
            return back();
        }

        $request->session()->put('password_confirmed', true);

        return redirect(route('safe-page'));
    }

    private function collectData(): array
    {
        $currencyDelars = CurrencyDelar::all();
        $goldDelars = GoldDelar::all();
        $contributors = Contributor::all();

        // Start Current Shekels Balance
        $depositShekels = Deposit::where('currency_id', '2')->sum('amount');

        $employeeWithdrawals = Withdrawal::sum('amount');

        $debtOnUsSdadShekels = Debt::where('is_debt_from_others', '1')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سداد')
                    ->where('currency_id', 2);
            })
            ->get();

        $sumOnUsSdadShekels = $debtOnUsSdadShekels->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سداد')
                ->where('currency_id', '2')
                ->sum('amount');
        });

        $debtOnUsSahebShekels = Debt::where('is_debt_from_others', '1')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سحب')
                    ->where('currency_id', 2);
            })
            ->get();

        $sumOnUsSahebShekels = $debtOnUsSahebShekels->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سحب')
                ->where('currency_id', '2')
                ->sum('amount');
        });

        $debtForUsSdadShekels = Debt::where('is_debt_from_others', '0')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سداد')
                    ->where('currency_id', 2);
            })
            ->get();

        $sumForUsSdadShekels = $debtForUsSdadShekels->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سداد')
                ->where('currency_id', '2')
                ->sum('amount');
        });

        $debtForUsSahebShekels = Debt::where('is_debt_from_others', '0')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سحب')
                    ->where('currency_id', 2);
            })
            ->get();

        $sumForUsSahebShekels = $debtForUsSahebShekels->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سحب')
                ->where('currency_id', '2')
                ->sum('amount');
        });

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

        $finalShekelsValue = (
            $depositShekels +
            $currencyDelarTransactionEstelam +
            $contributorTransactionEstelam +
            $sumOnUsSahebShekels +
            $sumForUsSdadShekels
        ) - (
            $employeeWithdrawals +
            $currencyDelarTransactionDofaa +
            $contributorTransactionDofaa +
            $expenses +
            $sumOnUsSdadShekels +
            $sumForUsSahebShekels +
            $masaExpenses
        );
        // End Current Shekels Balance

        // Start Current Dollars Balance
        $depositDollars = Deposit::where('currency_id', '1')->sum('amount');

        $debtOnUsSdadDollars = Debt::where('is_debt_from_others', '1')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سداد')
                    ->where('currency_id', 1);
            })
            ->get();

        $sumOnUsSdadDollars = $debtOnUsSdadDollars->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سداد')
                ->where('currency_id', '1')
                ->sum('amount');
        });

        $debtOnUsSahebDollars = Debt::where('is_debt_from_others', '1')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سحب')
                    ->where('currency_id', 1);
            })
            ->get();

        $sumOnUsSahebDollars = $debtOnUsSahebDollars->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سحب')
                ->where('currency_id', '1')
                ->sum('amount');
        });

        $debtForUsSdadDollars = Debt::where('is_debt_from_others', '0')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سداد')
                    ->where('currency_id', 1);
            })
            ->get();

        $sumForUsSdadDollars = $debtForUsSdadDollars->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سداد')
                ->where('currency_id', '1')
                ->sum('amount');
        });

        $debtForUsSahebDollars = Debt::where('is_debt_from_others', '0')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سحب')
                    ->where('currency_id', 1);
            })
            ->get();

        $sumForUsSahebDollars = $debtForUsSahebDollars->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سحب')
                ->where('currency_id', '1')
                ->sum('amount');
        });

        $currencyDelarDollarsTransactionEstelam = Transaction::where('contributor_id', null)
            ->where('transaction_type', 'استلام')
            ->where('currency_id', '1')
            ->sum('amount');

        $currencyDelarDollarsTransactionDofaa = Transaction::where('contributor_id', null)
            ->where('transaction_type', 'دفعة')
            ->where('currency_id', '1')
            ->sum('amount');

        $contributorDollarsTransactionEstelam = Transaction::where('delar_id', null)
            ->where('transaction_type', 'استلام')
            ->where('currency_id', '1')
            ->sum('amount');

        $contributorDollarsTransactionDofaa = Transaction::where('delar_id', null)
            ->where('transaction_type', 'دفعة')
            ->where('currency_id', '1')
            ->sum('amount');

        $masaDollarsExpenses = Expense::where('is_from_masa', '1')->where('currency_id', '1')->sum('amount');

        $finalDollarsValue = (
            $depositDollars +
            $currencyDelarDollarsTransactionEstelam +
            $contributorDollarsTransactionEstelam +
            $sumOnUsSahebDollars +
            $sumForUsSdadDollars

        ) - (
            $currencyDelarDollarsTransactionDofaa +
            $contributorDollarsTransactionDofaa +
            $sumOnUsSdadDollars +
            $sumForUsSahebDollars +
            $masaDollarsExpenses
        );
        // End Current Dollars Balance

        // Start Current Dinars Balance
        $depositDinars = Deposit::where('currency_id', '3')->sum('amount');

        $debtOnUsSdadDinars = Debt::where('is_debt_from_others', '1')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سداد')
                    ->where('currency_id', '3');
            })
            ->get();

        $sumOnUsSdadDinars = $debtOnUsSdadDinars->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سداد')
                ->where('currency_id', '3')
                ->sum('amount');
        });

        $debtOnUsSahebDinars = Debt::where('is_debt_from_others', '1')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سحب')
                    ->where('currency_id', '3');
            })
            ->get();

        $sumOnUsSahebDinars = $debtOnUsSahebDinars->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سحب')
                ->where('currency_id', '3')
                ->sum('amount');
        });

        $debtForUsSdadDinars = Debt::where('is_debt_from_others', '0')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سداد')
                    ->where('currency_id', '3');
            })
            ->get();

        $sumForUsSdadDinars = $debtForUsSdadDinars->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سداد')
                ->where('currency_id', '3')
                ->sum('amount');
        });

        $debtForUsSahebDinars = Debt::where('is_debt_from_others', '0')
            ->whereHas('debt_transactions', function ($query) {
                $query->where('transaction_type', 'سحب')
                    ->where('currency_id', '3');
            })
            ->get();

        $sumForUsSahebDinars = $debtForUsSahebDinars->sum(function ($debt) {
            return $debt->debt_transactions
                ->where('transaction_type', 'سحب')
                ->where('currency_id', '3')
                ->sum('amount');
        });

        $goldDelarsDinarsTransactionsEstelam = GoldTransaction::where('transaction_type', 'استلام')->sum('workmanship');
        $goldDelarsDinarsTransactionsDofaa = GoldTransaction::where('transaction_type', 'دفعة')->sum('workmanship');

        $currencyDelarDinarsTransactionEstelam = Transaction::where('contributor_id', null)
            ->where('transaction_type', 'استلام')
            ->where('currency_id', '3')
            ->sum('amount');

        $currencyDelarDinarsTransactionDofaa = Transaction::where('contributor_id', null)
            ->where('transaction_type', 'دفعة')
            ->where('currency_id', '3')
            ->sum('amount');

        $contributorDinarsTransactionEstelam = Transaction::where('delar_id', null)
            ->where('transaction_type', 'استلام')
            ->where('currency_id', '3')
            ->sum('amount');

        $contributorDinarsTransactionDofaa = Transaction::where('delar_id', null)
            ->where('transaction_type', 'دفعة')
            ->where('currency_id', '3')
            ->sum('amount');

        $masaDinarsExpenses = Expense::where('is_from_masa', '1')->where('currency_id', '3')->sum('amount');

        $finalDinarsValue = (
            $depositDinars +
            $goldDelarsDinarsTransactionsEstelam +
            $currencyDelarDinarsTransactionEstelam +
            $contributorDinarsTransactionEstelam +
            $sumOnUsSahebDinars +
            $sumForUsSdadDinars

        ) - (
            $goldDelarsDinarsTransactionsDofaa +
            $currencyDelarDinarsTransactionDofaa +
            $contributorDinarsTransactionDofaa +
            $sumOnUsSdadDinars +
            $sumForUsSahebDinars +
            $masaDinarsExpenses
        );
        // End Current Dinars Balance


        return [
            'finalShekelsValue' => $finalShekelsValue,
            'finalDollarsValue' => $finalDollarsValue,
            'finalDinarsValue' => $finalDinarsValue,
            
            'UserNumber' => User::count(),
            'employeesNum' => Employee::count(),
            'features' => $this->getEnabledFeature(),
            'totalWeight' => Inventory::sum('total_weight'),
            'totalWorkManShip' => Inventory::sum('total_workmanship'),
            'totalWithdrawals' => Withdrawal::sum('amount'),
            'totalCurrencyDelarShekelBalance' => $currencyDelars->sum(function ($currencyDelar) {
                return $currencyDelar->shekels_balance();
            }),
            'totalCurrencyDelarDinarBalance' => $currencyDelars->sum(function ($currencyDelar) {
                return $currencyDelar->dinars_balance();
            }),
            'totalCurrencyDelarDolarBalance' => $currencyDelars->sum(function ($currencyDelar) {
                return $currencyDelar->dollars_balance();
            }),

            'totalGoldDelarTotalWeight' => $goldDelars->sum(function ($goldDelars) {
                return $goldDelars->totalWeight();
            }),
            'totalGoldDelarTotalWorkshipman' => $goldDelars->sum(function ($goldDelars) {
                return $goldDelars->totalWorkManShip();
            }),

            'totalContributorsShekelBalance' => $contributors->sum(function ($contributors) {
                return $contributors->shekels_balance();
            }),
            'totalContributorsDollarBalance' => $contributors->sum(function ($contributors) {
                return $contributors->dollars_balance();
            }),
            'totalContributorsDinarBalance' => $contributors->sum(function ($contributors) {
                return $contributors->dinars_balance();
            }),

            'totalDollarsMasaWithdrawals' => $this->getMasaWithdrawals(1),
            'totalShekelsMasaWithdrawals' => $this->getMasaWithdrawals(2),
            'totalDinarsMasaWithdrawals' => $this->getMasaWithdrawals(3),

            'totalDollarsMasaDeposits' => Deposit::where('currency_id', 1)->sum('amount'),
            'totalShekelsMasaDeposits' => Deposit::where('currency_id', 2)->sum('amount'),
            'totalDinarsMasaDeposits' => Deposit::where('currency_id', 3)->sum('amount'),

            'totalWeightDebtsOnUs' => Debt::where('is_debt_from_others', 1)->where('is_paid', 0)->get()
                ->sum->weight(),
            'totalDollarDebtsOnUs' => Debt::where('is_debt_from_others', 1)->where('is_paid', 0)->get()
                ->sum->dollars_balance(),
            'totalShekelDebtsOnUs' => Debt::where('is_debt_from_others', 1)->where('is_paid', 0)->get()
                ->sum->shekels_balance(),
            'totalDinarDebtsOnUs' => Debt::where('is_debt_from_others', 1)->where('is_paid', 0)->get()
                ->sum->dinars_balance(),

            'totalWeightDebtsForUs' => Debt::where('is_debt_from_others', 0)->where('is_paid', 0)->get()
                ->sum->weight(),
            'totalDollarDebtsForUs' => Debt::where('is_debt_from_others', 0)->where('is_paid', 0)->get()
                ->sum->dollars_balance(),
            'totalShekelDebtsForUs' => Debt::where('is_debt_from_others', 0)->where('is_paid', 0)->get()
                ->sum->shekels_balance(),
            'totalDinarDebtsForUs' => Debt::where('is_debt_from_others', 0)->where('is_paid', 0)->get()
                ->sum->dinars_balance(),

            'totalExpenses' => Expense::where('is_from_masa', 0)->sum('amount'),

            'drinks' => Expense::where('is_from_masa', 0)
                ->where('description', 'مشروبات')->sum('amount'),
            'meals' => Expense::where('is_from_masa', 0)
                ->where('description', 'وجبات طعام')->sum('amount'),
            'purchases' => Expense::where('is_from_masa', 0)
                ->where('description', 'مشتريات')->sum('amount'),
            'Internet' => Expense::where('is_from_masa', 0)
                ->where('description', 'انترنت')->sum('amount'),
            'electricity' => Expense::where('is_from_masa', 0)
                ->where('description', 'كهرباء')->sum('amount'),
            'Generator' => Expense::where('is_from_masa', 0)
                ->where('description', 'مولد')->sum('amount'),
            'maintenance' => Expense::where('is_from_masa', 0)
                ->where('description', 'صيانة')->sum('amount'),
            'GoldMaintenance' => Expense::where('is_from_masa', 0)
                ->where('description', 'صيانة ذهب')->sum('amount'),
            'otherwise' => Expense::where('is_from_masa', 0)
                ->where('description', 'غير ذلك')->sum('amount'),

        ];
    }

    private function getEnabledFeature(): ?FeatureFlag
    {
        return FeatureFlag::where('name', 'chart_feature')->where('enabled', 1)->first();
    }

    private function getMasaWithdrawals(int $currencyId): float
    {
        return Expense::where('is_from_masa', 1)->where('currency_id', $currencyId)->sum('amount');
    }
}
