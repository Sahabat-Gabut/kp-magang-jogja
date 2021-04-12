<x-app-layout title="Profile">
    <div class="min-h-60 h-60 max-h-60 md:min-h-72 md:h-72 md:max-h-72 w-full bg-repeat bg-center bg-hero-batik rounded-md blur-lg shadow-md"></div>
    <div class="w-full p-4 flex -mt-20 h-30 rounded-md shadow-md items-center mb-4" style="background-color: hsla(0,0%,100%,.8)!important; backdrop-filter: saturate(200%) blur(5px);">
        <img src="/assets/img/person.webp" class="h-14 lg:h-24 rounded-full"/>
        <div class="flex flex-col ml-4 text-gray-600">
            <span class="font-bold text-base lg:text-2xl">Maulana Kurnia</span>
            <span class="font-medium text-sm lg:text-1xl">JSS-I5127</span>
        </div>
    </div>
    <main class="main-card shadow-md">
        <h1 class="font-bold text-xl text-gray-600 mb-4">Project</h1>
            <div class="grid grid-cols-6 gap-6">
                <div class="lg:col-span-2 col-span-6">
                    <div class="main-card flex items-center">
                        <div class="p-1 rounded-full bg-green-100 h-14 w-14 md:flex justify-center items-center mr-4 hidden">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="font-semibold">Aplikasi Magang Dinas Kota Yogyakarta</h1>
                            <span class="font-semibold text-xs inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 my-1">
                                dalam progres
                            </span>
                        </div>
                    </div>
                </div>

            </div>
    </main>
</x-app-layout>