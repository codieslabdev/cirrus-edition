<?php

namespace App\Http\Controllers\TenantUser;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::get();
        return view('tenantUser.customers.index',['customers'=>$customers]);
    }

    function create() {
        return view('tenantUser.customers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'phone' => 'required|unique:customers,phone',
        ]);
        $customer = Customer::create($validatedData);
        return redirect()->route('customers.index');
    }
}
