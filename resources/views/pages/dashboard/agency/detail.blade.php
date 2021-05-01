<x-app-layout title="Daftar Dinas">
    <h2 class="text-2xl font-semibold leading-tight"></h2>

    <div class="main-card mt-3">
        <div class="grid grid-cols-6">
            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t bg-gray-100 p-2 border border-gray-300">
                <span>ID</span>
            </div>
            <div class="col-span-6 sm:col-span-5 p-2 border-l sm:border-l-0 border-r sm:border-t border-gray-300">
                <span>{{$agency->id}}</span>
            </div>

            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t border-b-0 bg-gray-100 p-2 border border-gray-300">
                <span>Nama</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-l-0 sm:border-b-0 border-b-0 border-r sm:border-t p-2 border border-gray-300">
                <span>{{$agency->name}}</span>
            </div>

            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t border-b-0 bg-gray-100 p-2 border border-gray-300">
                <span>Lokasi</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-b-0 sm:border-l-0 border-r sm:border-t p-2 border-b-0 border border-gray-300">
                <span>{{$agency->location}}</span>
            </div>

            <div class="col-span-6 sm:col-span-1 bg-gray-100 p-2 border border-gray-300 border-b-0 sm:border-b">
                <span>Total Magang</span>
            </div>
            <div class="col-span-6 sm:col-span-5 border-l sm:border-l-0 border-r sm:border-t p-2 border border-gray-300">
                <span>{{$agency->total_team}}</span>
            </div>
        </div>
    </div>
</x-app-layout>