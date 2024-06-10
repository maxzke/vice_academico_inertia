<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Muebleria') }}</title>
        
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('assets/css/bunny.css') }}">
         <!--Font Awesome Solid + Brands -->
        <link href="{{ asset('assets/fontawesome/css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/fontawesome/css/brands.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/fontawesome/css/solid.css') }}" rel="stylesheet">
        <!-- alertify -->
        <link rel="stylesheet" href="{{ asset('assets/css/alertify/alertify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/alertify/themes/default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/vue-multiselect.css') }}">
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans leading-none text-gray-700 antialiased font-thin">
        @inertia
        <script type="text/javascript" src="{{ asset('assets/js/alertify.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
    </body>
</html>
