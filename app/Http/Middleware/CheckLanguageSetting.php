<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Config;

class CheckLanguageSetting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = session('locale');
        if ($locale && in_array($locale, config('app.available_locales'))) {
            App::setLocale($locale);
        }
        Config::set('app.name', __('project.name'));
        if (config('mail.from.name') == 'Example') {
            Config::set('mail.from.name', __('project.name'));
        }

        return $next($request);
    }
}
