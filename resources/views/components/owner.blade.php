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

    <div class="flex flex-grow ">
        
        <x-sidebar-owner></x-sidebar-owner>
        <div class="flex flex-col flex-grow w-full">
            <header class="bg-white border-b border-gray-100 h-20 flex items-center justify-between px-8 z-20">
         <div class="relative w-96 hidden md:block">
             <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                 </svg>
             </span>
             <input type="text" placeholder="Search..." class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-full focus:ring-orange-500 focus:border-orange-500 block pl-10 p-2.5 outline-none sm:text-sm">
         </div>
     
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
     
             <div x-show="open" 
                  x-transition:enter="transition ease-out duration-100"
                  x-transition:enter-start="transform opacity-0 scale-95"
                  x-transition:enter-end="transform opacity-100 scale-100"
                  x-transition:leave="transition ease-in duration-75"
                  x-transition:leave-start="transform opacity-100 scale-100"
                  x-transition:leave-end="transform opacity-0 scale-95"
                  class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-30 overflow-hidden" 
                  style="display: none;">
                 
                 <div class="px-4 py-3 border-b border-gray-50 md:hidden">
                     <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                 </div>
     
                 <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition">
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
     </header>
     <main class="flex-grow bg-white">
         {{ $slot }} 
     </main>
        </div>

    </div>

</body>
</html>