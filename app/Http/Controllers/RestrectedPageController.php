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
use App\Models\Inventory;
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

        return redirect(route('safe-page'));
    }

    private function collectData(): array
    {
        return [
            'UserNumber' => User::count(),
            'employeesNum' => Employee::count(),
            'features' => $this->getEnabledFeature(),
            'totalWeight' => Inventory::sum('total_weight'),
            'totalWithdrawals' => Withdrawal::sum('amount'),
            'totalCurrencyDelarShekelBalance' => CurrencyDelar::sum('shekels_balance'),
            'totalCurrencyDelarDinarBalance' => CurrencyDelar::sum('dinars_balance'),
            'totalCurrencyDelarDolarBalance' => CurrencyDelar::sum('dollars_balance'),
            'totalGoldDelarTotalWeight' => GoldDelar::sum('total_weight'),
            'totalGoldDelarTotalWorkshipman' => GoldDelar::sum('total_workmanship'),
            'totalContributorsShekelBalance' => Contributor::sum('shekels_balance'),
            'totalContributorsDollarBalance' => Contributor::sum('dollars_balance'),
            'totalContributorsDinarBalance' => Contributor::sum('dinars_balance'),
            'totalDollarsMasaWithdrawals' => $this->getMasaWithdrawals(1),
            'totalShekelsMasaWithdrawals' => $this->getMasaWithdrawals(2),
            'totalDinarsMasaWithdrawals' => $this->getMasaWithdrawals(3),
            'totalDollarsMasaDeposits' => Deposit::where('currency_id', 1)->sum('amount'),
            'totalShekelsMasaDeposits' => Deposit::where('currency_id', 2)->sum('amount'),
            'totalDinarsMasaDeposits' => Deposit::where('currency_id', 3)->sum('amount'),
            'totalWeightDebtsOnUs' => Debt::where('is_debt_from_others', 1)->sum('weight'),
            'totalDollarDebtsOnUs' => $this->getDebtsOnUs(1),
            'totalShekelDebtsOnUs' => $this->getDebtsOnUs(2),
            'totalDinarDebtsOnUs' => $this->getDebtsOnUs(3),
            'totalWeightDebtsForUs' => Debt::where('is_debt_from_others', 0)->sum('weight'),
            'totalDollarDebtsForUs' => $this->getDebtsForUs(1),
            'totalShekelDebtsForUs' => $this->getDebtsForUs(2),
            'totalDinarDebtsForUs' => $this->getDebtsForUs(3),

            'totalExpenses' => Expense::where('is_from_masa', 0)->sum('amount'),
            
            'drinks' => Expense::where('is_from_masa', 0)
            ->where('description' ,'مشروبات')->sum('amount'),
            'meals' => Expense::where('is_from_masa', 0)
            ->where('description' ,'وجبات طعام')->sum('amount'),
            'purchases' => Expense::where('is_from_masa', 0)
            ->where('description' ,'مشتريات')->sum('amount'),
            'Internet' => Expense::where('is_from_masa', 0)
            ->where('description' ,'انترنت')->sum('amount'),
            'electricity' => Expense::where('is_from_masa', 0)
            ->where('description' ,'كهرباء')->sum('amount'),
            'Generator' => Expense::where('is_from_masa', 0)
            ->where('description' ,'مولد')->sum('amount'),
            'maintenance' => Expense::where('is_from_masa', 0)
            ->where('description' ,'صيانة')->sum('amount'),
            'GoldMaintenance' => Expense::where('is_from_masa', 0)
            ->where('description' ,'صيانة ذهب')->sum('amount'),
            'otherwise' => Expense::where('is_from_masa', 0)
            ->where('description' ,'غير ذلك')->sum('amount'),
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

    private function getDebtsOnUs(int $currencyId): float
    {
        return Debt::where('currency_id', $currencyId)->where('is_debt_from_others', 1)->sum('amount');
    }

    private function getDebtsForUs(int $currencyId): float
    {
        return Debt::where('currency_id', $currencyId)->where('is_debt_from_others', 0)->sum('amount');
    }
}
