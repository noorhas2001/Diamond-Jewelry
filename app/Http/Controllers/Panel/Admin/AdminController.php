<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Category;
use App\Models\Course;
use App\Models\FeatureFlag;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Console\Application;
use Illuminate\View\Factory;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('permission:'.DEFAULT_PANEL_PERMISSION)->only('index');
    }
    public function index(): Factory|View|Application
    {
        $now = now();

        $countPendingCourses = Course::whereHas('reservationTimes', function ($query) {
            $query->where('reservation_times.end_time', '>', now());
        })->count();


        $countFinishedCourses = Course::whereHas('reservations', function ($query) {
            $query->whereHas('reservationTimes', function ($subQuery) {
                $subQuery->where('end_time', '<=' , now());
            });
        })->orWhereDoesntHave('reservations')->orWhereDoesntHave('reservations.reservationTimes')->count();


        $countAvailableResources = Resource::whereDoesntHave('reservations', function ($query) {
            $query->whereHas('reservationTimes', function ($subQuery) {
                $subQuery->where('status', true);
            });
        })->orWhereDoesntHave('reservations')->count();

        $countReservedResources = Resource::whereHas('reservationTimes', function ($query) {
            $query->where('reservation_times.status', true);
        })->count();


        $counts = [
            'categoriesCount' => Category::count(),
            'resourcesCount' => Resource::count(),
            'coursesCount' => Course::count(),
            'usersCount' => User::where('user_type', 'user')->count(),
            'countPendingCourses' => $countPendingCourses,
            'countFinishedCourses' => $countFinishedCourses,
            'countAvailableResources' => $countAvailableResources,
            'countReservedResources' => $countReservedResources,
        ];

        $percentPending = function ($total, $pending) {
            return ($total > 0) ? round(($pending / $total) * 100) : 0;
        };

        $counts['percentageCourses'] = $percentPending($counts['coursesCount'], $counts['countPendingCourses']);
        $counts['percentageResources'] = $percentPending($counts['resourcesCount'], $counts['countAvailableResources']);

        $balanceQuery = Balance::query();
        $balances = [
            'Balance' => $balanceQuery
                ->join('currencies', 'balances.currency_id', '=', 'currencies.id')
                ->selectRaw('SUM(balances.amount * currencies.exchange_rate) as dollar_balance')
                ->value('dollar_balance'),
            'TotalWeeklyBalance' => $balanceQuery->whereBetween('balances.created_at', [now()->subDays(WEEK), now()])->sum('balances.amount'),
            'TotalMonthlyBalance' => $balanceQuery->whereMonth('balances.created_at', $now->month)->sum('balances.amount'),
            'resourceBalance' => $balanceQuery->where('balances.payment_type', 'resource')->sum('balances.amount'),
            'ResourceWeeklyBalance' => $balanceQuery
                ->where('balances.payment_type', 'resource')
                ->whereBetween('balances.created_at', [now()->subDays(WEEK), now()])
                ->sum('balances.amount'),
            'ResourceMonthlyBalance' => $balanceQuery
                ->where('balances.payment_type', 'resource')
                ->whereMonth('balances.created_at', $now->month)
                ->sum('balances.amount'),
            'courseBalance' => $balanceQuery->where('balances.payment_type', 'course')->sum('balances.amount'),
            'CourseWeeklyBalance' => $balanceQuery
                ->where('balances.payment_type', 'course')
                ->whereBetween('balances.created_at', [now()->subDays(WEEK), now()])
                ->sum('balances.amount'),
            'CourseMonthlyBalance' => $balanceQuery
                ->where('balances.payment_type', 'course')
                ->whereMonth('balances.created_at', $now->month)
                ->sum('balances.amount'),
        ];

        $features = FeatureFlag::where('name', 'chart_feature')->where('enabled', 1)->first();

        return view('admin.dashboard.index', compact('counts', 'balances', 'features'));
    }
}
