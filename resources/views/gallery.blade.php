<x-user>
    {{-- Section Galeri --}}
    <div class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            
            {{-- Judul --}}
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl  font-extrabold text-gray-900">Galery</h1>
            </div>

            {{-- Grid Galeri --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class=" rounded-[2rem] shadow-sm border border-gray-100/50 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                    <div class="overflow-hidden rounded-2xl h-[400px]">
                        <img src="{{ asset('img/galery1.png') }}" alt="Galery Adeva 1" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                </div>

                <div class=" rounded-[2rem] shadow-sm border border-gray-100/50 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                    <div class="overflow-hidden rounded-2xl h-[400px]">
                        <img src="{{ asset('img/galery2.png') }}" alt="Galery Adeva 2" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                </div>

                <div class=" rounded-[2rem] shadow-sm border border-gray-100/50 hover:shadow-lg transition-all duration-300 group cursor-pointer">
                    <div class="overflow-hidden rounded-2xl h-[400px]">
                        <img src="{{ asset('img/galery3.png') }}" alt="Galery Adeva 3" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user>