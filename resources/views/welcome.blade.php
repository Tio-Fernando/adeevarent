<x-user>
  <section class="max-w-7xl mx-auto px-6 mt-8">
  <div class="relative bg-primary rounded-3xl overflow-hidden flex items-stretch">

    {{-- Skew background --}}
    <div class="absolute right-[-40px] top-0 w-[55%] h-full bg-primary opacity-60 -skew-x-6 rounded-r-3xl z-0"></div>

    {{-- Triangle decoration --}}
    <div class="hidden sm:block absolute right-6 top-1/2 -translate-y-1/2 z-[1] opacity-15 pointer-events-none">
      <svg width="280" height="280" viewBox="0 0 200 200">
        <polygon points="100,5 195,195 5,195" fill="none" stroke="white" stroke-width="18"/>
        <polygon points="100,40 170,175 30,175" fill="none" stroke="white" stroke-width="9"/>
        <line x1="45" y1="148" x2="155" y2="148" stroke="white" stroke-width="9"/>
      </svg>
    </div>

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

    <div class="relative z-10 w-full grid grid-cols-1 sm:grid-cols-2">

      <div class="flex flex-col justify-center px-8 sm:px-12 py-10 sm:py-14 text-center sm:text-left">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-tight">
          Experience the road<br>like never before
        </h1>
        <p class="mt-3 sm:mt-4 text-white/75 text-sm leading-relaxed max-w-sm mx-auto sm:mx-0">
          Aliquam adipiscing velit semper morbi. Purus non eu cursus porttitor tristique et gravida. Quis nunc interdum gravida ullamcorper.
        </p>
        <a href="#" class="mt-5 sm:mt-6 w-fit mx-auto sm:mx-0 bg-white text-primary text-sm font-bold px-7 py-3 rounded-full shadow-lg hover:bg-gray-50 transition">
          View all cars
        </a>
      </div>

      <div class="flex items-end sm:items-center justify-center px-6 pb-0 sm:py-14 sm:pr-8">
        <img src="{{ asset('img/mobil2.png') }}" alt="Car"
             class="w-full max-w-[300px] sm:max-w-[500px] object-contain drop-shadow-2xl">
      </div>

    </div>

</div>
</section>



<section class="max-w-7xl mx-auto px-6 mt-12 text-center">
  <h2 class="text-2xl font-extrabold text-gray-900">Mengapa Memilih Kami</h2>
  <p class="mt-2 text-gray-400 text-sm max-w-md mx-auto">Kami memberikan layanan terbaik dengan berbagai keunggulan untuk pengalaman rental yang sempurna.</p>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-8">
    
      <div class="bg-white border border-1 hover:border-primary border-gray-200 rounded-2xl p-6 text-left shadow-sm hover:shadow-md transition">
         <div class="flex items-center justify-center">
 <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center mb-4">
          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
          </svg>
          <div>
          </div>
        </div>
      </div>
      
        <h3 class=" text-center font-bold text-sm text-primary">Harga Terjangkau</h3>
      <p class="text-black/75 text-xs mt-1 text-center leading-relaxed">Layanan premium dengan harga yang kompetitif dan transparan</p>
    </div>
  
      <div class="bg-white border border-1 hover:border-primary border-gray-200 rounded-2xl p-6 text-left shadow-sm hover:shadow-md transition">
       <div class="flex items-center justify-center">
         <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center mb-4">
          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
       </div>
       <div class="text-center">
         <h3 class="text-primary font-bold text-sm">Support 24/7</h3>
         <p class="text-black/75 text-xs mt-1 leading-relaxed">Tim kami siap membantu Anda kapan saja dan di mana saja</p>
        </div>
    </div>
   
    <div class="bg-white border border-1 hover:border-primary border-gray-200 rounded-2xl p-6 text-left shadow-sm hover:shadow-md transition">
      <div class="flex items-center justify-center">
        <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center mb-4">
          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
          </svg>
        </div>
      </div>
      <div class="text-center">
        <h3 class="text-primary font-bold text-sm">Armada Lengkap</h3>
        <p class="text-black/75 text-xs mt-1 leading-relaxed">Berbagai pilihan kendaraan untuk semua kebutuhan perjalanan Anda</p>
      </div>
    </div>
  </div>
</section>



<section class="max-w-7xl mx-auto px-6 mt-12">
  <div class="bg-white rounded-3xl shadow-sm overflow-hidden flex flex-col md:flex-row min-h-[240px]">


    <div class="md:w-2/5 bg-primary relative flex items-end justify-center pt-6 overflow-hidden">
      <!-- Watermark -->
      <div class="absolute inset-0 flex items-center justify-center opacity-15">
        <svg width="200" height="200" viewBox="0 0 200 200">
          <polygon points="100,5 195,195 5,195" fill="none" stroke="white" stroke-width="18"/>
        </svg>
      </div>
      <img src="{{ asset('img/mobil2.png') }}" alt="Adeva Rent Car"
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

<section class="max-w-7xl mx-auto px-6 mt-14">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-extrabold text-gray-900">PILIH ARMADA ANDA<br>SEKARANG</h2>
    <a href="{{ route('armada') }}" class="text-primary text-sm font-semibold hover:underline">View All →</a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

    @php
$cars = [
  ['name' => 'Innova Reborn', 'price' => 'Rp 350.000', 'type' => 'SUV', 'seat' => 7, 'fuel' => 'Solar', 'trans' => 'Matic'],
];
    @endphp
@foreach($kendaraans as $car)
<div class="bg-white rounded-3xl shadow-sm border border-gray-50 p-6 flex flex-col w-full max-w-sm">
    <div class="mb-4 overflow-hidden rounded-lg">
        <img src="{{ asset('storage/'.$car->dir) }}" alt="{{ $car->nama_kendaraaan }}"
             class="w-full h-48 object-contain rounded-lg ">
    </div>

    <div class="flex justify-between items-start mb-1">
        <div>
            <h3 class="font-bold text-2xl text-gray-900 leading-tight">{{ $car->nama_kendaraan }}</h3>
            <p class="text-gray-400 text-sm">{{ $car->category->nama_kategori }}</p> 
        </div>
        <div class="text-right">
            <p class="text-orange-500 font-bold text-xl">Rp.{{ number_format($car->harga, 0, ',', '.') }}</p>
            <p class="text-gray-400 text-xs">per day</p>
        </div>
    </div>

    <div class="flex items-center justify-between mt-6 mb-6">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
            <span class="text-gray-500 text-sm font-medium">{{ $car->transmisi }}</span>
        </div>

        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 16V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2zM13 14H7m0-4h6m6 10v-3"></path>
            </svg>
            <span class="text-gray-500 text-sm font-medium">{{ $car->bbm }}</span>
        </div>

        {{-- <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v3m4.243.757l-2.121 2.121M21 12h-3m-6 9v-3m-8.243-4.757l2.121-2.121M3 12h3m0 6.757l2.121-2.121m7.778 0l2.121 2.121"></path>
            </svg>
            <span class="text-gray-500 text-sm font-medium">Air Conditioner</span>
        </div> --}}
    </div>

    <a href="#" class="w-full text-center bg-primary hover:bg-accent text-white font-bold py-4 rounded-2xl transition shadow-lg shadow-orange-200">
        View Details
    </a>
</div>
@endforeach

  </div>
</section>
   {{-- <span class="flex items-center gap-1">
          <svg class="w-3.5 h-3.5 text-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
          {{ $car['seat'] }} Kursi
        </span> --}}


<section class="max-w-7xl mx-auto px-6 mt-14">
  <div class="bg-primary rounded-3xl px-10 py-12 relative overflow-hidden">

    {{-- Tire track decoration kiri --}}
    <div class="absolute left-0 top-0 h-full opacity-15 pointer-events-none">
      <svg width="120" height="100%" viewBox="0 0 120 400" preserveAspectRatio="none">
        <g fill="#7c4500">
          <rect x="10" y="0" width="14" height="6" rx="2"/><rect x="10" y="18" width="14" height="6" rx="2"/>
          <rect x="10" y="36" width="14" height="6" rx="2"/><rect x="10" y="54" width="14" height="6" rx="2"/>
          <rect x="10" y="72" width="14" height="6" rx="2"/><rect x="10" y="90" width="14" height="6" rx="2"/>
          <rect x="10" y="108" width="14" height="6" rx="2"/><rect x="10" y="126" width="14" height="6" rx="2"/>
          <rect x="10" y="144" width="14" height="6" rx="2"/><rect x="10" y="162" width="14" height="6" rx="2"/>
          <rect x="10" y="180" width="14" height="6" rx="2"/><rect x="10" y="198" width="14" height="6" rx="2"/>
          <rect x="10" y="216" width="14" height="6" rx="2"/><rect x="10" y="234" width="14" height="6" rx="2"/>
          <rect x="10" y="252" width="14" height="6" rx="2"/><rect x="10" y="270" width="14" height="6" rx="2"/>
          <rect x="10" y="288" width="14" height="6" rx="2"/><rect x="10" y="306" width="14" height="6" rx="2"/>
          <rect x="10" y="324" width="14" height="6" rx="2"/><rect x="10" y="342" width="14" height="6" rx="2"/>
          <rect x="40" y="0" width="14" height="6" rx="2"/><rect x="40" y="18" width="14" height="6" rx="2"/>
          <rect x="40" y="36" width="14" height="6" rx="2"/><rect x="40" y="54" width="14" height="6" rx="2"/>
          <rect x="40" y="72" width="14" height="6" rx="2"/><rect x="40" y="90" width="14" height="6" rx="2"/>
          <rect x="40" y="108" width="14" height="6" rx="2"/><rect x="40" y="126" width="14" height="6" rx="2"/>
          <rect x="40" y="144" width="14" height="6" rx="2"/><rect x="40" y="162" width="14" height="6" rx="2"/>
          <rect x="40" y="180" width="14" height="6" rx="2"/><rect x="40" y="198" width="14" height="6" rx="2"/>
          <rect x="40" y="216" width="14" height="6" rx="2"/><rect x="40" y="234" width="14" height="6" rx="2"/>
          <rect x="40" y="252" width="14" height="6" rx="2"/><rect x="40" y="270" width="14" height="6" rx="2"/>
          <rect x="40" y="288" width="14" height="6" rx="2"/><rect x="40" y="306" width="14" height="6" rx="2"/>
          <rect x="40" y="324" width="14" height="6" rx="2"/><rect x="40" y="342" width="14" height="6" rx="2"/>
        </g>
      </svg>
    </div>

    {{-- Gambar mobil di tengah sebagai background --}}
    <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none">
      <img src="{{ asset('img/mobil2.png') }}" alt="" class="w-[60%] max-w-[500px] object-contain">
    </div>

    <div class="relative z-10 text-center mb-10">
      <h2 class="text-white text-3xl sm:text-4xl font-extrabold">Facts In Numbers</h2>
      <p class="text-white/70 text-sm mt-3 max-w-md mx-auto leading-relaxed">
        Amet cras hac orci lacus. Faucibus ipsum arcu lectus nibh sapien bibendum ullamcorper in. Diam tincidunt tincidunt erat at semper fermentum.
      </p>
    </div>

    {{-- Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 relative z-10">
      @php
        $facts = [
          [
            'num'   => '50+',
            'label' => 'Armada Tersedia',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17H3a2 2 0 01-2-2V7a2 2 0 012-2h11l5 5v5a2 2 0 01-2 2h-2M9 17a2 2 0 100 4 2 2 0 000-4zm8 0a2 2 0 100 4 2 2 0 000-4z"/>',
          ],
          [
            'num'   => '2K+',
            'label' => 'Pelanggan Puas',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>',
          ],
          [
            'num'   => '30+',
            'label' => 'Destinasi',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4"/>',
          ],
          [
            'num'   => '20+',
            'label' => 'Penghargaan',
            'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
          ],
        ];
      @endphp

      @foreach($facts as $fact)
      <div class="bg-white rounded-2xl px-5 py-4 flex flex-col md:flex-row items-center gap-4 shadow-md">
      
        <div class="shrink-0 w-11 h-11 rounded-full bg-primary/15 flex items-center justify-center">
          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $fact['icon'] !!}
          </svg>
        </div>
        <div>
          <div class="text-gray-900 text-2xl font-black leading-tight">{{ $fact['num'] }}</div>
          <div class="text-gray-500 text-xs font-medium">{{ $fact['label'] }}</div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>

<section class="max-w-7xl mx-auto px-6 mt-8">
  <div class="bg-primary rounded-3xl px-12 py-14 flex flex-col md:flex-row items-center justify-between relative overflow-hidden">

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


</x-user>
