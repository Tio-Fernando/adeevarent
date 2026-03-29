<aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between h-full">
    <div>
        <div class="h-20 flex items-center justify-center border-b border-gray-50">
          <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="pt-4">
        </div>

        <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('dashboard') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <span class="font-medium text-sm">Dashboard</span>
                </a>
           
                <a href="{{ route('kendaraan.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('kendaraan.index') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <span class="font-medium text-sm">Kendaraan</span>
                </a>
           
             <a href="{{ route('wilayah.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('wilayah.index') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <span class="font-medium text-sm">Wilayah</span>
                </a>
          <a href="{{ route('kategori.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-colors
                {{ request()->routeIs('kategori.index') ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    <span class="font-medium text-sm">Kategori Mobil</span>
                </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-primary rounded-lg transition-colors">
                <span class="font-medium text-sm">Booking</span>
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-primary rounded-lg transition-colors">
                <span class="font-medium text-sm">Laporan</span>
            </a>
       
        </nav>
    </div>

    <div class="p-4 border-t border-gray-100 space-y-2">
        <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:text-gray-900 transition-colors">
            <span class="font-medium text-sm">Settings</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center px-4 py-2 text-gray-600 hover:text-red-500 transition-colors">
                <span class="font-medium text-sm">Logout</span>
            </a>
        </form>
    </div>
</aside>