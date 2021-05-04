<x-app-layout title="Submission">
    <div>
        <h2 class="text-2xl font-semibold leading-tight">{{ __('Detail Tim')}}</h2>
    </div>

    <div class="main-card mt-3">
        <div class="flex items-center justify-end">
            @if($submission->status_hired == "DI TERIMA")
                <div x-data="{ open: false }">
                    <button @click="open = true" class="btn-danger" style="margin-right:0">
                        Batalkan Terima
                    </button>
                    <div x-show="open"  class="fixed inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="z-index: 9999999999">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <!-- Heroicon name: outline/exclamation -->
                                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>

                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Batalkan Terima Tim
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Apakah anda yakin ingin membatalkan tim ini untuk magang di <strong>{{$submission->agency->name}}</strong>?</br> Jika anda membatalkan, maka semua absensi, progres projek yang ada pada tim ini akan terhapus permanen!
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <form method="POST" action="{{ route("submission.reject") }}">
                                        @csrf
                                        <input type="hidden" name="team_apprentice_id" value="{{ $submission->id }}"/>
                                        <input type="hidden" name="agency_id" value="{{ $submission->agency_id }}"/>
                                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Saya Yakin
                                        </button>
                                    </form>
                                    <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($submission->status_hired == "DI TOLAK")
                <form method="POST" action="{{ route("submission.accept") }}">
                    @csrf
                    <input type="hidden" name="team_apprentice_id" value="{{ $submission->id }}"/>
                    <input type="hidden" name="agency_id" value="{{ $submission->agency_id }}"/>
                    <button type="submit" class="btn-success">Terima</button>
                </form>
                {{-- <button class="btn-success" onclick="location.href='/submission/detail/{{$submission->id}}/{{$submission->agency_id}}/accept'">Terima</button> --}}
            @else
                <form method="POST" action="{{ route("submission.reject") }}">
                    @csrf
                    <input type="hidden" name="team_apprentice_id" value="{{ $submission->id }}"/>
                    <input type="hidden" name="agency_id" value="{{ $submission->agency_id }}"/>
                    <button type="submit" class="btn-danger">Tolak</button>
                </form>
                <form method="POST" action="{{ route("submission.accept") }}">
                    @csrf
                    <input type="hidden" name="team_apprentice_id" value="{{ $submission->id }}"/>
                    <input type="hidden" name="agency_id" value="{{ $submission->agency_id }}"/>
                    <button type="submit" class="btn-success">Terima</button>
                </form>
                {{-- <button class="btn-success" onclick="location.href='/submission/detail/{{$submission->id}}/{{$submission->agency_id}}/accept'">Terima</button> --}}
            @endif
        </div>
        <div class="grid grid-cols-6">
            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t bg-gray-100 p-2 border border-gray-300">
                <span>Dinas yang dituju</span>
            </div>
            <div class="col-span-6 sm:col-span-5 p-2 border-l sm:border-l-0 border-r sm:border-t border-gray-300">
                <span>{{$submission->agency->name}}</span>
            </div>

            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t border-b-0 bg-gray-100 p-2 border border-gray-300">
                <span>Status</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-l-0 sm:border-b-0 border-b-0 border-r sm:border-t p-2 border border-gray-300">
                <span>{{$submission->status_hired}}</span>
            </div>

            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t border-b-0 bg-gray-100 p-2 border border-gray-300">
                <span>Universitas</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-b-0 sm:border-l-0 border-r sm:border-t p-2 border-b-0 border border-gray-300">
                <span>{{$submission->university}}</span>
            </div>
            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t border-b-0 bg-gray-100 p-2 border border-gray-300">
                <span>Jurusan</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-b-0 sm:border-l-0 border-r sm:border-t p-2 border-b-0 border border-gray-300">
                <span>{{$submission->departement}}</span>
            </div>

            <div class="col-span-6 sm:col-span-1 bg-gray-100 p-2 border border-gray-300 border-b-0 sm:border-b">
                <span>Tanggal Daftar</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-l-0 border-r sm:border-t p-2 border border-gray-300">
                @php 
                    $date = new \DateTime($submission->date_of_created);
                    $carbon = \carbon\Carbon::instance($date);
                @endphp
           
                <span>{{ $carbon->isoFormat('dddd, D MMMM Y') }}</span>
            </div>
        </div>
    </div>

    <div class="main-card mt-6">
        <h1 class="font-semibold text-gray-700 mb-3 text-lg">Proposal</h1>
        <div class="container mx-auto">
            <iframe src ="{{ '/laraview/#../'.$submission->proposal }}" class="w-full" height="600px"></iframe>
        </div>
        <h1 class="font-semibold text-gray-700 my-6 text-lg">Surat Pengantar</h1>
        <div class="container mx-auto">
            <iframe src ="{{ '/laraview/#../'.$submission->cover_letter }}"class="w-full" height="600px"></iframe>
        </div>
    </div>
</x-app-layout>