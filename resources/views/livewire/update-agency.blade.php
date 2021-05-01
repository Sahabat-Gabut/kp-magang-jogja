<form wire:submit.prevent="store">
    <div class="grid grid-cols-6">
        <div class="col-span-6 sm:col-span-6">
            <label for="name" class="block text-sm font-medium text-gray-700">
                {{ __('Nama Dinas') }}
            </label>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div class="mt-1 flex rounded-md shadow-sm">
                <input wire:model="name" name="name" type="text" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
            </div>
        </div>

        <div class="col-span-6 sm:col-span-6 mt-2">
            <label for="location" class="block text-sm font-medium text-gray-700">
                {{ __('Lokasi Dinas') }}
            </label>
                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div class="mt-1 flex rounded-md shadow-sm">
                <textarea wire:model="location" name="location" type="text" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"></textarea>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-6">
            <label for="name" class="block text-sm font-medium text-gray-700">
                {{ __('Kuota') }}
            </label>
                @error('quota') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div class="mt-1 flex rounded-md shadow-sm">
                <input wire:model="quota" name="quota" type="text" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
            </div>
        </div>

    </div>
    <footer class="flex justify-end mt-4">
        <button type="submit" wire:loading.attr="disabled" class="rounded-md px-3 py-1 bg-green-700 hover:bg-green-500 text-white focus:shadow-outline focus:outline-none">
            {{ __('Ubah Dinas') }}
        </button>
    </footer>
</form>
