<?php
    $admin          = Auth::user()->adminDetail;
    $apprentice     = Auth::user()->apprenticeDetail;
    $name           = implode(' ', array_slice(explode(' ', Auth::user()->fullname), 0, 2));

    if($admin){
        $role       = Auth::user()->adminRole->name;
    }
?>
<header class="main-header">
      <div class="px-6 flex items-center justify-between h-full mx-auto">
          <div>
              <button class="p-1 mr-5 -ml-1 rounded-md lg:hidden focus:outline-none text-gray-600" @click="toggleSideMenu" aria-label="Menu">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
              </button>
          </div>

          <div>
              <ul class="flex items-center flex-shrink-0 space-x-6">
                  <li class="relative">
                      <button class="align-middle flex items-center focus:outline-none" @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true">
                        <div class="flex flex-col mr-2 text-gray-700">
                            <span>{{ $name }}</span>
                            <span class="text-right -mt-1 text-sm italic">
                                @if($admin)
                                    {{ ucwords(strtolower($role)) }}
                                @elseif($apprentice)
                                    JSS-I{{ $apprentice->jss_id }}
                                @else
                                    JSS-I{{ Auth::user()->id }}
                                @endif
                            </span>
                        </div>
                        @if ($admin)
                            <img class="object-cover w-10 h-10 rounded-full" src="{{ $admin->imgSrc ? $admin->imgSrc : 'https://ui-avatars.com/api/?name='.$name.'&color=6dbda1&background=bcf0da' }}" alt="Maulana Kurnia" aria-hidden="true" />
                        @elseif($apprentice)
                            <img class="object-cover w-10 h-10 rounded-full" src="{{ $apprentice->imgSrc ? $apprentice->imgSrc : 'https://ui-avatars.com/api/?name='.$name.'&color=6dbda1&background=bcf0da' }}" alt="Maulana Kurnia" aria-hidden="true" />
                        @else
                            <img class="object-cover w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name={{$name}}&color=6dbda1&background=bcf0da" alt="Maulana Kurnia" aria-hidden="true" />
                        @endif
                      </button>
                      <template x-if="isProfileMenuOpen">
                          <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700" aria-label="submenu">
                                <li>
                                    <a class="nav-link" href="{{ route('home') }}">
                                        <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ __('Website') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="{{ route('profile') }}">
                                        <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        <span>{{ __('Profile') }}</span>
                                    </a>
                                </li>

                              <div class="border-t border-gray-300"></div>
    
                              <form method="POST" action="{{ route('logout') }}">
                                  @csrf
                                  <li>
                                      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                          <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                              <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                          </svg>
                                          <span>{{ __('Logout') }}</span>
                                      </a>
                                  </li>
                              </form>
                          </ul>
                      </template>
                  </li>
              </ul>
          </div>
      </div>
  </header>
