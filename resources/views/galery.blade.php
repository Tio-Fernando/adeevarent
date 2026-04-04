<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adeva Rent - Galery</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }

        /* Animasi trigger saat berpindah halaman (Load Animation) */
        @keyframes pageFadeUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-page-load {
            animation: pageFadeUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

<nav class="bg-white shadow-sm sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">

    <a href="{{ route('home') }}" class="flex items-center gap-2">
      <img src="{{ asset('img/Logo.png') }}" alt="">
    </a>

    <ul class="hidden md:flex gap-8 text-sm font-medium text-gray-700">
      <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-primary font-bold' : 'hover:text-primary transition' }}">Home</a></li>
      <li><a href="{{ route('profile.perusahaan') }}" class="{{ request()->routeIs('profile.perusahaan') ? 'text-primary font-bold' : 'hover:text-primary transition' }}">Profile</a></li>
      <li><a href="#" class="hover:text-primary transition">Armada</a></li>
      <li><a href="#" class="hover:text-primary transition">Fasilitas</a></li>
      <li><a href="{{ route('galery') }}" class="{{ request()->routeIs('galery') ? 'text-primary font-bold' : 'hover:text-primary transition' }}">Galery</a></li>
      <li><a href="#" class="hover:text-primary transition">Hubungi Kami</a></li>
    </ul>

    @auth     
    <div class="relative" x-data="{ open: false }" @click.away="open = false">
        <div @click="open = !open" class="flex items-center space-x-3 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
            <img class="w-10 h-10 rounded-full border-2 border-orange-100" 
                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=FF9E0C&color=fff" 
                 alt="{{ Auth::user()->name }}">
            
            <div class="hidden sm:block">
                <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
            </div>
            
            <svg class="w-4 h-4 text-gray-500 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>

        <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-30 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-50 md:hidden">
                <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
            </div>
            <a href="{{ route('profile.user') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
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
      <a href="{{ route('login') }}"
        class="bg-primary hover:bg-accent text-white text-sm font-bold px-5 py-2.5 rounded-lg transition shadow-md">
        Login
      </a>
    @endguest
  </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-16 animate-page-load">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight">Galery</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="bg-gray-50 rounded-[2.5rem] overflow-hidden shadow-sm aspect-video group cursor-pointer transition-shadow duration-300 hover:shadow-xl">
            <img src="{{ asset('img/kantor1.jpeg') }}" alt="Meja Admin" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>
        <div class="bg-gray-50 rounded-[2.5rem] overflow-hidden shadow-sm aspect-video group cursor-pointer transition-shadow duration-300 hover:shadow-xl">
            <img src="{{ asset('img/kantor2.jpeg') }}" alt="Banner" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>
        <div class="bg-gray-50 rounded-[2.5rem] overflow-hidden shadow-sm aspect-video group cursor-pointer transition-shadow duration-300 hover:shadow-xl">
            <img src="{{ asset('img/kantor3.jpeg') }}" alt="Sertifikat" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>
        <div class="bg-gray-50 rounded-[2.5rem] overflow-hidden shadow-sm aspect-video group cursor-pointer transition-shadow duration-300 hover:shadow-xl">
            <img src="{{ asset('img/kantor4.jpeg') }}" alt="Meja Admin2" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>
        <div class="bg-gray-50 rounded-[2.5rem] overflow-hidden shadow-sm aspect-video group cursor-pointer transition-shadow duration-300 hover:shadow-xl">
            <img src="{{ asset('img/kantor5.jpeg') }}" alt="Logo" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>
        <div class="bg-gray-50 rounded-[2.5rem] overflow-hidden shadow-sm aspect-video group cursor-pointer transition-shadow duration-300 hover:shadow-xl">
            <img src="{{ asset('img/kantor6.jpeg') }}" alt="Surat Izin" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        </div>
    </div>
</div>

<footer class="bg-[#0B1221] text-white pt-20 pb-10 font-['Poppins']">
    <div class="max-w-7xl mx-auto px-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            
            <div class="md:col-span-1 space-y-6">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('img/Logo.png') }}" alt="Logo Adeva" class="h-14 brightness-110">
                    <h3 class="text-xl font-bold">Adeva Rent</h3>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs font-['Inter']">
                    Adeva Rent menyediakan layanan rental mobil dengan berbagai pilihan kendaraan yang siap digunakan untuk perjalanan Anda. Kami mengutamakan kenyamanan.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800/50 hover:bg-[#FF9E0C] transition text-xs">t</a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-800/50 hover:bg-[#FF9E0C] transition text-xs">ig</a>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-6">Layanan Kami</h4>
                <ul class="text-gray-400 text-sm space-y-4 font-['Inter']">
                    <li><a href="#" class="hover:text-[#FF9E0C] transition">Sewa Harian</a></li>
                    <li><a href="#" class="hover:text-[#FF9E0C] transition">Sewa Mingguan</a></li>
                    <li><a href="#" class="hover:text-[#FF9E0C] transition">Sewa Bulanan</a></li>
                    <li><a href="#" class="hover:text-[#FF9E0C] transition">Antar Jemput</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-6">Tautan</h4>
                <ul class="text-gray-400 text-sm space-y-4 font-['Inter']">
                    <li><a href="{{ route('home') }}" class="hover:text-[#FF9E0C] transition">Home</a></li>
                    <li><a href="{{ route('profile.perusahaan') }}" class="hover:text-[#FF9E0C] transition">Profile</a></li>
                    <li><a href="#" class="hover:text-[#FF9E0C] transition">Armada</a></li>
                    <li><a href="#" class="hover:text-[#FF9E0C] transition">Fasilitas</a></li>
                    <li><a href="{{ route('galery') }}" class="hover:text-[#FF9E0C] transition">Galery</a></li>
                </ul>
            </div>

            <div class="text-gray-500 text-sm">
                hai
            </div>

        </div>

        <div class="border-t border-gray-800 pt-8 text-center">
            <p class="text-gray-500 text-xs font-['Inter']">
                © 2026 Adeva Rent. All rights reserved.
            </p>
        </div>
    </div>
</footer>

</body>
</html>