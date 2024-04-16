<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <!-- PWA -->
        <meta name="theme-color" content="#0088bf" />
        <link rel="manifest" href="{{ asset('/manifest.json') }}" />
        <link rel="apple-touch-icon" href="{{ asset('logo.png') }}" />

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GE-Trouve</title>

        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body id="app">
{{--    <script src="{{ asset('/sw.js') }}"></script>--}}
{{--    <script>--}}
{{--        if(!navigator.serviceWorker.controller) {--}}
{{--            navigator.serviceWorker.register('/sw.js').then(function(reg) {--}}
{{--                console.log('Service worker has been registered for scope:'+ reg.scope);--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
    </body>
</html>
