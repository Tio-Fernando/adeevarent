<x-user>
  

 <div class="py-8" x-data="{ 
    activeCategory: 'all', 
    activeCabang: '{{ request('lokasi', 'all') }}' 
}">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Find the Best Car for a Comfortable Trip</h1>
        </div>

        <div class="flex justify-center mb-4 ">
        <form action="{{ route('armada') }}" method="GET" class="flex items-center bg-white p-1.5 rounded-full shadow-lg border border-gray-100 max-w-2xl mx-auto w-full">
    
    <!-- Bagian Select (Kiri) -->
    <div class="relative flex-grow">
        <select name="lokasi" class="w-full bg-transparent border-none text-gray-500 font-medium focus:ring-0 appearance-none pl-6 pr-10 py-3 cursor-pointer outline-none">
            
            <option value="">All locations</option>
        
            @foreach($cabangs as $cab)
                <option value="{{ $cab->lokasi }}" {{ request('lokasi') == $cab->lokasi ? 'selected' : '' }}>
                    {{ $cab->lokasi }}
                </option>
            @endforeach
            
        </select>
        
        <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-400">
        </div>
    </div>
    <button type="submit" class="bg-primary hover:bg-orange-600 text-white font-bold py-3 px-8 sm:px-10 rounded-full transition-colors flex-shrink-0 shadow-md">
       Search
    </button>

</form>
        </div>
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button 
                @click="activeCategory = 'all'"
                :class="activeCategory === 'all' ? 'bg-primary text-white' : 'bg-white text-gray-700 border'"
                class="px-4 py-2 rounded-full shadow-md">All vehicles
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

                {{-- Contoh Looping Data dari Database nantinya: --}}
                @foreach($kendaraans as $mobil)
                <div
                 x-show="(activeCategory === 'all' || activeCategory === '{{ $mobil->category->nama_kategori }}') 
            && (activeCabang === 'all' || activeCabang === '{{ $mobil->cabang->lokasi }}')"
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
                            <div class="text-right">
                                <p class="text-primary font-bold text-lg">Rp {{ number_format($mobil->harga) }}</p>
                                <p class="text-xs text-gray-400">per day</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 mb-6">
                            <div class="flex items-center gap-2"><i class="fas fa-gas-pump text-gray-400"></i> {{ $mobil->bbm }}
                            </div>
                            <div class="flex items-center gap-2"><i class="fas fa-calendar-alt text-gray-400"></i> {{ $mobil->tahun }}
                            </div>
                            <div class="flex items-center gap-1 mt-2 text-xs text-gray-500">
        <i class="fas fa-map-marker-alt text-orange-500"></i>
        <span>{{ $mobil->cabang->lokasi }}</span>
    </div>
                            <div class="flex items-center gap-2"><i class="fas fa-cogs text-gray-400"></i> CVT</div>
                        </div>
                        <div class="flex justify-between">
                            <a href="{{ Auth::check() ? route('detail',$mobil->nopol) : route('login') }}"
                            class="px-4 bg-primary text-white py-2.5 rounded-xl font-semibold hover:bg-accent transition-colors">
                            Booking 
                            </a>
                                @if($mobil->status == 'free')
                        <span class="bg-green-200 text-green-700 text-xs font-bold px-3 py-3 rounded-md uppercase">FREE</span>
                    @else
                        <span class="bg-red-200 text-red-700 text-xs font-bold px-3 py-3 rounded-md uppercase">{{ $mobil->status }}</span>
                    @endif
                        </div>
                    </div>
                </div>


                @endforeach

            </div>
        </div>
    </div>
</x-user>