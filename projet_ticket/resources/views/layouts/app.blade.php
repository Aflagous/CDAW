<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/websocket.js', 'resources/js/app.js', 'resources/js/jeu.js'])
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/websocket.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        
        <script src="http://localhost:6001/socket.io/socket.io.js"></script>

        
    </head>
    <body class="font-sans antialiased flex flex-col gap-10">
        @yield('page')
    </body>

</html>
