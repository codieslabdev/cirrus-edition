{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Your-Attractive-Font', sans-serif; /* Replace 'Your-Attractive-Font' with the desired font */
            background-color: #f4f4f4; /* Set a background color if needed */
        }

        .center-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh; /* Ensure the container takes at least the full height of the viewport */
        }

        h1 {
            font-size: 2em; /* Adjust the font size as needed */
            color: #333; /* Set the desired text color */
        }
    </style>
</head>
<body>

<div class="center-container">
    <h1>Hello {{tenant('name')}}</h1>
    <h1>This is your multi-tenant application.</h1>
    <h1>The id of the current tenant is {{tenant('id')}}</h1>
    <div>
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

</body>
</html> --}}

@extends('layouts.tenantUser.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    {{-- @dump(tenant()) --}}
                    <div class="m-3">
                        <h3>Hello {{tenant('name')}}</h3>
                        {{-- <h3>This is your multi-tenant application.</h3>
                        <h3>The id of the current tenant is <br/> {{tenant('id')}}</h3> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



