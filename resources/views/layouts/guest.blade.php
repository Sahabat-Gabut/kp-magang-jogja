<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
        
        <link rel="shortcut icon" href="favico.ico">
        <link rel="stylesheet" href="{{ mix('/assets/css/guest.css') }}">
        <link rel="stylesheet" href="/assets/vendor/css/aos.min.css" />
        <link rel="stylesheet" href="/assets/vendor/css/bootstrap-icons.min.css" />
        <script href="/assets/vendor/js/jquery.min.js"></script>
        <script src="{{ mix('/assets/js/guest.js') }}" defer></script>
        @livewireStyles
        @yield('style')
    </head>
    <body>
        <div class="flex flex-col h-screen">
            <x-guest.navbar></x-guest.navbar>
            
            <div class="flex-1 pt-16">
                {{ $slot }}
            </div>
            <x-guest.footer></x-guest.footer>
        </div>
        @livewireScripts
        @stack('scripts')
        @yield('scripts')
        <script src="/assets/vendor/js/aos.min.js"></script>
        <script>
            AOS.init();
        </script>
    </body>
</html>