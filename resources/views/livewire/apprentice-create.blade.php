<div class="bg-gray-100 p-6 rounded-md border border-gray-300">
    <form wire:submit.prevent="store">
        <div class="block" aria-hidden="true">
            <div class="pb-5">
                <div class="border-b border-gray-200">
                    <h1 class="text-xl font-bold leading-6 text-gray-600">
                        {{ __('Formulir Pendaftaran Magang Dinas Kota Yogyakarta') }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-600">Informasi Umum</h3>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="agency" class="block text-sm font-medium text-gray-700">
                                    {{ __('Dinas yang dituju') }}
                                </label>
                                @error('agency') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <select wire:model="agency" class="form-select w-full text-gray-700">
                                    <option>{{ __('Pilih Dinas') }}</option>
                                    @foreach($dataAgency as $a)
                                        <option value="{{$a->id}}">{{$a->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <label for="university" class="block text-sm font-medium text-gray-700">
                                    {{ __('Universitas') }}
                                </label>
                                 @error('university') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input wire:model="university" name="university" type="text" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="{{ __('ex: Universitas Pembangunan Nasional "Veteran" Yogyakarta') }}">
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <label for="departement" class="block text-sm font-medium text-gray-700">
                                    {{ __('Jurusan') }}
                                </label>
                                @error('departement') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input wire:model="departement" name="departement" type="text" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="{{ __('ex: Informatika') }}">
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label class="block text-sm font-medium text-gray-700">
                                    Surat pengantar 
                                </label>
                                @error('cover_letter') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                                    <input id="cover_letter" wire:model="cover_letter" type="file" class="focus:outline-none items-center py-2 flex flex-shrink flex-grow leading-normal w-px flex-1 border h-10 border-grey-light rounded-r-none px-3 relative rounded-md sm:text-sm border-gray-300">
                                    <div class="flex -mr-px">
                                        <label for="cover_letter" class="flex cursor-pointer items-center leading-normal bg-gray-100 rounded rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-grey-800 text-sm">
                                            Unggah Berkas
                                        </label>
                                    </div>	
                                </div>
                                <p class="text-xs text-gray-500 -mt-3">
                                    PDF dibawah 10MB
                                </p>	
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label class="block text-sm font-medium text-gray-700">
                                    Proposal
                                </label>
                                @error('proposal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                                    <input id="proposal" wire:model="proposal" type="file" class="focus:outline-none items-center py-2 flex flex-shrink flex-grow leading-normal w-px flex-1 border h-10 border-grey-light rounded-r-none px-3 relative rounded-md sm:text-sm border-gray-300">
                                    <div class="flex -mr-px">
                                        <label for="proposal" class="flex cursor-pointer items-center leading-normal bg-gray-100 rounded rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-grey-800 text-sm">
                                            Unggah Berkas
                                        </label>
                                    </div>	
                                </div>	
                                <p class="text-xs text-gray-500 -mt-3">
                                    PDF dibawah 10MB
                                </p>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <label class="block text-sm font-medium text-gray-700">
                                    Presentasi projek yang akan diajukan
                                </label>
                                @error('presentation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                 <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                                    <input id="presentation" wire:model="presentation" type="file" class="focus:outline-none items-center py-2 flex flex-shrink flex-grow leading-normal w-px flex-1 border h-10 border-grey-light rounded-r-none px-3 relative rounded-md sm:text-sm border-gray-300">
                                    <div class="flex -mr-px">
                                        <label for="presentation" class="flex cursor-pointer items-center leading-normal bg-gray-100 rounded rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-grey-800 text-sm">
                                            Unggah Berkas
                                        </label>
                                    </div>	
                                </div>	
                                <p class="text-xs text-gray-500 -mt-3">
                                    PPT atau PPTX dibawah 10MB
                                </p>
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <label for="university" class="block text-sm font-medium text-gray-700">
                                    {{ __('Lama Magang (Bulan)') }}
                                </label>
                                @error('duration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number" min="0" step="0.1" max="12" wire:model="duration" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="1.5">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    ex: 1.5 sama dengan 1 bulan setengah
                                </p>
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <label for="university" class="block text-sm font-medium text-gray-700">
                                    {{ __('Nama Project') }}
                                </label>
                                @error('project_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" wire:model="project_name" name="project_name" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                <label for="university" class="block text-sm font-medium text-gray-700">
                                    {{ __('Deskripsi Project') }}
                                </label>
                                @error('project_explanation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <textarea type="text" wire:model="project_explanation" name="project_explanation" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-600">Informasi Anggota</h3>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="flex items-center justify-between border-b -mx-6 px-6 mb-4 -mt-6 py-2 bg-gray-100">
                                <span class="font-bold uppercase">anggota 1</span>
                            </div>
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Photo
                                    </label>
                                    <div class="flex flex-col mt-1 items-center justify-center">
                                        <div class="justify-center">
                                            @if(isset($imagesrc['0']))
                                                @php
                                                    try {
                                                        $url                    = $imagesrc['0']->temporaryUrl();
                                                        $imageStatus['0']       = true;
                                                    }catch (RuntimeException $exception){
                                                        $this->imageStatus['0']     =  false;
                                                    }
                                                @endphp
                                                @if($imageStatus['0'])
                                                    <img src="{{ $imagesrc['0']->temporaryUrl() }}" alt="foto" class="rounded-full h-44 w-44 border bg-cover bg-center" />
                                                @else
                                                    <span class="inline-block h-44 w-44 rounded-full overflow-hidden bg-gray-100">
                                                        <svg class="h-full w-full text-gray-200" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                    </span>
                                                    @endif
                                                @else 
                                                    <span class="inline-block h-44 w-44 rounded-full overflow-hidden bg-gray-100">
                                                        <svg class="h-full w-full text-gray-200" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                    </span>
                                            @endif
                                        </div>
                                            @error('imagesrc.0') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        <label for="upload-image0" class="cursor-pointer font-medium text-sm bg-white py-1 px-3 border border-gray-300 rounded-md shadow-sm mt-4">
                                            <span>Unggah Pas Foto</span>
                                            <input id="upload-image0" wire:model="imagesrc.0" type="file" class="sr-only">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="idjss" class="block text-sm font-medium text-gray-700">ID JSS</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="text" autocomplete="idjss" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $idjss['0'] }}" readonly>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="npm" class="block text-sm font-medium text-gray-700">NPM</label>
                                    <input type="text" wire:model="npm.0" autocomplete="npm" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('npm.0') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Curriculum Vitae (CV)
                                    </label>
                                    @error('cv.0') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                                        <input id="cv.0" wire:model="cv.0" type="file" class="focus:outline-none items-center py-2 flex flex-shrink flex-grow leading-normal w-px flex-1 border h-10 border-grey-light rounded-r-none px-3 relative rounded-md sm:text-sm border-gray-300">
                                        <div class="flex -mr-px">
                                            <label for="cv.0" class="flex cursor-pointer items-center leading-normal bg-gray-100 rounded rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-grey-800 text-sm">
                                                Unggah Berkas
                                            </label>
                                        </div>	
                                    </div>	
                                    <p class="text-xs text-gray-500 -mt-3">
                                        PDF dibawah 10MB
                                    </p>
                                </div>
                            </div>
                        </div>
                        @foreach($inputs as $key => $value)
                            <div class="px-4 py-5 bg-white sm:p-6 border-t">
                                <div class="flex items-center justify-between border-b -mx-6 px-6 mb-4 -mt-6 bg-gray-100">
                                    <span class="font-bold uppercase">anggota {{ $value + 1 }}</span>
                                    <button wire:click.prevent="remove({{ $key }})" class="py-1 px-4 my-2 rounded-md bg-red-600 text-white uppercase hover:bg-red-500 font-semibold inline-block text-sm focus:outline-none">
                                        {{__('Hapus')}}
                                    </button>
                                </div>
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-6">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Photo
                                        </label>
                                        <div class="flex flex-col mt-1 items-center justify-center">
                                            <div class="justify-center">
                                                @if(isset($imagesrc[$value]))
                                                    @php
                                                        try {
                                                            $url                        = $imagesrc[$value]->temporaryUrl();
                                                            $imageStatus[$value]        = true;
                                                        }catch (RuntimeException $exception){
                                                            $this->imageStatus[$value]     =  false;
                                                        }
                                                    @endphp
                                                    @if($imageStatus[$value])
                                                        <img src="{{ $imagesrc[$value]->temporaryUrl() }}" alt="foto" class="rounded-full h-44 w-44 border bg-cover bg-center" />
                                                    @else
                                                        <span class="inline-block h-44 w-44 rounded-full overflow-hidden bg-gray-100">
                                                            <svg class="h-full w-full text-gray-200" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                        </span>
                                                        @endif
                                                    @else 
                                                        <span class="inline-block h-44 w-44 rounded-full overflow-hidden bg-gray-100">
                                                            <svg class="h-full w-full text-gray-200" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                        </span>
                                                @endif
                                            </div>
                                            @error('imagesrc.'.$value) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            <label for="upload-image{{ $value }}" class="cursor-pointer font-medium text-sm bg-white py-1 px-3 border border-gray-300 rounded-md shadow-sm mt-4">
                                                <span>Unggah Pas Foto</span>
                                                <input id="upload-image{{ $value}}" wire:model="imagesrc.{{ $value }}" type="file" class="sr-only">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="idjss" class="block text-sm font-medium text-gray-700">ID JSS</label>
                                        <input type="text" wire:model="idjss.{{ $value }}" autocomplete="idjss" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('idjss.'.$value) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        @error('jss.'.$value) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="npm" class="block text-sm font-medium text-gray-700">NPM</label>
                                        <input type="text" wire:model="npm.{{ $value }}" autocomplete="npm" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('npm.'.$value) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Curriculum Vitae (CV)
                                        </label>
                                        @error('cv.'.$value) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                                            <input id="cv.{{ $value }}" wire:model="cv.{{ $value }}" type="file" class="focus:outline-none items-center py-2 flex flex-shrink flex-grow leading-normal w-px flex-1 border h-10 border-grey-light rounded-r-none px-3 relative rounded-md sm:text-sm border-gray-300">
                                            <div class="flex -mr-px">
                                                <label for="cv.{{ $value }}" class="flex cursor-pointer items-center leading-normal bg-gray-100 rounded rounded-l-none border border-l-0 border-gray-300 px-3 whitespace-no-wrap text-grey-800 text-sm">
                                                    Unggah Berkas
                                                </label>
                                            </div>	
                                        </div>	
                                        <p class="text-xs text-gray-500 -mt-3">
                                            PDF dibawah 10MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="input_fields_wrap"></div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button wire:click.prevent="add({{ $i }})" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Tambah Anggota
                            </button>
                            <button type="submit" wire:loading.attr="disabled" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Unggah Formulir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
