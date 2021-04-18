<x-app-layout title="Submission">
    <div>
        <h2 class="text-2xl font-semibold leading-tight">{{ __('List Submission') }}</h2>
    </div>
    <div class="my-2 flex sm:flex-row flex-col">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <select
                    class="appearance-none h-full rounded-l border block w-full bg-white border-gray-300 border-r-0 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                </select>
            </div>
            <div class="relative">
                <select
                    class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block w-full bg-white border-gray-300 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                    <option>All</option>
                    <option>Procees</option>
                    <option>Accepted</option>
                    <option>Rejected</option>
                </select>
            </div>
        </div>
        <div class="block relative">
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
    
    @if (session()->has('success'))
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
    @if (session()->has('errors'))
        <div x-data="{ open: true }" class="group fixed right-6 top-6 select-none" style="z-index: 99999999999">
            <div x-show="open" class="bg-red-200 bg-opacity-25 backdrop-filter backdrop-blur-sm px-6 py-3 shadow-md rounded-md text-lg flex items-center">
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
    <div class="pt-4 overflow-x-auto">
        <div class="tableFixHead inline-block min-w-full border border-gray-300 rounded-md overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Dinas
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Universitas
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            User
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submission as $key => $sm)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $submission[$key]->agencyDetail->name}}
                            </td>

                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $sm->university}}
                            </td>

                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($sm->status_hired == "SEDANG DIPROSES" || $sm->status_hired == "DI TERIMA")
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                                        {{ $sm->status_hired }}
                                    </span>
                                @else
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-red-600 bg-red-200">
                                        {{ $sm->status_hired }}
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    @foreach ($submission[$key]->apprentices as $item)
                                        <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125 cursor-pointer" src="{{ $item->imgSrc }}"/>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="/submission/detail/{{ $sm->id }}" class="text-teal-600">{{__('Lihat Detail')}}</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>