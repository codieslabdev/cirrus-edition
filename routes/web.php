<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect(route('login'));
    // return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::resource('tenants', TenantController:: class); //added

Route::middleware(["verifyTenant"])->group(function () {
    Route::get('/home', [App\Http\Controllers\TenantUser\TenantUserController::class, 'index'])->name('tenant.user.home');
});
