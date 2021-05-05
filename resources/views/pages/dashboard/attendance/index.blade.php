<x-app-layout title="Absensi">
    <div class="">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">{{ __('Absensi') }}</h2>
        </div>
        @if(\Auth::user()->apprenticeTeam)
        <div class="pt-4 overflow-x-auto">
            <div class="tableFixHead inline-block min-w-full overflow-hidden border border-gray-300 rounded-md">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="text-xs font-semibold border-b border-gray-300 tracking-wide text-left text-gray-500 uppercase dark:border-gray-700 bg-gray-50">
                            <th
                                class="px-5 py-3 border-b border-gray-300 z-20 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th
                                class="px-5 py-3 border-b border-gray-300 z-20 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-5 py-3 border-b border-gray-300 z-20 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absen as $key => $a)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="block">
                                    <?php 
                                        $start  = new \DateTime($a->start_attendace);
                                        $end    = new \DateTime($a->end_attendace);
                                        $start_att = \carbon\Carbon::instance($start);
                                        $end_att    = \carbon\Carbon::instance($end);
                                    ?>
                                    {{ $start_att->isoFormat('dddd, D MMMM Y') }}
                                </span>
                                <span class="text-xs font-semibold inline-block py-1 uppercase rounded-full">
                                    {{ $start_att->isoFormat('HH:mm') }} - {{ $end_att->isoFormat('HH:mm') }}
                                </span>
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
                                <livewire:attendance :attendance="$a" :index="$key">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if(\Auth::user()->adminDetail)
        <div class="pt-4 overflow-x-auto">
            <div class="tableFixHead inline-block min-w-full overflow-hidden border border-gray-300 rounded-md">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="text-xs font-semibold border-b border-gray-300 tracking-wide text-left text-gray-500 uppercase dark:border-gray-700 bg-gray-50">
                            <th
                                class="px-5 py-3 border-b border-gray-300 z-20 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Name
                            </th>
                            <th
                                class="px-5 py-3 border-b border-gray-300 z-20 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Universitas
                            </th>
                            <th
                                class="px-5 py-3 border-b border-gray-300 z-20 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($team as $key =>$t)
                            @if ($t->status_hired == "DI TERIMA" )         
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @if($team[$key]->apprenticeUser)   
                                            @foreach ($team[$key]->apprenticeUser as $key => $value)
                                            <span class="block">
                                                {{$value->fullname}}
                                            </span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="block">
                                            {{$t->university}} 
                                        </span>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <a href="/attendance/detail/{{ $t->id }}" class="text-green-600">Lihat Detail</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>