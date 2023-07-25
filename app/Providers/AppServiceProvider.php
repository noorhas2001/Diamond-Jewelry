<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Reservation;
use App\Models\Resource;
use App\Observers\CategoryObserver;
use App\Observers\CourseObserver;
use App\Observers\ReservationObserver;
use App\Observers\ResourceObserver;
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
        Paginator::useBootstrapFive();
        Category::observe(CategoryObserver::class);
        Resource::observe(ResourceObserver::class);
        Course::observe(CourseObserver::class);
        Reservation::observe(ReservationObserver::class);

    }
}
