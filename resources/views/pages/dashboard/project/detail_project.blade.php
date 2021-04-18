<x-app-layout title="Detail Project">
    <div class="main-card">
        <div class="flex justify-between items-center" x-data="{ open: false }">
            <h1 class="font-semibold text-gray-700">{{ $team[0]->apprenticeProject->name_project }}</h1>
            <livewire:create-progress-project :id="$team[0]->apprenticeProject->id" :teamid="$team[0]->id">
        </div>
        <div class="relative pt-1 mt-4">
            <div class="flex mb-2 items-center justify-between">
                <div>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                    {{ $percentage }}%
                </span>
                </div>
                <div class="text-right">
                </div>
            </div>
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
                <div style="width:{{ $percentage }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
            </div>
        </div>

        <div class="mt-10 border-t-2 pt-4">
            <h1 class="uppercase font-semibold mt-2 text-gray-700">team</h1>
            <div class="flex">
                @foreach ($team[0]->apprentices as $key => $value)
                    <div class="flex mt-4 items-center mr-4">
                        <img src="{{ $value->imgSrc }}" class="h-14 w-14 rounded-full" />
                        <div class="flex flex-col ml-2">
                            <span class="font-semibold">{{ implode(' ', array_slice(explode(' ', $team[0]->apprenticeUser[$key]->fullname), 0, 2))."\n" }}</span>
                            <span class="italic text-sm">JSS-I{{ $value->jss_id }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="pt-4 overflow-x-auto">
            <div class="tableFixHead inline-block min-w-full border border-gray-300 rounded-md overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Planning
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Penanggung Jawab
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Progress
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progress as $key => $value)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $value->name }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $progress[$key]->jss[0]->fullname }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    @if($value->status == "DALAM PROGRES")
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-cool-gray-600 bg-cool-gray-200">
                                            {{ $value->status }}
                                        </span>
                                    @elseif($value->status == "SELESAI")
                                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                                            {{ $value->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-center bg-white text-sm">
                                    <div class="flex justify-center rounded-lg text-lg" role="group">
                                        <a href="/project/detail/{{ $team[0]->id }}/{{ $value->id }}/change" class="bg-white text-gray-600 hover:bg-green-200 hover:text-green-600 border border-r-0 border-gray-300 rounded-l-md px-4 py-2 mx-0 outline-none">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>    
                                        </a>
                                        <a href="/project/detail/{{ $team[0]->id }}/{{ $value->id }}/change" class="bg-white text-gray-600 hover:bg-yellow-200 hover:text-yellow-600 border border-gray-300  px-4 py-2 mx-0 outline-none">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>    
                                        </a>
                                        <div x-data="{ open: false }">
                                            <button @click="open = true" class="bg-white text-gray-600 hover:bg-red-200 hover:text-red-600 border border-l-0 border-gray-300 rounded-r-md px-4 py-2 mx-0 outline-none">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>    
                                            </button>
                                            <!-- This example requires Tailwind CSS v2.0+ -->
                                            <div x-show="open"  class="fixed inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="z-index: 9999999999">
                                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                    <!--
                                                    Background overlay, show/hide based on modal state.
    
                                                    Entering: "ease-out duration-300"
                                                        From: "opacity-0"
                                                        To: "opacity-100"
                                                    Leaving: "ease-in duration-200"
                                                        From: "opacity-100"
                                                        To: "opacity-0"
                                                    -->
                                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    
                                                    <!-- This element is to trick the browser into centering the modal contents. -->
                                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
                                                    <!--
                                                    Modal panel, show/hide based on modal state.
    
                                                    Entering: "ease-out duration-300"
                                                        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        To: "opacity-100 translate-y-0 sm:scale-100"
                                                    Leaving: "ease-in duration-200"
                                                        From: "opacity-100 translate-y-0 sm:scale-100"
                                                        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    -->
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
                                                                        Hapus Planning
                                                                    </h3>
                                                                    <div class="mt-2">
                                                                        <p class="text-sm text-gray-500">
                                                                            Apakah kamu yakin ingin menghapus planning ini? Data yang sudah dihapus tidak akan bisa dikembalikan kembali.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                            <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="location.href='/project/detail/{{ $team[0]->id }}/{{ $value->id }}/remove'">
                                                                Hapus Planning
                                                            </button>
                                                            <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>

