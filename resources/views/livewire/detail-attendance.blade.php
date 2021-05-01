<div>
    <div class="my-2 flex sm:flex-row flex-col">
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
                    wire:model="selectApprentice"
                    class="focus:ring-0 focus:border-gray-300 appearance-none h-full rounded-r border block w-full bg-white border-gray-300 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white cursor-pointer">
                    <option value="">Semua</option>
                    @foreach ($apprentice as $key => $a)
                        <option value="{{ $a->id }}">{{ $apprentice[$key]->jss[0]->fullname }}</option>
                    @endforeach
                </select>
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
        <div class="tableFixHead inline-block min-w-full border border-gray-300 rounded-md overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            User
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($attendance->isEmpty())
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"></td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"></td>
                            <td class="px-5 py-5 border-b text-center border-gray-200 bg-white text-sm">
                                Data Tidak Tersedia
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"></td>
                        </tr>
                    @else
                        @foreach ($attendance as $key => $a)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php 
                                        $date = new \DateTime($a->start_attendace);
                                        $carbon = \carbon\Carbon::instance($date);
                                    ?>
                                    {{ $carbon->isoFormat('dddd, D MMMM Y') }}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $a->fullname }}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @if(!is_null($a->status))
                                        @if($a->status == "TEPAT WAKTU")
                                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                                                {{ $a->status }}
                                            </span>
                                        @elseif($a->status == "TELAT")
                                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-red-600 bg-red-200">
                                                {{ $a->status }}
                                            </span>
                                        @else
                                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-gray-600 bg-gray-200">
                                                {{ $a->status }}
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex justify-center rounded-lg text-lg" role="group">
                                        <div class="flex justify-center rounded-lg text-lg" role="group">
                                            <livewire:attendance-update :data="$a" :index="$key" :key="$key">
                                            <a href="#" class="bg-white text-gray-600 hover:bg-red-200 hover:text-red-600 border border-l-0 border-gray-300 rounded-r-md px-4 py-2 mx-0 outline-none">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>    
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
