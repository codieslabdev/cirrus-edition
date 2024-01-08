<?php

namespace App\Http\Controllers\TenantUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantUserController extends Controller
{
    public function index()
    {
        return view('tenantUser.index');
    }
}
