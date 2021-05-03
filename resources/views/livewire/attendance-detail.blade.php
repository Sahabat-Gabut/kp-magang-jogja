<div class="overflow-x-auto">
    <div class="my-2 flex sm:flex-row flex-col">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative w-28">
                <select
                    wire:model="availableData"
                    class="focus:ring-0 focus:border-gray-300 appearance-none h-full rounded-l border block w-full bg-white border-gray-300 border-r-0 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white cursor-pointer">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="relative w-full">
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
    
    <div class="pt-4 overflow-x-auto">
        <div class="tableFixHead inline-block min-w-full border border-gray-300 rounded-md overflow-y-auto" style="max-height: 71vh">
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
                                    @php 
                                        $date = new \DateTime($a->start_attendace);
                                        $carbon = \carbon\Carbon::instance($date);
                                    @endphp
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
    {{ $attendance->links("components.pagination") }}
</div>
