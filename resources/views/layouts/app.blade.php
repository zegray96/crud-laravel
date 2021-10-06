<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} @yield('pageTitle')</title>

    @include('layouts.links')

</head>

<body>
    <div class="container-lg">
        <div class="row mt-4">
            <div class="col-12">
                @include('layouts.header')
                
                @yield('content')
            </div>
        </div>
    </div>

    @include('layouts.scripts')
</body>

</html>
