<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Vendors Style-->
        <!--<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">-->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
     
        <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}"> 

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <!--@vite(['resources/css/app.css', 'resources/js/app.js'])-->
        
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <!-- Vendor JS -->
        <!--<script src="{{ asset('backend/js/vendors.min.js') }}"></script>
        <script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}"></script>-->
    </body>
</html>
