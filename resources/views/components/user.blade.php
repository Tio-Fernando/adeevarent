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
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  body { font-family: 'Inter', sans-serif; }

  h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', sans-serif;
  }
  #map { 
        z-index: 1 !important; 
    }

    .leaflet-pane, 
    .leaflet-top, 
    .leaflet-bottom,
    .leaflet-proxy,
    .leaflet-marker-icon,
    .leaflet-popup {
        z-index: 1 !important;
    }

    .leaflet-marker-shadow {
        z-index: 0 !important;
    }

  .tire-track {
    background-image: repeating-linear-gradient(
      -45deg,
      transparent,
      transparent 6px,
      rgba(0,0,0,0.08) 6px,
      rgba(0,0,0,0.08) 10px
    );
    select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
  }

  .car-card:hover { transform: translateY(-4px); transition: transform .25s ease; }
  .car-card { transition: transform .25s ease; }
</style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">
<nav class="bg-secon shadow-sm sticky top-0 p-5 z-50" x-data="{ openMenuMobile: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between h-16">

    <a href="{{route('home')}}" class="flex items-center gap-2 shrink-0">
      <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="h-15">
    </a>

    <ul class="hidden md:flex gap-8 text-sm font-medium text-gray-300">
      <li>
        <a href="{{ route('home') }}"
           class="transition {{ request()->routeIs('home') ? 'text-primary font-bold' : 'hover:text-white' }}">
            Beranda
        </a>
      </li>
      <li>
        <a href="{{ route('profileCompany') }}" class="transition {{ request()->routeIs('profileCompany') ? 'text-primary font-bold' : 'hover:text-white' }}">Profile</a>
      </li>
      <li>
        <a href="{{ route('armada') }}"
           class="transition {{ request()->routeIs('armada') ? 'text-primary font-bold' : 'hover:text-white' }}">
            Armada
        </a>
      </li>
      <li>
        <a href="{{ route('fasilitas') }}"
           class="transition {{ request()->routeIs('fasilitas') ? 'text-primary font-bold' : 'hover:text-white' }}">
           Layanan
        </a>
      </li>
      <li>
        <a href="{{ route('gallery') }}"
           class="transition {{ request()->routeIs('gallery') ? 'text-primary font-bold' : 'hover:text-white' }}">
           Galeri
        </a>
      </li>
        <li>
        <a href="{{ route('hubungi') }}" class="transition {{ request()->routeIs('hubungi') ? 'text-primary font-bold' : 'hover:text-white' }}">Hubungi Kami</a>
      </li>
    </ul>

    <div class="flex items-center gap-2 sm:gap-4">

      @auth
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
          <div @click="open = !open" class="flex items-center gap-2 cursor-pointer hover:bg-white/10 p-1.5 sm:p-2 rounded-lg transition">
            <img class="w-8 h-8 rounded-full border-2 border-primary shrink-0"
                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=FF9E0C&color=fff"
                 alt="{{ Auth::user()->name }}">

            <div class="hidden sm:block text-left">
              <p class="text-sm font-semibold text-gray-100 leading-tight">{{ Auth::user()->nama }}</p>
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
              Profil Saya
            </a>
            <a href="{{ route('profile.rental-history') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
              <svg class="w-4 h-4 mr-3 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 8V12L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M5.60423 5.60423L5.0739 5.0739V5.0739L5.60423 5.60423ZM4.33785 6.87061L3.58786 6.87438C3.58992 7.28564 3.92281 7.61853 4.33408 7.6206L4.33785 6.87061ZM6.87963 7.63339C7.29384 7.63547 7.63131 7.30138 7.63339 6.88717C7.63547 6.47296 7.30138 6.13549 6.88717 6.13341L6.87963 7.63339ZM5.07505 4.32129C5.07296 3.90708 4.7355 3.57298 4.32129 3.57506C3.90708 3.57715 3.57298 3.91462 3.57507 4.32882L5.07505 4.32129ZM3.75 12C3.75 11.5858 3.41421 11.25 3 11.25C2.58579 11.25 2.25 11.5858 2.25 12H3.75ZM16.8755 20.4452C17.2341 20.2378 17.3566 19.779 17.1492 19.4204C16.9418 19.0619 16.483 18.9393 16.1245 19.1468L16.8755 20.4452ZM19.1468 16.1245C18.9393 16.483 19.0619 16.9418 19.4204 17.1492C19.779 17.3566 20.2378 17.2341 20.4452 16.8755L19.1468 16.1245ZM5.14033 5.07126C4.84598 5.36269 4.84361 5.83756 5.13505 6.13191C5.42648 6.42626 5.90134 6.42862 6.19569 6.13719L5.14033 5.07126ZM18.8623 5.13786C15.0421 1.31766 8.86882 1.27898 5.0739 5.0739L6.13456 6.13456C9.33366 2.93545 14.5572 2.95404 17.8017 6.19852L18.8623 5.13786ZM5.0739 5.0739L3.80752 6.34028L4.86818 7.40094L6.13456 6.13456L5.0739 5.0739ZM4.33408 7.6206L6.87963 7.63339L6.88717 6.13341L4.34162 6.12062L4.33408 7.6206ZM5.08784 6.86684L5.07505 4.32129L3.57507 4.32882L3.58786 6.87438L5.08784 6.86684ZM12 3.75C16.5563 3.75 20.25 7.44365 20.25 12H21.75C21.75 6.61522 17.3848 2.25 12 2.25V3.75ZM12 20.25C7.44365 20.25 3.75 16.5563 3.75 12H2.25C2.25 17.3848 6.61522 21.75 12 21.75V20.25ZM16.1245 19.1468C14.9118 19.8483 13.5039 20.25 12 20.25V21.75C13.7747 21.75 15.4407 21.2752 16.8755 20.4452L16.1245 19.1468ZM20.25 12C20.25 13.5039 19.8483 14.9118 19.1468 16.1245L20.4452 16.8755C21.2752 15.4407 21.75 13.7747 21.75 12H20.25ZM6.19569 6.13719C7.68707 4.66059 9.73646 3.75 12 3.75V2.25C9.32542 2.25 6.90113 3.32791 5.14033 5.07126L6.19569 6.13719Z" fill="currentColor"></path>
              </svg>
              Riwayat Rental
            </a>
            <hr class="border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                <svg class="w-4 h-4 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Keluar
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
      <li><a href="#" class="block py-2 hover:text-white transition">Contact Us</a></li>
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
 @stack('scripts')
</body>
</html>