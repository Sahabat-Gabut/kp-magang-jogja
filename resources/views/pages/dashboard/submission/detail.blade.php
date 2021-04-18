<?php
    $date = new DateTime($submission->date_of_created);
?>
<x-app-layout title="Submission">
    <div>
        <h2 class="text-2xl font-semibold leading-tight">{{ __('Detail Team ').$submission->id }}</h2>
    </div>
    <div class="main-card mt-3">
        <div class="flex items-center justify-end">
            <button class="btn-danger" onclick="location.href='/submission/detail/{{$submission->id}}/reject'">Tolak</button>
            <button class="btn-success" onclick="location.href='/submission/detail/{{$submission->id}}/accept'">Terima</button>
        </div>
        <div class="grid grid-cols-6 gap-1">
            <div class="font-semibold text-gray-700 col-span-6 sm:col-span-1">Dinas yang Dituju</div>
            <div class="col-span-6 sm:col-span-3">: {{ $submission->agencyDetail->name }}</div>
        </div>
        <div class="grid grid-cols-6 gap-1 mt-2">
            <div class="font-semibold text-gray-700 col-span-6 sm:col-span-1">Status</div>
            <div class="col-span-6 sm:col-span-3">: {{ $submission->status_hired }}</div>
        </div>
        <div class="grid grid-cols-6 gap-1 mt-2">
            <div class="font-semibold text-gray-700 col-span-6 sm:col-span-1">Universitas</div>
            <div class="col-span-6 sm:col-span-3">: {{ $submission->university }}</div>
        </div>
        <div class="grid grid-cols-6 gap-1 mt-2">
            <div class="font-semibold text-gray-700 col-span-6 sm:col-span-1">Jurusan</div>
            <div class="col-span-6 sm:col-span-3">: {{ $submission->departement }}</div>
        </div>
        <div class="grid grid-cols-6 gap-1 mt-2">
            <div class="font-semibold text-gray-700 col-span-6 sm:col-span-1">Tanggal Daftar</div>
            <div class="col-span-6 sm:col-span-3">: {{ $date->format("d M Y") }}</div>
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