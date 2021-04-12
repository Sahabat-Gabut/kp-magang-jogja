<!DOCTYPE html>
<html x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    <script src="{{ mix('assets/js/app.js') }}" defer></script>

    <script src="{{ asset('assets/js/init-alpine.js') }}" defer></script>
    @yield('style')
    @livewireStyles
    {{-- <script>
        import Turbolinks from 'turbolinks';
        Turbolinks.start()
    </script> --}}

</head>
<body>
    <div id="app" x-data="data()" class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-app.aside></x-app.aside>
        <x-app.mobile-aside></x-app.mobile-aside>
        
        <div class="flex flex-col flex-1 w-full rounded-t-md pl-6">
            <main class="main-app main-scroll">
                <x-app.header></x-app.header>
                <div class="grid mt-2">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @livewireScripts
    @yield('scripts')
</body>
</html>