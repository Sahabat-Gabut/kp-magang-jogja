<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Terlarang</title>

    <link rel="icon" type="image/png" href="/img/favicon.png"/>
    <link rel="stylesheet" href={{ mix('css/app.css') }}>

</head>

<body class="antialiased h-screen">
<div class="flex justify-center min-h-screen bg-white h-full">
    <div class="flex flex-col justify-between w-full min-h-screen bg-gradient-to-br from-green-700 via-green-900 to-green-800">
        <div class="flex p-5 lg:p-20">
            <img class="h-11" src="/img/logo.webp" alt="magang dinas"/>
            <div class="flex flex-col text-white">
                <span class="ml-2 font-bold uppercase">magang dinas</span>
                <span class="ml-2 -mt-2 italic font-normal">kota yogyakarta</span>
            </div>
        </div>
        <div class="p-5 lg:p-20">
            <div class="flex-1">
                <div class="mb-4 leading-relaxed lg:leading-10">
                    <h1 class="text-sm font-bold tracking-tighter text-red-500">403 ERROR</h1>
                    <div class="text-2xl font-bold tracking-tighter text-white lg:text-4xl">Halaman Terproteksi
                    </div>
                    <div class="text-gray-200">
                        Maaf, anda tidak memiliki akses kedalam halaman ini.
                    </div>
                </div>
                <a href="{{ url()->previous() }}"
                   class="inline text-sm font-semibold text-white uppercase shadow-dark-down-strike">
                    Kembali
                </a>
            </div>
        </div>
        <div class="p-5 text-white lg:p-20">
        </div>
    </div>
</div>
</body>

</html>