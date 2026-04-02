<!DOCTYPE html>
<html lang="en" class="overscroll-none bg-secon">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Adeva Rent - Car Rental</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  body { font-family: 'Inter', sans-serif; }

  h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', sans-serif;
  }

  .tire-track {
    background-image: repeating-linear-gradient(
      -45deg,
      transparent,
      transparent 6px,
      rgba(0,0,0,0.08) 6px,
      rgba(0,0,0,0.08) 10px
    );
  }

  .car-card:hover { transform: translateY(-4px); transition: transform .25s ease; }
  .car-card { transition: transform .25s ease; }
</style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">
<nav class="bg-secon shadow-sm sticky top-0 p-5 z-50" x-data="{ openMenuMobile: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between h-16">

    <a href="#" class="flex items-center gap-2 shrink-0">
      <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="h-15">
    </a>

    <ul class="hidden md:flex gap-8 text-sm font-medium text-gray-300">
      <li>
        <a href="{{ route('home') }}"
           class="transition {{ request()->routeIs('home') ? 'text-primary font-bold' : 'hover:text-white' }}">
            Home
        </a>
      </li>
      <li><a href="#" class="hover:text-white transition">Profile</a></li>
      <li>
        <a href="{{ route('armada') }}"
           class="transition {{ request()->routeIs('armada') ? 'text-primary font-bold' : 'hover:text-white' }}">
            Armada
        </a>
      </li>
      <li>
        <a href="{{ route('fasilitas') }}"
           class="transition {{ request()->routeIs('fasilitas') ? 'text-primary font-bold' : 'hover:text-white' }}">
           Fasilitas
        </a>
      </li>
      <li>
        <a href="{{ route('gallery') }}"
           class="transition {{ request()->routeIs('gallery') ? 'text-primary font-bold' : 'hover:text-white' }}">
           Galery
        </a>
      </li>
      <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
    </ul>

    <div class="flex items-center gap-2 sm:gap-4">

      @auth
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
          <div @click="open = !open" class="flex items-center gap-2 cursor-pointer hover:bg-white/10 p-1.5 sm:p-2 rounded-lg transition">
            <img class="w-8 h-8 rounded-full border-2 border-primary shrink-0"
                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=FF9E0C&color=fff"
                 alt="{{ Auth::user()->name }}">

            <div class="hidden sm:block text-left">
              <p class="text-sm font-semibold text-gray-100 leading-tight">{{ Auth::user()->name }}</p>
              <p class="text-xs text-gray-400 leading-tight">{{ Auth::user()->email }}</p>
            </div>

            <svg class="w-4 h-4 text-gray-400 transition-transform hidden sm:block" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

            <div class="px-4 py-3 border-b border-gray-100 sm:hidden">
              <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
              <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>

            <a href="{{ route('profile.user') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
              <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
              My Profile
            </a>
            <hr class="border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
              </button>
            </form>
          </div>
        </div>
      @endauth

      @guest
        <a href="{{ route('login') }}"
           class="bg-primary hover:bg-orange-600 hidden md:block text-white text-xs sm:text-sm font-bold px-3 sm:px-5 py-2 sm:py-2.5 rounded-lg transition shadow-md whitespace-nowrap">
          Login
        </a>
      @endguest


      <button @click="openMenuMobile = !openMenuMobile" class="md:hidden p-2 text-gray-300 hover:text-white focus:outline-none transition">
        <svg x-show="!openMenuMobile" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg x-show="openMenuMobile" style="display: none;" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>

    </div>
  </div>

  {{-- Mobile Menu --}}
  <div x-show="openMenuMobile"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-2"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-2"
       class="md:hidden border-t border-white/10"
       style="display: none;">

    <ul class="flex flex-col px-6 py-4 gap-1 text-sm font-medium text-gray-300">
      <li><a href="{{ route('home') }}" class="block py-2 transition {{ request()->routeIs('home') ? 'text-primary font-bold' : 'hover:text-white' }}">Home</a></li>
      <li><a href="#" class="block py-2 hover:text-white transition">Profile</a></li>
      <li><a href="{{ route('armada') }}" class="block py-2 transition {{ request()->routeIs('armada') ? 'text-primary font-bold' : 'hover:text-white' }}">Armada</a></li>
      <li><a href="{{ route('fasilitas') }}" class="block py-2 transition {{ request()->routeIs('fasilitas') ? 'text-primary font-bold' : 'hover:text-white' }}">Fasilitas</a></li>
      <li><a href="{{ route('gallery') }}" class="block py-2 transition {{ request()->routeIs('gallery') ? 'text-primary font-bold' : 'hover:text-white' }}">Galery</a></li>
      <li><a href="#" class="block py-2 hover:text-white transition">Hubungi Kami</a></li>
       @guest
    <li class="pt-2 border-t border-white/10">
      <a href="{{ route('login') }}"
         class="block py-2 text-primary font-bold hover:text-orange-400 transition">
          Login
      </a>
    </li>
  @endguest
  @auth
  <li>
    <a href="{{ route('profile.user') }}"
       class="block py-2 transition {{ request()->routeIs('profile.user') ? 'text-primary font-bold' : 'hover:text-white' }}">
        Profile
    </a>
  </li>
@endauth

    </ul>
  </div>

</nav>


<main class="flex-grow">
        {{ $slot }} 
 </main>
 <x-footer/>
</body>
</html>