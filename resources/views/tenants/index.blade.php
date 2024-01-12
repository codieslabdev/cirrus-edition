@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Company') }}
                    <a href="{{route('tenants.create')}}" class="btn btn-secondary ">Add Company</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Doamin</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $rowNumber = 1;
                            @endphp

                            @foreach ($tenants as $index => $tenant)
                                <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{$tenant->name}}</td>
                                <td>{{$tenant->email}}</td>
                                <td>
                                    @foreach ($tenant->domains as $domain)
                                        {{$domain->domain}} {{$loop->last ? '' : ','}}
                                    @endforeach
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger">Remove</button>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
