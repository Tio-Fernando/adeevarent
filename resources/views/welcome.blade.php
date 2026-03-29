<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Adeva Rent - Car Rental</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
  body { font-family: 'Plus Jakarta Sans', sans-serif; }


  .tire-track {
    background-image: repeating-linear-gradient(
      -45deg,
      transparent,
      transparent 6px,
      rgba(0,0,0,0.08) 6px,
      rgba(0,0,0,0.08) 10px
    );
  }

  /* Card hover lift */
  .car-card:hover { transform: translateY(-4px); transition: transform .25s ease; }
  .car-card { transition: transform .25s ease; }
</style>
</head>
<body class="bg-gray-50 text-gray-800">


<nav class="bg-white shadow-sm sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">

    <!-- Logo -->
    <a href="#" class="flex items-center gap-2">
      <img src="{{ asset('img/Logo.png') }}" alt="">
    </a>

    <!-- Menu -->
    <ul class="hidden md:flex gap-8 text-sm font-medium text-gray-700">
      <li><a href="#" class="text-primary font-bold">Home</a></li>
      <li><a href="#" class="hover:text-primary transition">Profile</a></li>
      <li><a href="#" class="hover:text-primary transition">Armada</a></li>
      <li><a href="#" class="hover:text-primary transition">Fasilitas</a></li>
      <li><a href="#" class="hover:text-primary transition">Galery</a></li>
      <li><a href="#" class="hover:text-primary transition">Hubungi Kami</a></li>
    </ul>

  <div class="flex items-center gap-3">
  
    @auth
      <!-- Tombol Logout -->
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
          class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-md">
          Logout
        </button>
      </form>
    @endauth
  
  
    @guest
      
      <a href="{{ route('login') }}"
        class="bg-primary hover:bg-accent text-white text-sm font-bold px-5 py-2.5 rounded-lg transition shadow-md">
        Login
      </a>
    @endguest
  
  </div>
  </div>
</nav>


<section class="max-w-7xl mx-auto px-6 mt-8">
  <div class="relative bg-primary rounded-3xl overflow-hidden min-h-[420px] flex items-stretch">

    <!-- Diagonal lighter panel -->
    <div class="absolute right-[-40px] top-0 w-[55%] h-full bg-primary opacity-60 -skew-x-6 rounded-r-3xl z-0"></div>

    <!-- Watermark triangle "A" -->
    <div class="absolute right-6 top-1/2 -translate-y-1/2 z-[1] opacity-15 pointer-events-none">
      <svg width="280" height="280" viewBox="0 0 200 200">
        <polygon points="100,5 195,195 5,195" fill="none" stroke="white" stroke-width="18"/>
        <polygon points="100,40 170,175 30,175" fill="none" stroke="white" stroke-width="9"/>
        <line x1="45" y1="148" x2="155" y2="148" stroke="white" stroke-width="9"/>
      </svg>
    </div>

    <!-- Tire tracks bottom-left -->
    <div class="absolute left-0 bottom-0 z-[1] opacity-20 pointer-events-none">
      <svg width="170" height="190" viewBox="0 0 160 180">
        <g transform="rotate(-30 80 90)" fill="#7c4500">
          <rect x="20" y="0" width="14" height="6" rx="2"/><rect x="20" y="14" width="14" height="6" rx="2"/>
          <rect x="20" y="28" width="14" height="6" rx="2"/><rect x="20" y="42" width="14" height="6" rx="2"/>
          <rect x="20" y="56" width="14" height="6" rx="2"/><rect x="20" y="70" width="14" height="6" rx="2"/>
          <rect x="20" y="84" width="14" height="6" rx="2"/><rect x="20" y="98" width="14" height="6" rx="2"/>
          <rect x="20" y="112" width="14" height="6" rx="2"/><rect x="20" y="126" width="14" height="6" rx="2"/>
          <rect x="20" y="140" width="14" height="6" rx="2"/><rect x="20" y="154" width="14" height="6" rx="2"/>
          <rect x="50" y="0" width="14" height="6" rx="2"/><rect x="50" y="14" width="14" height="6" rx="2"/>
          <rect x="50" y="28" width="14" height="6" rx="2"/><rect x="50" y="42" width="14" height="6" rx="2"/>
          <rect x="50" y="56" width="14" height="6" rx="2"/><rect x="50" y="70" width="14" height="6" rx="2"/>
          <rect x="50" y="84" width="14" height="6" rx="2"/><rect x="50" y="98" width="14" height="6" rx="2"/>
          <rect x="50" y="112" width="14" height="6" rx="2"/><rect x="50" y="126" width="14" height="6" rx="2"/>
          <rect x="50" y="140" width="14" height="6" rx="2"/><rect x="50" y="154" width="14" height="6" rx="2"/>
        </g>
      </svg>
    </div>

    <!-- LEFT TEXT -->
    <div class="relative z-10 flex flex-col justify-center px-12 py-14 max-w-[460px]">
      <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight">
        Experience the road<br>like never before
      </h1>
      <p class="mt-4 text-white/75 text-sm leading-relaxed max-w-xs">
        Aliquam adipiscing velit semper morbi. Purus non eu cursus porttitor tristique et gravida. Quis nunc interdum gravida ullamcorper.
      </p>
      <a href="#" class="mt-6 w-fit bg-white text-primary text-sm font-bold px-7 py-3 rounded-full shadow-lg hover:bg-gray-50 transition">
        View all cars
      </a>
    </div>

    <!-- RIGHT CAR IMAGE -->
    <div class="absolute right-0 top-0 w-[55%] h-full z-10 flex items-center justify-center pr-8">
      <img src="{{ asset('img/mobil.png') }}" alt="Car"
           class="w-full max-w-[500px] object-contain drop-shadow-2xl">
    </div>

  </div>
</section>


<!-- ══════════════════════════════════════════
     MENGAPA MEMILIH KAMI
══════════════════════════════════════════ -->
<section class="max-w-7xl mx-auto px-6 mt-12 text-center">
  <h2 class="text-2xl font-extrabold text-gray-900">Mengapa Memilih Kami</h2>
  <p class="mt-2 text-gray-400 text-sm max-w-md mx-auto">Kami memberikan layanan terbaik dengan berbagai keunggulan untuk pengalaman rental yang sempurna.</p>

  <div class="grid grid-cols-3 gap-5 mt-8">
    <div class="bg-white rounded-2xl p-6 text-left shadow-sm hover:shadow-md transition">
      <div class="w-10 h-10 bg-white/30 rounded-xl flex items-center justify-center mb-4">
        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
        </svg>
        <div>
        </div>
      </div>
      <h3 class="text-black font-bold text-sm">Harga Terjangkau</h3>
      <p class="text-black/75 text-xs mt-1 leading-relaxed">Layanan premium dengan harga yang kompetitif dan transparan</p>
    </div>
    <!-- Card 2 -->
    <div class="bg-white rounded-2xl p-6 text-left shadow-sm hover:shadow-md transition">
      <div class="w-10 h-10 bg-white/30 rounded-xl flex items-center justify-center mb-4">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
        </svg>
      </div>
      <h3 class="text-white font-bold text-sm">Support 24/7</h3>
      <p class="text-white/75 text-xs mt-1 leading-relaxed">Tim kami siap membantu Anda kapan saja dan di mana saja</p>
    </div>
    <!-- Card 3 -->
    <div class="bg-white rounded-2xl p-6 text-left shadow-sm hover:shadow-md transition">
      <div class="w-10 h-10 bg-white/30 rounded-xl flex items-center justify-center mb-4">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
        </svg>
      </div>
      <h3 class="text-white font-bold text-sm">Armada Lengkap</h3>
      <p class="text-white/75 text-xs mt-1 leading-relaxed">Berbagai pilihan kendaraan untuk semua kebutuhan perjalanan Anda</p>
    </div>
  </div>
</section>


<!-- ══════════════════════════════════════════
     ABOUT / BRAND BANNER
══════════════════════════════════════════ -->
<section class="max-w-7xl mx-auto px-6 mt-12">
  <div class="bg-white rounded-3xl shadow-sm overflow-hidden flex flex-col md:flex-row min-h-[240px]">

    <!-- Left: Car image on primary-->
    <div class="md:w-2/5 bg-primary relative flex items-end justify-center pt-6 overflow-hidden">
      <!-- Watermark -->
      <div class="absolute inset-0 flex items-center justify-center opacity-15">
        <svg width="200" height="200" viewBox="0 0 200 200">
          <polygon points="100,5 195,195 5,195" fill="none" stroke="white" stroke-width="18"/>
        </svg>
      </div>
      <img src="{{ asset('img/mobil.png') }}" alt="Adeva Rent Car"
           class="relative z-10 w-[90%] object-contain drop-shadow-xl">
    </div>

    <!-- Right: Text -->
    <div class="md:w-3/5 p-10 flex flex-col justify-center">
      <p class="text-primary text-xs font-bold uppercase tracking-widest mb-2">Tentang Kami</p>
      <h2 class="text-2xl font-extrabold text-gray-900 leading-snug">
        Adeva <span class="text-primary">RENT</span>
      </h2>
      <p class="mt-3 text-gray-500 text-sm leading-relaxed">
        Adeva Rent hadir untuk memberikan solusi transportasi terbaik bagi Anda. Dengan armada kendaraan modern dan terawat, kami siap mengantarkan perjalanan Anda menjadi pengalaman yang menyenangkan dan tak terlupakan.
      </p>
      <p class="mt-2 text-gray-500 text-sm leading-relaxed">
        Didirikan dengan semangat pelayanan prima, kami berkomitmen untuk selalu mengutamakan kenyamanan dan keamanan pelanggan dalam setiap perjalanan.
      </p>
    </div>

  </div>
</section>


<!-- ══════════════════════════════════════════
     PILIH ARMADA
══════════════════════════════════════════ -->
<section class="max-w-7xl mx-auto px-6 mt-14">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-extrabold text-gray-900">PILIH ARMADA ANDA<br>SEKARANG</h2>
    <a href="#" class="text-primary text-sm font-semibold hover:underline">View All →</a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

    @php
$cars = [
  ['name' => 'Innova Reborn', 'price' => 'Rp 350.000', 'type' => 'SUV', 'seat' => 7, 'fuel' => 'Solar', 'trans' => 'Matic'],
  ['name' => 'Innova Reborn', 'price' => 'Rp 350.000', 'type' => 'SUV', 'seat' => 7, 'fuel' => 'Solar', 'trans' => 'Matic'],
  ['name' => 'Fortuner', 'price' => 'Rp 500.000', 'type' => 'SUV', 'seat' => 7, 'fuel' => 'Solar', 'trans' => 'Matic'],
  ['name' => 'Fortuner', 'price' => 'Rp 500.000', 'type' => 'SUV', 'seat' => 7, 'fuel' => 'Solar', 'trans' => 'Matic'],
  ['name' => 'Fortuner', 'price' => 'Rp 500.000', 'type' => 'SUV', 'seat' => 7, 'fuel' => 'Solar', 'trans' => 'Matic'],
  ['name' => 'Fortuner', 'price' => 'Rp 500.000', 'type' => 'SUV', 'seat' => 7, 'fuel' => 'Solar', 'trans' => 'Matic'],
];
    @endphp

    @foreach($cars as $car)
    <div class="car-card bg-white rounded-2xl shadow-sm hover:shadow-md p-5 flex flex-col">
      <!-- Car image placeholder -->
      <div class="bg-gray-100 rounded-xl h-36 flex items-center justify-center mb-4 overflow-hidden">
        <img src="{{ asset('img/mobil.png') }}" alt="{{ $car['name'] }}"
             class="h-full object-contain">
      </div>

      <div class="flex items-start justify-between">
        <div>
          <h3 class="font-bold text-gray-900 text-sm">{{ $car['name'] }}</h3>
          <span class="text-primary font-extrabold text-base">{{ $car['price'] }}</span>
          <span class="text-gray-400 text-xs">/hari</span>
        </div>
      </div>

      <!-- Specs row -->
      <div class="flex items-center gap-3 mt-3 text-xs text-gray-500">
        <span class="flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
          {{ $car['seat'] }} Kursi
        </span>
        <span class="flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
          {{ $car['fuel'] }}
        </span>
        <span class="flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          {{ $car['trans'] }}
        </span>
      </div>

      <a href="#" class="mt-4 w-full text-center bg-primary hover:bg-primary text-white text-sm font-bold py-2.5 rounded-xl transition">
        Book Now
      </a>
    </div>
    @endforeach

  </div>
</section>


<!-- ══════════════════════════════════════════
     FACTS IN NUMBERS
══════════════════════════════════════════ -->
<section class="max-w-7xl mx-auto px-6 mt-14">
  <div class="bg-primary rounded-3xl px-10 py-12 relative overflow-hidden">
    <!-- Background watermark -->
    <div class="absolute right-10 top-1/2 -translate-y-1/2 opacity-10 pointer-events-none">
      <svg width="300" height="300" viewBox="0 0 200 200">
        <polygon points="100,5 195,195 5,195" fill="none" stroke="white" stroke-width="18"/>
      </svg>
    </div>

    <h2 class="text-white text-2xl font-extrabold text-center mb-10">Facts in Numbers</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 relative z-10">
      @php
$facts = [
  ['num' => '50+', 'label' => 'Armada Tersedia'],
  ['num' => '30+', 'label' => 'Destinasi'],
  ['num' => '2K+', 'label' => 'Pelanggan Puas'],
  ['num' => '20+', 'label' => 'Penghargaan'],
];
      @endphp
      @foreach($facts as $fact)
      <div class="bg-primary/60 rounded-2xl p-5 text-center">
        <div class="text-white text-3xl font-black">{{ $fact['num'] }}</div>
        <div class="text-white/80 text-xs mt-1 font-medium">{{ $fact['label'] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>


<!-- ══════════════════════════════════════════
     CTA BANNER
══════════════════════════════════════════ -->
<section class="max-w-7xl mx-auto px-6 mt-8">
  <div class="bg-primary rounded-3xl px-12 py-14 flex flex-col md:flex-row items-center justify-between relative overflow-hidden">

    <!-- Decorative car silhouette right -->
    <div class="absolute right-0 bottom-0 opacity-15 pointer-events-none">
      <svg width="300" height="160" viewBox="0 0 300 160" fill="white">
        <ellipse cx="150" cy="140" rx="140" ry="20"/>
        <rect x="30" y="80" width="240" height="50" rx="20"/>
        <rect x="70" y="40" width="160" height="55" rx="15"/>
        <circle cx="75" cy="130" r="22"/>
        <circle cx="225" cy="130" r="22"/>
        <circle cx="75" cy="130" r="10" fill="#F5A623"/>
        <circle cx="225" cy="130" r="10" fill="#F5A623"/>
      </svg>
    </div>

    <div class="relative z-10 max-w-md">
      <h2 class="text-white text-3xl font-extrabold leading-snug">
        Enjoy every mile with<br>adorable companionship.
      </h2>
      <p class="text-white/75 text-sm mt-3 leading-relaxed">
        Pesan sekarang dan nikmati perjalanan terbaik bersama kami. Armada terawat, harga terjangkau.
      </p>
    </div>

    <div class="relative z-10 mt-6 md:mt-0 flex items-center gap-3">
      <input type="text" placeholder="Cari kendaraan..."
             class="px-5 py-3 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-white w-52">
      <button class="bg-white text-primary text-sm font-bold px-6 py-3 rounded-xl hover:bg-gray-50 transition whitespace-nowrap">
        Search
      </button>
    </div>
  </div>
</section>


<!-- ══════════════════════════════════════════
     FOOTER
══════════════════════════════════════════ -->
<footer class="bg-gray-900 text-gray-400 mt-14 pt-14 pb-8">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

      <!-- Brand -->
      <div>
        <div class="flex items-center gap-2 mb-4">
          <img src="{{ asset('img/Logo.png') }}" alt="">
          <span class="text-white font-extrabold text-lg">Adeva Rent</span>
        </div>
        <p class="text-xs leading-relaxed">
          Aliquam adipiscing velit semper morbi. Purus non eu cursus porttitor tristique et gravida. Quis nunc interdum.
        </p>
        <!-- Socials -->
        <div class="flex gap-3 mt-4">
          <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition">
            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557a9.83 9.83 0 01-2.828.775 4.932 4.932 0 002.165-2.724 9.864 9.864 0 01-3.127 1.195 4.916 4.916 0 00-8.384 4.482C7.691 8.094 4.066 6.13 1.64 3.161a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.061a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.937 4.937 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63a9.936 9.936 0 002.46-2.548l-.047-.02z"/></svg>
          </a>
          <a href="#" class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition">
            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
        </div>
      </div>

      <!-- Layanan -->
      <div>
        <h4 class="text-white font-bold text-sm mb-4">Layanan Kami</h4>
        <ul class="space-y-2 text-xs">
          <li><a href="#" class="hover:text-primary transition">Sewa Harian</a></li>
          <li><a href="#" class="hover:text-primary transition">Sewa Mingguan</a></li>
          <li><a href="#" class="hover:text-primary transition">Sewa Bulanan</a></li>
          <li><a href="#" class="hover:text-primary transition">Antar Jemput</a></li>
          <li><a href="#" class="hover:text-primary transition">Tour & Travel</a></li>
        </ul>
      </div>

      <!-- Tautan -->
      <div>
        <h4 class="text-white font-bold text-sm mb-4">Tautan</h4>
        <ul class="space-y-2 text-xs">
          <li><a href="#" class="hover:text-primary transition">Home</a></li>
          <li><a href="#" class="hover:text-primary transition">Profile</a></li>
          <li><a href="#" class="hover:text-primary transition">Armada</a></li>
          <li><a href="#" class="hover:text-primary transition">Fasilitas</a></li>
          <li><a href="#" class="hover:text-primary transition">Galery</a></li>
        </ul>
      </div>

      <!-- Download App -->
      <div>
        <h4 class="text-white font-bold text-sm mb-4">Download App</h4>
        <p class="text-xs leading-relaxed mb-4">Dapatkan kemudahan pemesanan melalui aplikasi kami.</p>
        <div class="space-y-2">
          <a href="#" class="flex items-center gap-3 bg-gray-800 hover:bg-gray-700 px-4 py-2.5 rounded-xl transition">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.7 9.05 7.4c1.42.07 2.38.8 3.19.85 1.22-.25 2.38-1 3.69-.87 1.58.19 2.77.9 3.52 2.25-3.23 1.96-2.43 6.18.6 7.32-.58 1.68-1.36 3.34-3 3.33zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/></svg>
            <div>
              <div class="text-gray-400 text-[10px]">Download on the</div>
              <div class="text-white font-bold text-xs">App Store</div>
            </div>
          </a>
          <a href="#" class="flex items-center gap-3 bg-gray-800 hover:bg-gray-700 px-4 py-2.5 rounded-xl transition">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3.18 23.76c.3.16.65.18.97.06l12.4-7.17-2.77-2.77-10.6 9.88zm-1.15-21.2a1.5 1.5 0 00-.03.37v18.14c0 .14.01.27.04.4l10.88-10.06L2.03 2.56zm19.07 8.94l-2.48-1.44-3.13 2.9 3.13 2.9 2.5-1.45a1.5 1.5 0 000-2.91zm-18.03-9.5l10.6 9.87 2.77-2.77L3.97.94a1.1 1.1 0 00-.9.06z"/></svg>
            <div>
              <div class="text-gray-400 text-[10px]">Get it on</div>
              <div class="text-white font-bold text-xs">Google Play</div>
            </div>
          </a>
        </div>
      </div>

    </div>

    <div class="border-t border-gray-800 mt-10 pt-6 text-center text-xs">
      © {{ date('Y') }} Adeva Rent. All rights reserved.
    </div>
  </div>
</footer>

</body>
</html>