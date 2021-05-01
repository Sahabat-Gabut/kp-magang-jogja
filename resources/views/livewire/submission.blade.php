@php
    function resultContent($content, $word) {
        $replace = '<span style="background-color: #FF0;">' . $word . '</span>'; 
        $content = str_replace( $word, $replace, $content ); 
        return $content;
    }
@endphp

<div class="overflow-x-auto">
    <div class="flex flex-col sm:flex-row sm:justify-between">
        <div class="my-2 flex sm:flex-row flex-col order-last lg:order-first">
            <div class="flex flex-row mb-1 sm:mb-0">
                <div class="relative">
                    <select
                        class="focus:ring-0 focus:border-gray-300 appearance-none h-full rounded-l border block w-full bg-white border-gray-300 border-r-0 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white cursor-pointer">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                    </select>
                </div>
                <div class="relative">
                    <select
                        wire:model="status"
                        class="focus:ring-0 focus:border-gray-300 appearance-none h-full rounded-r border-t border-r border-b block w-full bg-white border-gray-300 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white cursor-pointer">
                        <option value="">Semua</option>
                        <option value="SEDANG DIPROSES">Sedang Diproses</option>
                        <option value="DI TERIMA">Di Terima</option>
                        <option value="DI TOLAK">Di Tolak</option>
                    </select>
                </div>
            </div>
            {{-- <div class="block relative">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-300">
                        <path
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                        </path>
                    </svg>
                </span>
                <input placeholder="Search"
                    wire:model="searchTerm"
                    class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-300 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
            </div> --}}
        </div>
        <div class="order-first lg:order-last items-center flex">
            {{-- <button>
                Tambah Kuota
            </button> --}}
            <div x-data="{ open: false }">
                <div class="flex justify-end mt-4">
                    <button class="bg-green-500 text-white px-4 py-1 rounded-md focus:outline-none mb-2 flex" @click="open = true">
                        <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Tambah Kuota
                    </button>
                </div>
                <form wire:submit.prevent="addQuota">
                    <div x-show="open" class="fixed inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="z-index: 9999">
                        <div class="flex items-center justify-center min-h-screen text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-25 backdrop-filter backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            <div @click.away="open = false" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Tambah Kuota
                                            </h3>
                                            <div class="mt-2 w-full">
                                                <input wire:model="quota" type="number" class="border border-gray-300 focus:outline-none p-2 focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm" placeholder="Kuota Magang"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Tambah
                                    </button>
                                    <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($submission->isEmpty())
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"></td>
                            <td class="px-5 py-5 border-b text-center border-gray-200 bg-white text-sm">
                                Data Tidak Tersedia
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"></td>
                        </tr>
                    @else
                        @foreach ($submission as $key => $sm)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $submission[$key]->agencyDetail->name}}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @if($searchTerm<>'')
                                        {!! resultContent(ucwords(strtolower($sm->university)),ucwords($searchTerm)) !!}
                                    @else
                                        {!! ucwords(strtolower($sm->university)) !!}
                                    @endif
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
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
