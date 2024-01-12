<?php

declare(strict_types=1);

use App\Models\Tenant;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // Route::get('/', function () {
    //     // dd(tenant('id')); //added
    //     // $tenant = Tenant::find(tenant('id'));
    //     // tenancy()->initialize($tenant);
    //     return tenant('name').', This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    // });

    // Route::get('/home', [App\Http\Controllers\TenantUser\TenantUserController::class, 'index'])->name('tenant.user.home');
});

Route::get('/home', [App\Http\Controllers\TenantUser\TenantUserController::class, 'index'])->name('tenant.user.home');
