<?php


use App\Http\Controllers\FeatureFlagController;
use App\Http\Controllers\Panel\Admin\AdminController;
use App\Http\Controllers\Panel\Admin\CalendarController;
use App\Http\Controllers\Panel\Admin\CategoryController;
use App\Http\Controllers\Panel\Admin\CourseController;
use App\Http\Controllers\Panel\Admin\LanguageController;
use App\Http\Controllers\Panel\Admin\NotificationController;
use App\Http\Controllers\Panel\Admin\ReservationController;
use App\Http\Controllers\Panel\Admin\ResourceController;
use App\Http\Controllers\Panel\Admin\SliderController;
use App\Http\Controllers\Panel\Admin\SubscriptionController;
use App\Http\Controllers\Panel\Admin\UserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReservationTimeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Models\ReservationTime;
use App\Models\User;
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
        Route::resource('resources', ResourceController::class);
        Route::post(
            '/resources/deleteSelected',
            [ResourceController::class, 'deleteSelected']
        )->name('resources.deleteSelected');
        Route::resource('categories', CategoryController::class);
        Route::post(
            '/categories/deleteSelected',
            [CategoryController::class, 'deleteSelected']
        )->name('categories.deleteSelected');
        Route::resource('reservations', ReservationController::class);
        Route::DELETE(
            '/reservations/destroyFromCalendar/{id}',
            [ReservationController::class, 'destroyFromCalendar']
        )->name('reservations.destroyFromCalendar');
        Route::get(
            '/reservations/destroyShow/{id}',
            [ReservationController::class, 'destroyShow']
        )->name('reservations.destroyShow');
        Route::get('/reservations/cancel/{id}', [ReservationController::class, 'cancel'])->name('reservations.cancel');
        Route::post(
            '/reservations/deleteSelected',
            [ReservationController::class, 'deleteSelected']
        )->name('reservations.deleteSelected');
        Route::post('/reservations/verifiedReservationPayment/{id}', [
            ReservationController::class,
            'verifiedReservationPayment'
        ])->name('reservations.verifiedReservationPayment');
        Route::resource('courses', CourseController::class);
        Route::post('/courses/deleteSelected', [CourseController::class, 'deleteSelected'])->name('courses.deleteSelected');
        Route::get('/features', [FeatureFlagController::class, 'index'])->name('features.index');
        Route::put('/features/update', [FeatureFlagController::class, 'update'])->name('features.update');
        Route::resource('sliders', SliderController::class);
        Route::post('/sliders/deleteSelected', [SliderController::class, 'deleteSelected'])->name('sliders.deleteSelected');
        Route::resource('calendar', CalendarController::class);
        Route::get(
            'calendars/reservations',
            [CalendarController::class, 'reservations']
        )->name('calenders.reservations');
        Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');
        Route::resource('subscriptions', SubscriptionController::class);
        Route::resource('reservationsTime', ReservationTimeController::class);
        Route::get('/reservationsTime/cancel/{id}', [ReservationTimeController::class, 'cancel'])->name('reservationsTime.cancel');
        Route::get(
            '/subscriptions/destroyShow/{id}',
            [SubscriptionController::class, 'destroyShow']
        )->name('subscriptions.destroyShow');
        Route::post(
            '/subscriptions/deleteSelected',
            [SubscriptionController::class, 'deleteSelected']
        )->name('subscriptions.deleteSelected');
        Route::get(
            'subscriptions/cancel/{id}',
            [SubscriptionController::class, 'cancel']
        )->name('subscriptions.cancel');
        Route::post('/subscriptions/verifiedSubscriptionPayment/{id}', [
            SubscriptionController::class, 'verifiedSubscriptionPayment'
        ])->name('subscriptions.verifiedSubscriptionPayment');
        Route::resource('roles', RoleController::class);
        Route::resource('staffs', StaffController::class);
        Route::post('/staffs/deleteSelected', [StaffController::class, 'deleteSelected'])->name('staffs.deleteSelected');
        Route::resource('plans', PlanController::class);
        Route::resource('users', UserController::class);
        Route::post('/users/deleteSelected', [UserController::class, 'deleteSelected'])->name('users.deleteSelected');
        Route::get('/Notification/readOneNotification', [NotificationController::class, 'readOneNotification'])->name('Notification.readOneNotification');
        Route::get('/Notification/markAsRead', [NotificationController::class, 'markAsRead'])->name('Notification.markAsRead');
    });
});
