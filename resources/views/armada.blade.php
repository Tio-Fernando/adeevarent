<x-user>
    {{-- Karena di layout app.blade.php sudah ada header dan sidebar,
    kita tidak perlu memasukkan navbar public lagi di sini. --}}

    <div class="py-8" x-data="{ activeCategory: 'all'}">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Cari Mobil Terbaik untuk Perjalanan Nyaman</h1>
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
                    x-show="activeCategory === 'all' || activeCategory === '{{ $mobil->category->nama_kategori }}'"
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
                            <div class="flex items-center gap-2"><i class="fas fa-cogs text-gray-400"></i> CVT</div>
                        </div>
                    <a href="{{ Auth::check() ? route('detail',$mobil->nopol) : route('login') }}"
                    class="px-4 bg-primary text-white py-2.5 rounded-xl font-semibold hover:bg-accent transition-colors">
                    View Details
                    </a>
                    </div>
                </div>


                @endforeach

            </div>
        </div>
    </div>
</x-user>