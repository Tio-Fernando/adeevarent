<x-app-layout>
    <div class="p-6">
        {{-- HEADER --}}
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Kendaraan</h1>

        <div class="flex justify-end mb-3">
            <a href="{{ route('kendaraan.create') }}"
               class="bg-primary hover:bg-accent text-white text-sm font-semibold px-5 py-2 rounded-full transition">
                Tambah Mobil
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($kendaraans as $item)

                <div class="bg-white p-6 border border-default rounded-lg shadow-xs flex flex-col h-full">
                    <a href="#">
                        <img class="rounded-lg w-full h-48 object-cover" 
                             src="{{ asset('storage/'.$item->dir) }}" 
                             alt="{{ $item->nama_kendaraan }}" />
                    </a>
                    
                    <a href="#">
                        <h5 class="mt-4 mb-2 text-2xl font-semibold tracking-tight text-heading">
                            {{ $item->nama_kendaraan }}
                        </h5>
                    </a>
                    
                    <p class="mb-6 text-body flex-grow italic text-sm text-gray-500">
                        {{ Str::limit($item->deskripsi, 100) }}
                    </p>
                    
                    <div class="mt-auto">
                        <a href="{{ route('kendaraan.show', $item->nopol) }}" class="inline-flex items-center text-body bg-neutral-secondary-medium border border-default-medium hover:bg-neutral-tertiary-medium px-4 py-2.5 rounded-base text-sm font-medium">
                            Detail Mobil
                            <svg class="w-4 h-4 ms-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 py-10 text-center text-gray-400 text-sm italic">
                    Belum ada data kendaraan.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>