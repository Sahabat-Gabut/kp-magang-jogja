<?php
    $date = new DateTime($submission->date_of_created);
?>
<x-app-layout title="Submission">
    <div>
        <h2 class="text-2xl font-semibold leading-tight">{{ __('Detail Team ')}}</h2>
    </div>

    <div class="main-card mt-3">
        <div class="flex items-center justify-end">
            <button class="btn-danger" onclick="location.href='/submission/detail/{{$submission->id}}/{{$submission->agency_id}}/reject'">Tolak</button>
            <button class="btn-success" onclick="location.href='/submission/detail/{{$submission->id}}/{{$submission->agency_id}}/accept'">Terima</button>
        </div>
        <div class="grid grid-cols-6">
            <div class="col-span-6 sm:col-span-1 border-l sm:border-b-0 border-r sm:border-t bg-gray-100 p-2 border border-gray-300">
                <span>Dinas yang dituju</span>
            </div>
            <div class="col-span-6 sm:col-span-5 p-2 border-l sm:border-l-0 border-r sm:border-t border-gray-300">
                <span>{{$submission->agencyDetail->name}}</span>
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
                <span>{{$date->format("d M Y")}}</span>
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