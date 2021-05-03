<x-app-layout title="Attendance">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">{{ __('Attendance') }}</h2>
        </div>
        <livewire:attendance-detail :data="$attendance" :select="$apprentice">
</x-app-layout>