<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Adeva Rent') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        .text-primary { color: #FF9E0C; }
        .bg-primary { background-color: #FF9E0C; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">
            
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="h-10">
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
                        <p class="text-sm font-semibold text-gray-700 leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <svg class="w-4 h-4 text-gray-500 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
       
                <div x-show="open" 
                     style="display: none;"
                     class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-50 overflow-hidden">
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-orange-50 transition">
                        Dashboard Admin
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-orange-50 transition">
                        My Settings
                    </a>
       
                    <hr class="border-gray-50">
       
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition">
                            Logout
                        </button>
                    </form> 
                </div>
            </div>
            @endauth

            @guest
              <a href="{{ route('login') }}"
                class="bg-primary hover:bg-orange-600 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition shadow-md">
                Login
              </a>
            @endguest
        </div>
    </nav>

    <div class="flex h-screen overflow-hidden">
        
        @if(request()->routeIs('dashboard*') || request()->routeIs('kendaraan*') || request()->routeIs('kategori*'))
            @include('layouts.sidebar')
        @endif

        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                @if (isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </div>

    @include('sweetalert2::index')
</body>
</html>