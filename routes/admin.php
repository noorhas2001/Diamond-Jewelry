<?php


use App\Http\Controllers\FeatureFlagController;
use App\Http\Controllers\Panel\Admin\AdminController;
use App\Http\Controllers\Panel\Admin\LanguageController;
use App\Http\Controllers\Panel\Admin\SliderController;
use App\Http\Controllers\Panel\Admin\UserController;
use App\Http\Controllers\PlanController;
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

Route::prefix('dashboard/admin/')->group(static function () {
    Route::middleware(['auth', 'verified'])->group(static function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::get('/features', [FeatureFlagController::class, 'index'])->name('features.index');
        Route::put('/features/update', [FeatureFlagController::class, 'update'])->name('features.update');
        Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');
        Route::resource('roles', RoleController::class);
        Route::resource('staffs', StaffController::class);
        Route::post('/staffs/deleteSelected', [StaffController::class, 'deleteSelected'])->name('staffs.deleteSelected');
        Route::resource('plans', PlanController::class);
        Route::resource('users', UserController::class);
        Route::post('/users/deleteSelected', [UserController::class, 'deleteSelected'])->name('users.deleteSelected');
    });
});
