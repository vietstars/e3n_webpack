<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('run', function () {

    $description = 'Starting application...';
    // Start application
    $appUrl = config('app.url');
    $appUrlArr = explode(':', $appUrl);
    $appPort = end($appUrlArr) ?? '80';

    // Open the application in the browser.
    exec('open '.$appUrl);
    exec('start '.$appUrl);
    exec('xdg-open '.$appUrl);

    $this->call('serve', [
        '--port' => $appPort
    ]);
});