<form wire:submit.prevent="store">
    @foreach($progress as $prog) 
        <h1 class="text-2xl font-bold mb-4 text-gray-600">{{ $prog->name_prog_project }}</h1>
    @endforeach
    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-6">
            <label for="university" class="block text-md font-medium text-gray-700">
                {{ __('Progres') }}
            </label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <select wire:model="status" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                    <option value="DALAM PROGRES">DALAM PROGRES</option>
                    <option value="SELESAI">SELESAI</option>
                </select>
            </div>
        </div>
        <div class="col-span-6 sm:col-span-6">
            <label for="university" class="block text-md font-medium text-gray-700">
                {{ __('Deskripsi') }}
            </label>
            @error('explanation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div class="mt-1 flex rounded-md shadow-sm">
                <textarea type="text" wire:model="explanation" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"></textarea>
            </div>
        </div>
        <div class="col-span-6 sm:col-span-6 mb-4">
            <label for="university" class="block text-md font-medium text-gray-700 mb-2">
                {{ __('Unggah Berkas') }}
            </label>
            @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                <input id="file" wire:model="file" type="file" class="focus:outline-none items-center py-2 flex flex-shrink flex-grow leading-normal w-px flex-1 border h-10 border-grey-light rounded-r-none px-3 relative rounded-md sm:text-sm border-gray-300">
                <div class="flex -mr-px">
                    <label for="file" class="flex cursor-pointer items-center leading-normal bg-gray-100 rounded rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-grey-800 text-sm">
                        Unggah Berkas
                    </label>
                </div>	
            </div>	
        </div>
    </div>


    <footer class="flex justify-end">
        <button type="submit" wire:loading.attr="disabled" class="rounded-md px-3 py-1 bg-green-700 hover:bg-green-500 text-white focus:shadow-outline focus:outline-none">
            {{ __('Unggah Sekarang') }}
        </button>
    </footer>
</form>
