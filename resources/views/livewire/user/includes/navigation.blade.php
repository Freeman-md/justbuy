<header class="bg-white shadow">
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
  
        <div class="flex justify-between">
          
          {{-- Title --}}
          <h2 class="text-xl font-semibold leading-tight text-gray-800">
            @if(request()->routeIs('user'))
                {{ __('Dashboard') }}
            @elseif(request()->routeIs('user-orders') || request()->segment(2) == 'orders')
                {{ __('Orders') }}
            @elseif(request()->routeIs('profile.show'))
                {{ __('Profile') }}
            @endif
          </h2>
        
          {{-- Main Navigation --}}
          <div class="hidden space-x-4 md:flex">
            <x-jet-nav-link href="{{ route('user') }}" :active="request()->routeIs('user')">
              {{ __('Dashboard') }}
            </x-jet-nav-link>
            <x-jet-nav-link href="{{ route('user-orders') }}" :active="request()->routeIs('user-orders')">
                {{ __('Orders') }}
            </x-jet-nav-link>
            <div class="relative space-x-8 sm:-my-px sm:ml-3 md:ml-10" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                <x-jet-nav-link @click="open = !open" class="cursor-pointer" :active="request()->routeIs('profile.show')">
                    {{ __('My Account') }}
                </x-jet-nav-link>
                <div x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-50 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg w-60"
                        style="display: none;"
                        @click="open = false">
                    <div class="rounded-md ring-1 ring-black ring-opacity-5">
                        <a href="{{ route('profile.show')}}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition @if(request()->segment(2) == 'profile') bg-gray-100 @endif">
                            {{ __('Profile') }}
                        </a>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>
          </div>

          {{-- Mobile Navigation --}}
          <div class="flex md:hidden">
            <div class="relative space-x-8 sm:-my-px sm:ml-3 md:ml-10" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                <a @click="open = !open" class="cursor-pointer" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                    <!-- Hamburger -->
                    <span class="fas fa-ellipsis-v"></span>
                </a>
                <div x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-50 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg w-60"
                        style="display: none;"
                        @click="open = false">
                    <div class="rounded-md ring-1 ring-black ring-opacity-5">
                        <a href="{{ route('user')}}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition @if(request()->segment(1) == 'user' && request()->segment(2) == '' || request()->segment(2) == null) bg-gray-100 @endif">
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('user-orders')}}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition @if(request()->segment(2) == 'orders') bg-gray-100 @endif">
                            {{ __('Orders') }}
                        </a>
                        <a href="{{ route('profile.show')}}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition @if(request()->segment(2) == 'profile') bg-gray-100 @endif">
                            {{ __('Profile') }}
                        </a>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-jet-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>
          </div>
  
        </div>
    </div>
  </header>