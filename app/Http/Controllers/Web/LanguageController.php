<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function change($locale = null)
    {
        if (! in_array($locale, config('app.available_locales'))) {
            abort(404, 'Locale not available');
        }

        session(['locale' => $locale]);

        return back();
    }
}
