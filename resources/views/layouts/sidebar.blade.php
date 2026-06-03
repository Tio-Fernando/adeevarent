<aside class="w-64 bg-[#1a1f2c] border-r border-gray-100 flex flex-col justify-between h-full">
    <div>
        <div class="h-20 flex items-center justify-center ">
          <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="pt-4">
        </div>

        <nav class="mt-6 px-4 space-y-2">
            @if(auth()->user()->level == 'SuperAdmin')
                {{-- SuperAdmin Menu --}}
                <a href="{{ route('superadmin.dashboard') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('superadmin.dashboard') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Dashboard</span>
                </a>

                <a href="{{ route('admin.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('admin.index') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Admin</span>
                </a>

                <a href="{{ route('laporan.super') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('laporan.super') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Laporan</span>
                </a>
            @elseif(auth()->user()->level == 'Administrator')
                {{-- Administrator Menu --}}
                <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('dashboard') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Dashboard</span>
                </a>
           
                <a href="{{ route('kendaraan.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('kendaraan.index') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Kendaraan</span>
                </a>
           
                <a href="{{ route('wilayah.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('wilayah.index') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Wilayah</span>
                </a>

                <a href="{{ route('kategori.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('kategori.index') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Kategori Mobil</span>
                </a>

                <a href="{{ route('booking.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('booking.index') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Booking</span>
                </a>
         
                <a href="{{ route('laporan.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('laporan.index') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Laporan</span>
                </a>

                <a href="{{ route('admin.pengguna.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('admin.pengguna.index') ? 'bg-primary text-white shadow-sm' : 'text-white hover:text-primary' }}">
                    <span class="font-medium text-sm">Pengguna</span>
                </a>
            @endif
        </nav>
    </div>
</aside>