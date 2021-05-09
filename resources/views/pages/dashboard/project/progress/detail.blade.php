<x-app-layout title="Detail Progress">
    <div class="mt-4 mb-4">
        <h1 class="font-semibold text-gray-700 text-lg">{{ $team->project->name_project }}</h1>
        <span>{{ $progress->name }}</span>
    </div>

    <main class="main-card">
        @if(\Auth::user()->adminDetail)
            @if($progress->status == "SELESAI")
                @if(isset($progress->valuation->score))
                    <livewire:valuation-update :valuation="$progress->valuation" :id="$team->project->id">
                @else
                    <livewire:valuation-create :id="$team->project->id" :teamid="$team->id" :progress="$progress">
                @endif
            @endif
        @endif
        <div class="grid grid-cols-6">
            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t bg-gray-100 p-2 border border-gray-300">
                <span>Penanggung Jawab</span>
            </div>
            <div class="col-span-6 sm:col-span-5 p-2 bo5rder-l sm:border-l-0 border-r sm:border-t border-gray-300">
                <span>{{ $progress->jss[0]->fullname }}</span>
            </div>

            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t border-b-0 bg-gray-100 p-2 border border-gray-300">
                <span>Status</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-l-0 sm:border-b-0 border-b-0 border-r sm:border-t p-2 border border-gray-300">
                <span>{{ $progress->status }}</span>
            </div>

            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t border-b-0 bg-gray-100 p-2 border border-gray-300">
                <span>Penjelasan</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-b-0 sm:border-l-0 border-r sm:border-t p-2 border-b-0 border border-gray-300">
                <span>{{ $progress->explanation }}</span>
            </div>

            <div class="col-span-6 sm:col-span-1 bg-gray-100 p-2 border border-gray-300 border-b-0 sm:border-b">
                <span>Nilai</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-l-0 border-r sm:border-t p-2 border border-gray-300">
                <span>
                    @if (isset($progress->valuation->score))
                        {{ $progress->valuation->score }}
                    @else
                        BELUM DINILAI
                    @endif
                </span>
            </div>
        </div>
    </main>
    <div class="main-card mt-6">
        <h1 class="font-semibold text-gray-700 mb-3 text-lg">File</h1>
        <img src="https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="w-full"/>
        {{-- <div class="container mx-auto">
            <iframe src ="/laraview/#..//storage/files/qIXB2nXEQngyyLsuLPEbWQedwMictmU8AAIusqOT.pdf" class="w-full" height="600px"></iframe>
        </div> --}}
    </div>
</x-app-layout>