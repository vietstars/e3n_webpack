<?php

use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true, 'login' => false, 'logout' => false, 'register' => false, 'reset' => false]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('web.home.index');
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});

Route::get('/', 'HomeController@welcome')->name('web.home.welcome');
Route::get('/change-language/{locale}', 'LanguageController@change')->name('change_language');

Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout')->name('logout');
Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'RegisterController@register');
Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'ConfirmPasswordController@confirm');
Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');