<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Currency;
use App\Models\Employee;
use App\Models\Reservation;
use App\Observers\CategoryObserver;
use App\Observers\CourseObserver;
use App\Observers\ReservationObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $employees = Employee::all();
            $currencies = Currency::all();

            $view->with(compact('employees', 'currencies'));
        });
    }
}
