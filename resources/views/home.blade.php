@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        {{ __('You are logged in!') }}

                        <a href="{{route('tenants.index')}}" class="btn btn-secondary ">Tenants</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
