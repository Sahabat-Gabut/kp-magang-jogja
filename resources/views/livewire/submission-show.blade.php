@php
    function resultContent($content, $word) {
        $replace = '<span style="background-color: #BCF0DA;">' . $word . '</span>'; 
        $content = str_replace( $word, $replace, $content ); 
        return $content;
    }
@endphp
<div class="overflow-x-auto">
    <div class="flex flex-col sm:flex-row sm:justify-between">
        <div class="my-2 flex sm:flex-row flex-col order-last lg:order-first">
            <div class="flex flex-row mb-1 sm:mb-0">
                <div class="relative w-40">
                    <select
                        wire:model="availableData"
                        class="focus:ring-0 focus:border-gray-300 appearance-none h-full rounded-l border block w-full bg-white border-gray-300 border-r-0 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white cursor-pointer">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                    </select>
                </div>
                <div class="relative w-60">
                    <select
                        wire:model="status"
                        @if(\Auth::user()->adminRole->id == "1")
                            class="focus:ring-0 focus:border-gray-300 appearance-none h-full border block w-full bg-white border-gray-300 border-r-0 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white cursor-pointer">
                        @else
                            class="focus:ring-0 focus:border-gray-300 appearance-none h-full rounded-r border-t border-r border-b block w-full bg-white border-gray-300 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white cursor-pointer">
                        @endif
                        <option value="">Status</option>
                        <option value="SEDANG DIPROSES">Sedang Diproses</option>
                        <option value="DI TERIMA">Di Terima</option>
                        <option value="DI TOLAK">Di Tolak</option>
                    </select>
                </div>
                @if(\Auth::user()->adminRole->id == "1")
                    <div class="relative w-full">
                        <select
                            wire:model="selectAgency"
                            class="focus:ring-0 focus:border-gray-300 appearance-none h-full rounded-r border-t border-r border-b block w-full bg-white border-gray-300 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white cursor-pointer">
                            <option>Dinas</option>
                            @foreach ($agency as $key => $s)
                                <option value="{{$s->id}}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>
        <div class="order-first lg:order-last items-center flex">
            @if(\Auth::user()->adminRole->id != "1")
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
            @endif
        </div>
    </div>
    
    <div class="pt-4 overflow-x-auto">
        <div class="tableFixHead inline-block min-w-full border border-gray-300 rounded-md overflow-y-auto" style="max-height: 71vh">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        @if(\Auth::user()->adminRole->id == "1")
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Dinas
                            </th>
                        @endif
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
                    @foreach ($submission as $key => $sm)
                        <tr>
                            @if(\Auth::user()->adminRole->id == "1")
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $submission[$key]->agency->name}}
                                </td>
                            @endif

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
                </tbody>
            </table>
            @if($submission->isEmpty())
                <div class="py-10 text-sm w-full flex bg-white justify-center">
                    <span>Data Tidak Tersedia</span>
                </div>
            @endif
        </div>
    </div>
    {{ $submission->links("components.pagination") }}
</div>
