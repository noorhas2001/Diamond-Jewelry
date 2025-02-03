<?php

use App\Http\Controllers\FeatureFlagController;
use App\Http\Controllers\Panel\Admin\AdminController;
use App\Http\Controllers\Panel\Admin\ContributorController;
use App\Http\Controllers\Panel\Admin\CurrencyDelarController;
use App\Http\Controllers\Panel\Admin\DebtController;
use App\Http\Controllers\Panel\Admin\DebtTransactionController;
use App\Http\Controllers\Panel\Admin\DepositController;
use App\Http\Controllers\Panel\Admin\EmployeeController;
use App\Http\Controllers\Panel\Admin\ExpensesController;
use App\Http\Controllers\Panel\Admin\GoldDelarController;
use App\Http\Controllers\Panel\Admin\GoldTransactionController;
use App\Http\Controllers\Panel\Admin\InventoryController;
use App\Http\Controllers\Panel\Admin\LanguageController;
use App\Http\Controllers\Panel\Admin\TransactionController;
use App\Http\Controllers\Panel\Admin\WithdrawalController;
use App\Http\Controllers\RestrectedPageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::prefix('dashboard/admin/')->group(function () {
    Route::middleware(['auth', 'verified'])->group(static function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::get('/features', [FeatureFlagController::class, 'index'])->name('features.index');
        Route::put('/features/update', [FeatureFlagController::class, 'update'])->name('features.update');
        Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');
        Route::resource('roles', RoleController::class);
        Route::resource('staffs', StaffController::class);
        Route::post('/staffs/deleteSelected', [StaffController::class, 'deleteSelected'])->name('staffs.deleteSelected');
        Route::resource('employees', EmployeeController::class);
        Route::post('/employees/deleteSelected', [EmployeeController::class, 'deleteSelected'])->name('employees.deleteSelected');

        Route::prefix('debts')->group(function () {
            Route::post('/store_on_us', [DebtController::class, 'store_on_us'])->name('debts.store_on_us');
            Route::post('/store_for_us', [DebtController::class, 'store_for_us'])->name('debts.store_for_us');
            Route::get('/show/{id}', [DebtController::class, 'show'])->name('debts.show');
            Route::DELETE('/destroy/{id}', [DebtController::class, 'destroy'])->name('debts.destroy');
            Route::put('/update/{id}', [DebtController::class, 'update'])->name('debts.update');
            Route::get('/onUs', [DebtController::class, 'debtsOnUs'])->name('debts.onUs');
            Route::get('/forUs', [DebtController::class, 'debtsForUs'])->name('debts.forUs');
            Route::post('/verifiedDebt/{id}', [DebtController::class, 'verifiedDebt'])->name('debts.verifiedDebt');
            Route::post('/deleteSelected', [DebtController::class, 'deleteSelected'])->name('debts.deleteSelected');

        });

        Route::resource('debt_transactions', DebtTransactionController::class);
        Route::post('debts/show/debt_transactions/deleteSelected', [DebtTransactionController::class, 'deleteSelected'])->name('debt_transactions.deleteSelected');

        Route::prefix('expenses')->group(function () {
            Route::get('/expenses', [ExpensesController::class, 'expenses'])->name('expenses.index');
            Route::get('/masa_expenses', [ExpensesController::class, 'masa_expenses'])->name('expenses.from_masa');
            Route::post('/store', [ExpensesController::class, 'store'])->name('expenses.store');
            Route::post('/store_from_masa', [ExpensesController::class, 'store_from_masa'])->name('expenses.store_from_masa');
            Route::get('/show/{id}', [ExpensesController::class, 'show'])->name('expenses.show');
            Route::put('/update/{id}', [ExpensesController::class, 'update'])->name('expenses.update');
            Route::DELETE('/destroy/{id}', [ExpensesController::class, 'destroy'])->name('expenses.destroy');
            Route::post('/deleteSelected', [ExpensesController::class, 'deleteSelected'])->name('expenses.deleteSelected');
        });

        Route::resource('withdrawals', WithdrawalController::class);
        Route::post('/withdrawals/deleteSelected', [WithdrawalController::class, 'deleteSelected'])->name('withdrawals.deleteSelected');

        Route::resource('transactions', TransactionController::class);

        Route::resource('currency_delars', CurrencyDelarController::class);
        Route::post('/currency_delars/deleteSelected', [CurrencyDelarController::class, 'deleteSelected'])->name('currency_delars.deleteSelected');
        Route::post('currency_delars/transactions/deleteSelected', [TransactionController::class, 'deleteSelected'])->name('transactions.deleteSelected');

        Route::resource('contributors', ContributorController::class);
        Route::post('/contributors/deleteSelected', [ContributorController::class, 'deleteSelected'])->name('contributors.deleteSelected');
        Route::post('contributors/transactions/deleteSelected', [TransactionController::class, 'deleteSelected'])->name('transactions.deleteSelected1');

        Route::get('/safe', [RestrectedPageController::class, 'showSafePage'])->name('safe-page')
            ->middleware('password.confirm');
        Route::post('/check-password', [RestrectedPageController::class, 'checkPassword'])->name('check-password');

        Route::resource('deposits', DepositController::class);
        Route::post('/deposits/deleteSelected', [DepositController::class, 'deleteSelected'])->name('deposits.deleteSelected');

        Route::resource('gold_delars', GoldDelarController::class);
        Route::post('/gold_delars/deleteSelected', [GoldDelarController::class, 'deleteSelected'])->name('gold_delars.deleteSelected');

        Route::resource('gold_transactions', GoldTransactionController::class);
        Route::post('gold_delars/gold_transactions/deleteSelected', [GoldTransactionController::class, 'deleteSelected'])->name('gold_transactions.deleteSelected');

        Route::resource('inventories', InventoryController::class);
        Route::post('inventories/deleteSelected', [InventoryController::class, 'deleteSelected']);
    });
});
