<x-user>
 <div class="py-8" x-data="{ 
    activeCategory: 'all', 
    activeCabang: '{{ request('lokasi', 'all') }}',
    activeMobil: 'all' 
}">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Temukan Armada Terbaik untuk Perjalanan yang Berkesan</h1>
        </div>

        <div class="flex justify-center mb-4 ">
            <div class="flex items-center bg-white p-1.5 rounded-full shadow-lg border border-gray-100 max-w-3xl mx-auto w-full">
        
                <div class="relative flex-grow border-r border-gray-200">
                    <select x-model="activeCabang" class="w-full bg-transparent border-none text-gray-500 font-medium focus:ring-0 appearance-none pl-6 pr-10 py-3 cursor-pointer outline-none">
                        <option value="all">Semua Lokasi</option>
                        @foreach($cabangs as $cab)
                            <option value="{{ $cab->lokasi }}" {{ request('lokasi') == $cab->lokasi ? 'selected' : '' }}>
                                {{ $cab->lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="relative flex-grow">
                    <select x-model="activeMobil" class="w-full bg-transparent border-none text-gray-500 font-medium focus:ring-0 appearance-none pl-6 pr-10 py-3 cursor-pointer outline-none">
                        <option value="all">Semua Mobil</option>
                        @php
                            $uniqueCars = $kendaraans->unique('nama_kendaraan');
                        @endphp
                        @foreach($uniqueCars as $carOpt)
                            <option value="{{ $carOpt->nama_kendaraan }}">{{ $carOpt->nama_kendaraan }}</option>
                        @endforeach
                    </select>
                </div>

                <button @click="activeCabang = 'all'; activeMobil = 'all'; activeCategory = 'all'" type="button" class="bg-primary hover:bg-orange-600 text-white font-bold py-3 px-8 sm:px-10 rounded-full transition-colors flex-shrink-0 shadow-md">
                   Reset Filter
                </button>

            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button 
                @click="activeCategory = 'all'"
                :class="activeCategory === 'all' ? 'bg-primary text-white shadow-md' : 'bg-white text-gray-700 border'"
                class="px-4 py-2 rounded-full shadow-md ">Semua Kendaraan
            </button>
            @foreach ($categories as $item)
                <button
                    @click="activeCategory = '{{ $item->nama_kategori }}'"
                    :class="activeCategory === '{{ $item->nama_kategori }}' ? 'bg-primary text-white shadow-md' : 'bg-white text-gray-700 border'"
                    class="px-6 py-2 rounded-full shadow-sm hover:bg-accent hover:text-white transition flex items-center gap-2">
                    {{ $item->nama_kategori }}
                </button>
            @endforeach
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                {{-- Looping Data dari Database: --}}
                @foreach($kendaraans as $mobil)
                <div
                 x-show="(activeCategory === 'all' || activeCategory === '{{ $mobil->category->nama_kategori }}') 
            && (activeCabang === 'all' || activeCabang === '{{ $mobil->cabang->lokasi }}')
            && (activeMobil === 'all' || activeMobil === '{{ $mobil->nama_kendaraan }}')"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"

                    class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 p-6 flex flex-col items-center border border-gray-100">
                    <img src="{{ asset('storage/'.$mobil->dir) }}" alt="Innova Reborn"
                        class="w-full h-48 object-contain mb-4">
                    <div class="w-full">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $mobil->nama_kendaraan }}</h3>
                                <p class="text-sm text-gray-400">{{ $mobil->category->nama_kategori }}</p>
                            </div>
                            <div class="text-end">
                                <p class="text-primary font-bold text-lg">Rp {{ number_format($mobil->harga) }}</p>
                                <p class="text-xs text-gray-400">per hari</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 mb-6">
                            <div class="flex items-center gap-2"><i class="fas fa-gas-pump text-gray-400"></i> {{ $mobil->bbm }}
                            </div>
                            <div class="flex items-center gap-2 justify-end"><i class="fas fa-calendar-alt text-gray-400"></i> {{ $mobil->tahun }}
                            </div>
                            <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
                            <i class="fas fa-map-marker-alt text-orange-500"></i>
                            <span>{{ $mobil->cabang->lokasi }}</span>
                        </div>
                            <div class="flex items-center gap-2 justify-end"><i class="fas fa-users text-gray-400"></i> {{ $mobil->jumlah_kursi ?? '-' }} Kursi</div>
                        </div>
                        <div class="flex justify-between">
                         <a href="{{ $mobil->status == 'Free' 
                                ? (Auth::check() ? route('detail',$mobil->nopol) : route('login')) 
                                : '#' }}"
                                
                        class="px-4 py-2.5 rounded-xl font-semibold transition-colors
                        {{ $mobil->status == 'Free' 
                                ? 'bg-primary text-white hover:bg-accent' 
                                : 'bg-gray-400 text-white cursor-not-allowed opacity-70' }}"
                        {{ $mobil->status != 'Free' ? 'onclick=return false;' : '' }}>
                            
                                {{ $mobil->status == 'Free' ? 'Booking' : 'Tidak Tersedia' }}
                        </a>
                                @if($mobil->status == 'Free')
                        <span class="bg-green-200 text-green-700 text-xs font-bold px-3 py-3 rounded-md uppercase">Available</span>
                    @else
                        @if ($mobil->status == 'Booking')
                        
                        <span class="bg-red-200 text-red-700 text-xs font-bold px-3 py-3 rounded-md uppercase">Booked</span>
                        @endif
                    @endif
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</x-user>