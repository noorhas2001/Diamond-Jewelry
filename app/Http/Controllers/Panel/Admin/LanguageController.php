<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    function switchLang($lang): Redirector|RedirectResponse|Application
    {
        if (array_key_exists($lang, Config::get(LANGUAGE))) {
            Session::put(APP_LOCALE, $lang);
            Cookie::queue(Cookie::forever(APP_LOCALE, $lang));
        }
        return redirect(url()->previous());
    }
}
