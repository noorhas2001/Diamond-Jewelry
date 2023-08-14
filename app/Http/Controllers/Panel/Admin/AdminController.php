<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Category;
use App\Models\Course;
use App\Models\Employee;
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
        return view('admin.dashboard.index');
    }
}
