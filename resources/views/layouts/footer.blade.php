<footer class="bg-[#1a1f2c] text-gray-400 pt-16 pb-8">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

      <div>
        <div class="flex items-center gap-2 mb-6">
          <img src="{{ asset('img/Logo.png') }}" alt="Logo Adeva" class="h-10">
          {{-- Jika logo sudah ada teksnya, span di bawah bisa dihapus --}}
          <span class="text-white font-extrabold text-lg">Adeva Rent</span>
        </div>
        <p class="text-xs leading-relaxed mb-6">
          Adeva Rent menyediakan layanan rental mobil dengan berbagai pilihan kendaraan yang siap digunakan untuk
          perjalanan Anda. Kami mengutamakan kenyamanan, keamanan, dan pelayanan terbaik.
        </p>
        <div class="flex gap-3">
          <a href="#"
            class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition">
            <i class="fab fa-facebook-f text-xs"></i>
          </a>
          <a href="#"
            class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition">
            <i class="fab fa-instagram text-xs"></i>
          </a>
          <a href="#"
            class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition">
            <i class="fab fa-twitter text-xs"></i>
          </a>
          <a href="#"
            class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center hover:bg-orange-500 hover:text-white transition">
            <i class="fab fa-youtube text-xs"></i>
          </a>
        </div>
      </div>

      <div class="space-y-6">
        <div class="flex items-start gap-4">
          <div class="w-10 h-10 bg-orange-500 rounded-full flex-shrink-0 flex items-center justify-center text-white">
            <i class="fas fa-location-dot"></i>
          </div>
          <div>
            <h4 class="text-white font-bold text-sm mb-1">Alamat</h4>
            <p class="text-xs leading-relaxed">Klagen Gambiran, Sanggrahan, Magetan, Jawa Timur</p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-10 h-10 bg-orange-500 rounded-full flex-shrink-0 flex items-center justify-center text-white">
            <i class="fas fa-envelope"></i>
          </div>
          <div>
            <h4 class="text-white font-bold text-sm mb-1">Email</h4>
            <p class="text-xs leading-relaxed text-orange-500">nwiger@yahoo.com</p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-10 h-10 bg-orange-500 rounded-full flex-shrink-0 flex items-center justify-center text-white">
            <i class="fas fa-phone"></i>
          </div>
          <div>
            <h4 class="text-white font-bold text-sm mb-1">Phone</h4>
            <p class="text-xs leading-relaxed">+537 547-6401</p>
          </div>
        </div>
      </div>

      <div>
        <h4 class="text-white font-bold text-sm mb-6">Layanan Kami</h4>
        <ul class="space-y-3 text-xs">
          <li><a href="#" class="hover:text-orange-500 transition">Sewa Harian</a></li>
          <li><a href="#" class="hover:text-orange-500 transition">Sewa Mingguan</a></li>
          <li><a href="#" class="hover:text-orange-500 transition">Sewa Bulanan</a></li>
          <li><a href="#" class="hover:text-orange-500 transition">Antar Jemput</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-bold text-sm mb-6">Links</h4>
        <ul class="space-y-3 text-xs">
          <li><a href="{{ route('home') }}" class="hover:text-orange-500 transition">Beranda</a></li>
          <li><a href="{{ route('profileCompany') }}" class="hover:text-orange-500 transition">Profile</a></li>
          <li><a href="{{ route('armada') }}" class="hover:text-orange-500 transition">Armada</a></li>
          <li><a href="{{ route('fasilitas') }}" class="hover:text-orange-500 transition">Layanan</a></li>
          <li><a href="{{ route('gallery') }}" class="hover:text-orange-500 transition">Galeri</a></li>
        </ul>
      </div>

    </div>

    <div class="border-t border-gray-800 mt-16 pt-8 text-center text-[10px] tracking-wider uppercase">
      © Copyright Car Rental {{ date('Y') }}. Design by Figma Guru
    </div>
  </div>
</footer>