<x-app-layout title="Home">
    @if(isset(\Auth::user()->apprenticeTeam->status_hired) == "SEDANG DIPROSES" ||
        isset(\Auth::user()->apprenticeTeam->status_hired) == "DI TOLAK")
        @if(\Auth::user()->apprenticeTeam->status_hired == "SEDANG DIPROSES")
            <div class="main-card">
                <span>MOHON MENUNGGU, PERMINTAANMU SEDANG KAMI PROSES...</span>
            </div>
        @elseif(\Auth::user()->apprenticeTeam->status_hired == "DI TOLAK")
             <div class="main-card">
                <span>MOHON MAAF ANDA DITOLAK</span>
             </div>
        @endif
    @endif
    
    @if(Auth::user()->adminDetail)
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4 mt-4">
        <div class="card">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total apprenticeship
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ \DB::table('apprentice')->join("team_apprentice","apprentice.team_apprentice_id","=","team_apprentice.id")->where("team_apprentice.status_hired","DI TERIMA")->count() }}
                </p>
            </div>
        </div>
        <div class="card">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total apprenticeship requests
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ \DB::table('team_apprentice')->where('status_hired','SEDANG DIPROSES')->count() }}
                </p>
            </div>
        </div>
        <div class="card">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7 2a1 1 0 00-.707 1.707L7 4.414v3.758a1 1 0 01-.293.707l-4 4C.817 14.769 2.156 18 4.828 18h10.343c2.673 0 4.012-3.231 2.122-5.121l-4-4A1 1 0 0113 8.172V4.414l.707-.707A1 1 0 0013 2H7zm2 6.172V4h2v4.172a3 3 0 00.879 2.12l1.027 1.028a4 4 0 00-2.171.102l-.47.156a4 4 0 01-2.53 0l-.563-.187a1.993 1.993 0 00-.114-.035l1.063-1.063A3 3 0 009 8.172z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total project
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ App\Models\TeamApprentice::where("status_hired","DI TERIMA")->count() }}
                </p>
            </div>
        </div>
        <div class="card">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Admin
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ \DB::table('admin')->count() }}
                </p>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>

