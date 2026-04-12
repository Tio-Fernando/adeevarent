<x-app-layout>
<div class="p-6">
    {{-- HEADER --}}
    <div class="flex items-center mb-6">
        <a href="{{ route('kendaraan.index') }}" class="mr-4 text-gray-500 hover:text-orange-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Kendaraan</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-8">
        {{-- TAMPILAN FOTO --}}
        <div class="flex justify-center mb-8">
            <div class="w-80 h-48 bg-gray-100 rounded-2xl overflow-hidden shadow-md">
                <img src="{{ asset('storage/' . $kendaraan->dir) }}" alt="{{ $kendaraan->nama_kendaraan }}" class="w-full h-full object-cover">
            </div>
        </div>

      
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            
            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Nomor Polisi (Nopol)</label>
                <p class="text-lg font-semibold text-gray-800">{{ $kendaraan->nopol }}</p>
            </div>

            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Nama Kendaraan</label>
                <p class="text-lg font-semibold text-gray-800">{{ $kendaraan->nama_kendaraan }}</p>
            </div>
            
            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Transmisi</label>
                <p class="text-lg font-semibold text-gray-800">{{ $kendaraan->transmisi }}</p>
            </div>

            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Harga Sewa / Hari</label>
                <p class="text-lg font-semibold text-orange-500">Rp {{ number_format($kendaraan->harga, 0, ',', '.') }}</p>
            </div>
            
            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Denda Keterlambatan / Hari</label>
                <p class="text-lg font-semibold text-red-500">Rp {{ number_format($kendaraan->denda_terlambat, 0, ',', '.') }}</p>
            </div>
            
            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Warna</label>
                <p class="text-lg font-semibold text-gray-800">{{ $kendaraan->warna }}</p>
            </div>

            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Kondisi</label>
            
                <span class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $kendaraan->kondisi == 'free' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}
                            ">
                    {{ strtoupper($kendaraan->kondisi ?? '-') }}
                </span>
            </div>

            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Bahan Bakar</label>
                <p class="text-lg font-semibold text-gray-800">{{ ucfirst($kendaraan->bbm) }}</p>
            </div>
            
            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Tahun</label>
                <p class="text-lg font-semibold text-gray-800">{{ $kendaraan->tahun }}</p>
            </div>

            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Kategori</label>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $kendaraan->category->nama_kategori ?? '-' }}
                </p>
            </div>

            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Wilayah</label>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $kendaraan->cabang->lokasi ?? '-' }}
                </p>
            </div>

            <div class="border-b border-gray-100 pb-2">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-1">Status</label>
                <span
                    class="px-3 py-1 rounded-full text-xs font-bold {{ $kendaraan->status == 'free' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                    {{ strtoupper($kendaraan->status) }}
                </span>
            </div>

            <div class="md:col-span-2 bg-gray-50 p-4 rounded-xl">
                <label class="block text-xs text-gray-400 uppercase font-bold mb-2">Deskripsi Kendaraan</label>
                <p class="text-sm text-gray-600 leading-relaxed">{{ $kendaraan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>

        <div class="flex justify-end gap-4 mt-10">
            <a href="{{  route('kendaraan.edit', $kendaraan->nopol) }}" class="bg-primary hover:bg-orange-500 text-white font-bold py-3 px-10 rounded-xl transition ">
                Edit Data
            </a>
        </div>
    </div>
</div>
</x-app-layout>