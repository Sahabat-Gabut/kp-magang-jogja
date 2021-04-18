<x-app-layout title="Daftar Dinas">
    <h2 class="text-2xl font-semibold leading-tight">{{ __('Daftar Dinas') }}</h2>
    <div class="my-2 flex sm:flex-row flex-col">
        <div class="block relative w-full">
            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-300">
                    <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                    </path>
                </svg>
            </span>
            <input placeholder="Search"
                class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-300 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
        </div>
    </div>
    <div>
        @if (session()->has('message'))
            <div x-data="{ open: true }" class="group fixed right-6 top-6 select-none" style="z-index: 99999999999">
                <div x-show="open" class="bg-green-200 bg-opacity-25 backdrop-filter backdrop-blur-sm px-6 py-3 shadow-md rounded-md text-lg flex items-center">
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
    </div>
    <div class="pt-4 overflow-x-auto">
        <div class="tableFixHead inline-block min-w-full border border-gray-300 rounded-md overflow-hidden" style="max-height: 77vh">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Dinas
                        </th>
                        <th
                            class="px-5 py-3 text-center border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Total Magang
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agency as $key => $a)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $a->name}}
                            </td>
                            <td class="px-5 py-5 text-center border-b border-gray-200 bg-white text-sm">
                                {{ $a->total_apprentice}}
                            </td>
                            <td class="px-5 py-5 justify-center text-center border-b border-gray-200 bg-white text-sm">
                                <div class="flex justify-center rounded-lg text-lg" role="group">
                                    <a href="/agency/{{ $a->id }}/detail" class="bg-white text-gray-600 hover:bg-green-200 hover:text-green-600 border border-r-0 border-gray-300 rounded-l-md px-4 py-2 mx-0 outline-none">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>    
                                    </a>
                                    <a href="/agency/{{ $a->id }}/update" class="bg-white text-gray-600 hover:bg-yellow-200 hover:text-yellow-600 border border-gray-300  px-4 py-2 mx-0 outline-none">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>    
                                    </a>
                                    <a href="/agency/{{ $a->id }}/delete" class="bg-white text-gray-600 hover:bg-red-200 hover:text-red-600 border border-l-0 border-gray-300 rounded-r-md px-4 py-2 mx-0 outline-none">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>    
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>