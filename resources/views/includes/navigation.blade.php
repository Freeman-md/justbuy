<div x-data="{open: false}" class="z-2">

  {{-- Top Navigation --}}
  <div class="py-2 text-xs text-gray-700 bg-gray-300">
    <div class="flex flex-col items-center justify-between sm:flex-row responsive-container">
      
      <a href="tel:+2347037500464" class="hover:text-gray-900">
        <span class="mr-1 fas fa-phone-alt"></span>
        <span>Call: +2347037500464</span>
      </a>
      
      <div class="flex justify-around space-x-3">
        
        @guest
        <a href="{{ route('register') }}" class="hover:text-gray-900">
          <span class="mr-1 fas fa-user"></span>
          <span>Register</span>
        </a>
        <a href="{{ route('login') }}" class="hover:text-gray-900">
          <span class="mr-1 fas fa-door-open"></span>
          <span>Login</span>
        </a>
        @else
        <span class="hover:text-gray-900">
          <span>Welcome <span class="font-bold authUsername">{{ auth()->user()->username }}</span></span>
        </span>
        
        {{-- My Account Dropdown --}}
        <div x-data="{myAccount: false}" class="relative inline-block text-left">
          <div>
              <button @click="myAccount=!myAccount" type="button" class="inline-flex justify-center px-3 text-xs rounded-md hover:text-gray-900 focus:outline-none" :class="{'text-gray-900': myAccount}"  id="options-menu" aria-expanded="true" aria-haspopup="true">
                  My Account
                  <!-- Heroicon name: solid/chevron-down -->
                  <svg class="w-4 h-4 ml-1 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                  </svg>
              </button>
          </div>

          <div x-show.transition.fade.duration.50ms="myAccount" class="absolute z-50 w-20 mt-1 bg-white rounded-md shadow-lg right-25 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
              <div class="container p-2 mx-auto" role="none">
                  {{-- Item --}}
                  <a href="{{ route('profile.show') }}" class="flex items-center mb-2 text-gray-500 hover:text-gray-900">
                      <i class="w-3 h-2 mr-2 -mt-1 text-center fa fa-user-cog"></i>
                      <div>
                          <span class="block text-xs font-bold transition duration-300 cursor-pointer">Profile</span>
                      </div>
                  </a>

                  {{-- Item --}}
                  <div class="flex items-center mb-2 text-gray-500 hover:text-gray-900">
                    <i class="w-3 h-2 mr-2 -mt-1 text-center fa fa-door-open"></i>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="block text-xs font-bold transition duration-300">Logout</button>
                    </form>
                  </div>

              </div>
          </div>

        </div>

        @endguest
      </div>
      
    </div>
  </div>

  {{-- Main Navigation --}}
  <div class="py-4 bg-white z-1">
    <div class="flex items-center justify-between text-base font-semibold text-gray-700 responsive-container">

      <!-- Hamburger - Open Mobile Navigation [Displayed on mobile devices only]-->
      <div class="flex items-center -mr-2 md:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition rounded-md hover:text-gray-500 focus:outline-none focus:text-gray-500">
            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
      </div>
      
      {{-- Left Navigation Links --}}
      <div class="flex-none hidden text-gray-600 md:space-x-1 lg:space-x-4 md:inline-block">
        <a class="transition duration-100 hover:text-black" href="{{ route('index') }}">Home</a>
        <a class="transition duration-100 hover:text-black" href="{{ route('gallery') }}">Gallery</a>
        <a class="transition duration-100 hover:text-black" href="{{ route('about-us') }}">About Us</a>
        <a class="transition duration-100 hover:text-black" href="{{ route('contact-us') }}">Contact Us</a>
        @auth
        <a class="transition duration-100 hover:text-black" href="{{ auth()->user()->isAdmin() ? route('admin') : route('user') }}">Dashboard</a>
        @endauth
      </div>

      {{-- Application Logo --}}
      <div class="flex-grow text-center">
        <div class="flex flex-col items-center justify-center">
          <a href="{{ route('index') }}">
            <x-svg.logo />
          </a>
        </div>
      </div>

      {{-- Right Navigation Links --}}
      <div class="flex-none">
        <div class="flex items-center">
        
          {{-- Cart --}}
          <a href="{{ route('cart') }}" class="flex flex-col mr-2 space-0">
            <div>
              <span class="fas fa-shopping-cart"></span>
              <sup class="text-xs text-white bg-black rounded-full p-0.5" id="cartNumber">{{ Cart::count() }}</sup>
            </div>
          </a>
          <div class="hidden md:inline-block">
            {{-- Search Dropdown --}}
            @livewire('includes.search')
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Mobile Navigation Menu -->
  <div :class="{'block': open, 'hidden': ! open}" class="hidden bg-white z-1 md:hidden">
    <div class="pt-2 pb-3 space-y-1">
        
      <x-jet-responsive-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
        {{ __('Home') }}
      </x-jet-responsive-nav-link>
      <x-jet-responsive-nav-link href="{{ route('gallery') }}" :active="request()->routeIs('gallery')">
        {{ __('Gallery') }}
      </x-jet-responsive-nav-link>
      <x-jet-responsive-nav-link href="{{ route('about-us') }}" :active="request()->routeIs('about-us')">
        {{ __('About Us') }}
      </x-jet-responsive-nav-link>
      <x-jet-responsive-nav-link href="{{ route('contact-us') }}" :active="request()->routeIs('contact-us')">
        {{ __('Contact Us') }}
      </x-jet-responsive-nav-link>
      @auth
        <x-jet-responsive-nav-link href="{{ auth()->user()->isAdmin() ? route('admin') : route('user') }}" :active="request()->routeIs('user')">
            {{ __('Dashboard') }}
        </x-jet-responsive-nav-link>
      @endauth
        
      <div class="py-2 pl-3 pr-4">
        {{-- Search Dropdown --}}
        @livewire('includes.search')
      </div>
        
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
        @guest
        
        @else
        <div class="flex items-center px-4">
            <div>
                <div class="text-base font-medium text-gray-800 authUsername">{{ Auth::user()->username }}</div>
                <div class="text-sm font-medium text-gray-500 authEmail">{{ Auth::user()->email }}</div>
            </div>
        </div>
        
        <div class="mt-3 space-y-1">
            <!-- Account Management -->
            <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                {{ __('Profile') }}
            </x-jet-responsive-nav-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-jet-responsive-nav-link href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-jet-responsive-nav-link>
            </form>
        </div>
        @endguest
        
    </div>
  </div>

</div>