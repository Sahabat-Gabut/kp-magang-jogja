<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('403') }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    <script src="{{ mix('assets/js/app.js') }}" defer></script>

    <script src="{{ asset('assets/js/init-alpine.js') }}" defer></script>


</head>
<body>
    <div class="relative flex items-top justify-center h-screen sm:items-center" style="background: linear-gradient(to right, #2E7D32, #009688)">
        <div class="m-auto">
            <div class="flex flex-col items-center text-center">
                <img class="mb-4" src="/assets/img/logo.webp" style="width: 110px"/>
                <h1 class="text-white font-bold text-2xl text-center">Akses Ditolak</h1>
                <span class="text-white text-xl">Anda tidak mempunyai akses untuk masuk kedalam SIM atau Aplikasi ini.</span>
                <span class="text-white">Kembali ke <a class="underline" href="/">Website</a></span>
            </div>
        </div>
    </div>
</body>
</html>