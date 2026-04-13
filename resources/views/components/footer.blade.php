<footer class="bg-gray-900 text-gray-400 mt-14 pt-14 pb-8">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

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
        <h4 class="text-white font-bold text-sm mb-4">Our Services</h4>
        <ul class="space-y-2 text-xs">
          <li><a href="#" class="hover:text-primary transition">Sewa Harian</a></li>
          <li><a href="#" class="hover:text-primary transition">Sewa Mingguan</a></li>
          <li><a href="#" class="hover:text-primary transition">Sewa Bulanan</a></li>
          <li><a href="#" class="hover:text-primary transition">Antar Jemput</a></li>
        </ul>
      </div>

      <!-- Tautan -->
      <div>
        <h4 class="text-white font-bold text-sm mb-4">Links</h4>
        <ul class="space-y-2 text-xs">
          <li><a href="{{ route('home') }}" class="hover:text-primary transition">Home</a></li>
          <li><a href="{{ route('profileCompany') }}" class="hover:text-primary transition">Profile</a></li>
          <li><a href="{{ route('armada') }}" class="hover:text-primary transition">Vehicles</a></li>
          <li><a href="{{ route('fasilitas') }}" class="hover:text-primary transition">Services</a></li>
          <li><a href="{{ route('gallery') }}" class="hover:text-primary transition">Gallery</a></li>
        </ul>
      </div>

      <!-- Download App -->
      

    </div>

    <div class="border-t border-gray-800 mt-10 pt-6 text-center text-xs">
      © {{ date('Y') }} Adeva Rent. All rights reserved.
    </div>
  </div>
</footer>