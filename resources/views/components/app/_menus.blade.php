<div class="py-4 text-gray-500 dark:text-gray-400">
    <div class="flex ml-6 items-center">
        <img src="/assets/img/logo.webp" class="w-10" />
        <span class="mx-4 text-md font-semibold text-gray-800 tracking-tighter">
            {{ __('Magang Dinas') }} </br> {{ __('Kota Yogyakarta') }}
        </span>
    </div>
    <ul class="mt-6">
        <li class="nav-item">
            <a data-turbolinks-action="replace" class="nav-link{!! request()->routeIs('dashboard') ? ' active' : '' !!}" href="{{ route('dashboard') }}">
                <svg class="w-5 h-5" ari a-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span class="ml-4">{{ __('Dasbor') }}</span>
            </a>
        </li>
        @if(Auth::user()->adminDetail || Auth::user()->apprenticeTeam)
            @if(Auth::user()->adminDetail || Auth::user()->apprenticeTeam->status_hired == "DI TERIMA")
                <div class="mt-2">
                    <label class="nav-label">App</label>
                </div>
                <li class="nav-item">
                <a data-turbolinks-action="replace" class="nav-link{!! request()->routeIs('attendance') ? ' active' : '' !!}" href="{{ route('attendance') }}">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                        <span class="ml-4">{{ __('Absensi') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ (strpos(Route::currentRouteName(), 'project') === 0) ? ' active' : '' }}" href="{{ route('project') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        <span class="ml-4">{{ __('Projek') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ (strpos(Route::currentRouteName(), 'profile') === 0) ? ' active' : '' }}" href="{{ route('profile') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="ml-4">{{ __('Profil') }}</span>
                    </a>
                </li>
            @endif
        @endif
        @if(Auth::user()->adminDetail)
            <div class="my-2">
                <label class="nav-label">Admin Panel</label>
            </div>
            <li class="nav-item">
                <a class="nav-link{{ (strpos(Route::currentRouteName(), 'submission') === 0) ? ' active' : '' }}" href="{{ route('submission') }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>
                    <span class="ml-4">{{ __('Daftar Pengajuan') }}</span>
                </a>
                @if(Auth::user()->adminRole->id == "1")
                    @if(\DB::table('team_apprentice')->where('status_hired','SEDANG DIPROSES')->count() > 0)
                        <div class="absolute bg-yellow-300 text-yellow-600 font-bold h-6 w-6 rounded-full text-xs flex items-center justify-center right-4 top-0 -mt-2">
                            {{ \DB::table('team_apprentice')->where('status_hired','SEDANG DIPROSES')->count() }}
                        </div>
                    @endif
                @else 
                    @if(\DB::table('team_apprentice')->where('status_hired','SEDANG DIPROSES')->count() > 0)
                        <div class="absolute bg-yellow-300 text-yellow-600 font-bold h-6 w-6 rounded-full text-xs flex items-center justify-center right-4 top-0 -mt-2">
                            {{ \DB::table('team_apprentice')->where('status_hired','SEDANG DIPROSES')->where('agency_id',Auth::user()->adminDetail->agency_id)->count() }}
                        </div>
                    @endif
                @endif
            </li>
            @if(Auth::user()->adminRole->id == "1")
            <li class="nav-item">
                <a class="nav-link{{ (strpos(Route::currentRouteName(), 'agency') === 0) ? ' active' : '' }}" href="{{ route('agency') }}">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                    <span class="ml-4">{{ __('Daftar Dinas') }}</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->adminRole->id != "3")
                <li class="nav-item">
                    <a class="nav-link{{ (strpos(Route::currentRouteName(), 'admin') === 0) ? ' active' : '' }}" href="{{ route('admin') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        <span class="ml-4">{{ __('Daftar Admin') }}</span>
                    </a>
                </li>
            @endif
        @endif
    </ul>
</div>
