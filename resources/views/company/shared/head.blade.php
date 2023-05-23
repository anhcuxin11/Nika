<head>
    <title>@yield('title','NINJA')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link rel="shortcut icon" type="image/ico" href="{{ asset("images/favicon.ico") }}"> --}}
    @yield('meta')
        <link rel="stylesheet" href="{{ mix('css/company.css') }}">
    @stack('styles')
</head>
