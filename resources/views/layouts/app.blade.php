<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RGP') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@2.2.4/dist/tailwind.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100">
<div id="app">
    @include('layouts.navigation')

    <main class="py-4">
        @yield('content')
    </main>
</div>
@if(session()->has('success'))
    <div class="fixed bottom-0 right-0 m-8 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg">
        {{ session()->get('success') }}
    </div>
    @elseif(session()->has('error'))
    <div class="fixed bottom-0 right-0 m-8 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg">
        {{ session()->get('error') }}
    </div>
@endif
</body>
</html>
