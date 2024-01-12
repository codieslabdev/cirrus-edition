@extends('layouts.tenantUser.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Hoverable Table rows -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Customer') }}
                        <a href="{{route('customers.create')}}" class="btn btn-sm btn-secondary ">Add Customer</a>
                    </div>

                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>City</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody class="table-border-bottom-0">
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{$customer->first_name}}</td>
                                    <td>{{$customer->last_name}}</td>
                                    <td>{{$customer->city}}</td>
                                    <td>{{$customer->phone}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Hoverable Table rows -->
            </div>
        </div>
    </div>
@endsection
