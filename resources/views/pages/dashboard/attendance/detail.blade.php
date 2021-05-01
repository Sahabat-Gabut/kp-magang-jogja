<x-app-layout title="Attendance">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">{{ __('Attendance') }}</h2>
        </div>
        @if (session()->has('success'))
            <div x-data="{ open: true }" class="group fixed right-6 top-6 select-none" style="z-index: 99999999999">
                <div x-show="open" class="bg-green-200 px-6 py-3 shadow-md rounded-md text-lg flex items-center">
                    <svg class="h-6 w-6 mr-4 text-green-600" viewBox="0 0 24 24" class="text-green-600 w-10 h-10 sm:w-5 sm:h-5 mr-3">
                        <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"></path>
                    </svg>
                    <div class="flex flex-col cursor-text">
                        <h1 class="text-green-800 text-lg font-bold">{{ session('title') }}</h1>
                        <span class="text-green-800 -mt-1 text-base">{{ session('message') }}</span>
                    </div>
                    <button class="relative mb-auto ml-3 -mr-4 focus:outline-none text-green-800" @click="open = false">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        @endif
        @if (session()->has('errors'))
            <div x-data="{ open: true }" class="group fixed right-6 top-6 select-none" style="z-index: 99999999999">
                <div x-show="open" class="bg-red-200 px-6 py-3 shadow-md rounded-md text-lg flex items-center">
                    <svg class="h-6 w-6 mr-4 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div class="flex flex-col cursor-text">
                        <h1 class="text-red-800 text-lg font-bold">{{ session('title') }}</h1>
                        <span class="text-red-800 -mt-1 text-base">{{ session('message') }}</span>
                    </div>
                    <button class="relative mb-auto ml-3 -mr-4 focus:outline-none text-red-800" @click="open = false">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        @endif
        <livewire:attendance-detail :data="$attendance" :select="$apprentice">

</x-app-layout>