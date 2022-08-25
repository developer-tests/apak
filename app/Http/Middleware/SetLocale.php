<?php


namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Config;

class SetLocale
{
    // ...
    private $locales = ['it', 'en'];

    // ...
    // public function handle($request, Closure $next)
    // {
    //     if(in_array($request->segment(1),$this->locales)){
    //         app()->setLocale($request->segment(1));
    //     }
    //     return $next($request);
    // }

      public function handle($request, Closure $next)
    { //dd(session()->get('locale'));
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }

        return $next($request);
    }

    // public function handle($request, Closure $next)
    // {
    //     $raw_locale = $request->session()->get('locale');
    //     if (in_array($raw_locale, Config::get('app.locales'))) {
    //         $locale = $raw_locale;
    //     }
    //     else $locale = Config::get('app.locale');
    //     App::setLocale($locale);
    //     return $next($request);
    // }
}


