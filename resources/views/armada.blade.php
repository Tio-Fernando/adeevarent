<x-app-layout>
    {{-- Karena di layout app.blade.php sudah ada header dan sidebar,
    kita tidak perlu memasukkan navbar public lagi di sini. --}}

    <div class="py-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Cari Mobil Terbaik untuk Perjalanan Nyaman</h1>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="bg-orange-500 text-white px-6 py-2 rounded-full shadow-md">All vehicles</button>
            <button
                class="bg-white text-gray-700 px-6 py-2 rounded-full shadow-sm border hover:bg-gray-100 transition flex items-center gap-2">
                <i class="fas fa-car-side"></i> Sedan
            </button>
            <button
                class="bg-white text-gray-700 px-6 py-2 rounded-full shadow-sm border hover:bg-gray-100 transition flex items-center gap-2">
                <i class="fas fa-car"></i> Cabriolet
            </button>
            <button
                class="bg-white text-gray-700 px-6 py-2 rounded-full shadow-sm border hover:bg-gray-100 transition flex items-center gap-2">
                <i class="fas fa-truck-pickup"></i> Pickup
            </button>
            <button
                class="bg-white text-gray-700 px-6 py-2 rounded-full shadow-sm border hover:bg-gray-100 transition flex items-center gap-2">
                <i class="fas fa-shuttle-van"></i> Suv
            </button>
            <button
                class="bg-white text-gray-700 px-6 py-2 rounded-full shadow-sm border hover:bg-gray-100 transition flex items-center gap-2">
                <i class="fas fa-bus"></i> Minivan
            </button>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                {{-- Contoh Looping Data dari Database nantinya: --}}
                {{-- @foreach($armadas as $mobil) --}}

                <div
                    class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 p-6 flex flex-col items-center border border-gray-100">
                    <img src="{{ asset('images/innova.png') }}" alt="Innova Reborn"
                        class="w-full h-48 object-contain mb-4">
                    <div class="w-full">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Innova Reborn</h3>
                                <p class="text-sm text-gray-400">Sedan</p>
                            </div>
                            <div class="text-right">
                                <p class="text-orange-500 font-bold text-lg">Rp. 300.000</p>
                                <p class="text-xs text-gray-400">per day</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 mb-6">
                            <div class="flex items-center gap-2"><i class="fas fa-gas-pump text-gray-400"></i> Bensin
                            </div>
                            <div class="flex items-center gap-2"><i class="fas fa-calendar-alt text-gray-400"></i> 2024
                            </div>
                            <div class="flex items-center gap-2"><i class="fas fa-cogs text-gray-400"></i> CVT</div>
                        </div>
                        <button
                            class="w-full bg-orange-500 text-white py-2.5 rounded-xl font-semibold hover:bg-orange-600 transition-colors">View
                            Details</button>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 p-6 flex flex-col items-center border border-gray-100">
                    <img src="{{ asset('images/avanza.png') }}" alt="Avanza Veloz"
                        class="w-full h-48 object-contain mb-4">
                    <div class="w-full">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Avanza Veloz</h3>
                                <p class="text-sm text-gray-400">Sport</p>
                            </div>
                            <div class="text-right">
                                <p class="text-orange-500 font-bold text-lg">Rp. 300.000</p>
                                <p class="text-xs text-gray-400">per day</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 mb-6">
                            <div class="flex items-center gap-2"><i class="fas fa-gas-pump text-gray-400"></i> Bensin
                            </div>
                            <div class="flex items-center gap-2"><i class="fas fa-calendar-alt text-gray-400"></i> 2024
                            </div>
                            <div class="flex items-center gap-2"><i class="fas fa-cogs text-gray-400"></i> CVT</div>
                        </div>
                        <button
                            class="w-full bg-orange-500 text-white py-2.5 rounded-xl font-semibold hover:bg-orange-600 transition-colors">View
                            Details</button>
                    </div>
                </div>

                {{-- @endforeach --}}

            </div>
        </div>
    </div>
</x-app-layout>