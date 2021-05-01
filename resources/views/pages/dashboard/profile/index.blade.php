<x-app-layout title="Profile">
    <div class="min-h-60 h-60 max-h-60 md:min-h-72 md:h-72 md:max-h-72 w-full bg-repeat bg-center bg-hero-batik rounded-md blur-lg shadow-md"></div>
    <div class="w-full p-4 flex -mt-20 h-30 rounded-md shadow-md items-center mb-4" style="background-color: hsla(0,0%,100%,.8)!important; backdrop-filter: saturate(200%) blur(5px);">
        @if(\Auth::user()->adminDetail)
            <img src="{{ $admin[0]->imgSrc ? $admin[0]->imgSrc : 'https://ui-avatars.com/api/?name='.$name.'&color=6dbda1&background=bcf0da' }}" class="h-14 lg:h-24 rounded-full"/>
        @elseif(\Auth::user()->apprenticeDetail)
            <img src="{{ $apprentice[0]->imgSrc ? $apprentice[0]->imgSrc : 'https://ui-avatars.com/api/?name='.$name.'&color=6dbda1&background=bcf0da' }}" class="h-14 lg:h-24 rounded-full"/>
        @endif

        <div class="flex flex-col ml-4 text-gray-600">
            @if(\Auth::user()->adminDetail)
                <h1 class="font-bold text-base lg:text-2xl">{{ $admin[0]->jss[0]->fullname }}</h1>
            @elseif(\Auth::user()->apprenticeDetail)
                <span class="font-bold text-base lg:text-2xl">{{ $apprentice[0]->jss[0]->fullname }}</span>
            @endif

            <span class="font-medium text-sm lg:text-1xl">JSS-I{{ \Auth::user()->id }}</span>
        </div>
    </div>

    @if(\Auth::user()->apprenticeDetail)
    <main class="main-card shadow-md">
        <h1 class="font-bold text-xl text-gray-600 mb-4">Projek</h1>
        <div class="grid grid-cols-6 gap-6">
            <div class="lg:col-span-2 col-span-6">
                <div class="main-card flex items-center">
                    <div class="p-1 rounded-full bg-green-100 h-14 w-14 md:flex justify-center items-center mr-4 hidden">
                        <svg class="w-5 h-5 text-green-500"" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <div>
                        <h1 class="font-semibold">{{ $team[0]->project->name_project }}</h1>
                        <span>{{ $team[0]->project->explanation }}</span>
                        {{-- <span class="font-semibold text-xs inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 my-1">
                            
                        </span> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endif
</x-app-layout>