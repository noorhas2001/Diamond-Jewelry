<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RestrectedPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . SAFE_PERMISSION)->only('showSafePage');
    }


    public function showSafePage()
    {
        return view('admin.dashboard.restrecated');
    }

    public function checkPassword(Request $request): RedirectResponse
    {
        // Validate the entered password
        if (!Hash::check($request->password, auth()->user()->password)) {
            flash('كلمة المرور المدخلة غير صحيحة , الرجاء المحاولة مرة اخرى')->error();
            return back();
        }

        // Password confirmed, return success response
        return redirect(route('safe-page'));
    }
}
