<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseRatingController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\UserReservationsController;
use App\Http\Controllers\BalanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth/user')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('Register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/courses/ratings', [CourseRatingController::class, 'rate']);
        Route::post('/edit-user-name', [AuthController::class, 'editUserName']);
        Route::post('/edit-user-phone', [AuthController::class, 'editUserPhone']);
        Route::post('/edit-user-password', [AuthController::class, 'editUserPassword']);
        Route::post('/reservations', [ReservationController::class, 'reserve']);
        Route::post('/reservations/cancel' , [ReservationController::class , 'cancelReservation']);
        Route::post('/subscriptions', [SubscriptionController::class, 'subscribe']);
        Route::post('/balances', [BalanceController::class, 'store']);
        Route::get('/user-profile', [UserProfileController::class, 'getUserProfile']);
        Route::get('/user-reservations', [ReservationController::class, 'getUserReservations']);
        Route::post('resource-reservations', [ReservationController::class , 'resourceReservations']);
        Route::get('/user-subscriptions', [SubscriptionController::class, 'getUserSubscriptions']);
        Route::get('/payment-methods/index', [PaymentMethodController::class, 'index']);
        Route::post('/fcm_token_update', [AuthController::class, 'fcm_token_update']);
        Route::get('/user-balance' ,[AuthController::class ,'getUserBalance']);
        Route::post('/search', [SearchController::class , 'search']);
        Route::get('/notifications' , [NotificationsController::class , 'getUserNotifications']);
    });
    Route::resource('/sliders', SliderController::class);
    Route::resource('/home', HomeController::class);
    Route::get('/resources', [ResourceController::class, 'index']);
    Route::post('/resource-details', [ResourceController::class, 'details']);
    Route::resource('/categories', CategoryController::class);
    Route::post('/category-details', [CategoryController::class, 'details']);
    Route::resource('/courses', CourseController::class);
    Route::post('/course-details', [CourseController::class, 'details']);

    Route::post('email-verification', [AuthController::class, 'emailVerification']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('send-email-verification-code', [AuthController::class, 'sendEmailVerificationCode']);
});













