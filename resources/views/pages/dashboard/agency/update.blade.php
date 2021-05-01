<x-app-layout title="Ubah Dinas">
    <h2 class="text-2xl font-semibold leading-tight">{{ __('Ubah Dinas') }}</h2>

    <div class="main-card mt-3">
        <livewire:agency-update :data="$agency">
    </div>
</x-app-layout>