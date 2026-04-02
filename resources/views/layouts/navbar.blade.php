<nav class="bg-white shadow-sm sticky top-0 z-50 relative" x-data="{ openMenuMobile: false }">
  <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">

    <a href="#" class="flex items-center gap-2">
      <img src="{{ asset('img/Logo.png') }}" alt="Logo Adeva" class="h-8">
    </a>

    <ul class="hidden md:flex gap-8 text-sm font-medium text-gray-700">
      <li><a href="{{ route('home') }}" class="transition {{ request()->routeIs('home') ? 'text-primary font-bold' : 'hover:text-primary' }}">Home</a></li>
      <li><a href="#" class="hover:text-primary transition">Profile</a></li>
      <li><a href="{{ route('armada') }}" class="transition {{ request()->routeIs('armada') ? 'text-primary font-bold' : 'hover:text-primary' }}">Armada</a></li>
      <li><a href="#" class="hover:text-primary transition">Fasilitas</a></li>
      <li><a href="#" class="hover:text-primary transition">Galery</a></li>
      <li><a href="#" class="hover:text-primary transition">Hubungi Kami</a></li>
    </ul>

    <div class="flex items-center gap-4">
      
      @auth    
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <div @click="open = !open" class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                <img class="w-8 h-8 md:w-10 md:h-10 rounded-full border-2 border-orange-100" 
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=FF9E0C&color=fff" 
                     alt="{{ Auth::user()->name }}">
                
                <div class="hidden sm:block">
                    <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                </div>
                
                <svg class="w-4 h-4 text-gray-500 transition-transform hidden sm:block" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
       
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-30 overflow-hidden" 
                 style="display: none;">
                
                <div class="px-4 py-3 border-b border-gray-50 sm:hidden">
                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                </div>
       
                <a href="{{-- route('profile.user') --}}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    My Profile
                </a>
                <hr class="border-gray-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form> 
            </div>
        </div>
      @endauth

      @guest
        <a href="{{ route('login') }}" class="bg-primary hover:bg-orange-600 text-white text-xs md:text-sm font-bold px-4 md:px-5 py-2 md:py-2.5 rounded-lg transition shadow-md">
          Login
        </a>
      @endguest

      <button @click="openMenuMobile = !openMenuMobile" class="md:hidden p-2 text-gray-600 hover:text-primary focus:outline-none transition">
        <svg x-show="!openMenuMobile" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg x-show="openMenuMobile" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>

    </div>
  </div>

  <div x-show="openMenuMobile" 
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-4"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-4"
       class="md:hidden absolute top-16 left-0 w-full bg-white border-t border-gray-100 shadow-xl z-10"
       style="display: none;">
       
      <ul class="flex flex-col px-6 py-4 gap-4 text-sm font-medium text-gray-700">
        <li><a href="{{ route('home') }}" class="block {{ request()->routeIs('home') ? 'text-primary font-bold' : 'hover:text-primary' }}">Home</a></li>
        <li><a href="#" class="block hover:text-primary transition">Profile</a></li>
        <li><a href="{{ route('armada') }}" class="block {{ request()->routeIs('armada') ? 'text-primary font-bold' : 'hover:text-primary' }}">Armada</a></li>
        <li><a href="#" class="block hover:text-primary transition">Fasilitas</a></li>
        <li><a href="#" class="block hover:text-primary transition">Galery</a></li>
        <li><a href="#" class="block hover:text-primary transition">Hubungi Kami</a></li>
      </ul>
  </div>
</nav>