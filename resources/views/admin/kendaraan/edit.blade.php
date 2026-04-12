<x-app-layout>
<div class="p-6">
    {{-- HEADER --}}
    <div class="flex items-center mb-6">
        <a href="{{ route('kendaraan.index') }}" class="mr-4 text-gray-500 hover:text-orange-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Kendaraan</h1>
    </div>

    @if($errors->any())
        <div class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded-lg text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm p-8">
        <form action="{{ route('kendaraan.update', $kendaraan->nopol) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- UPLOAD FOTO --}}
            <div class="flex justify-center mb-8">
                <label for="dir" class="cursor-pointer relative flex flex-col items-center justify-center w-64 h-40 bg-orange-50 border-2 border-orange-300 border-dashed rounded-2xl hover:bg-orange-100 transition overflow-hidden" id="upload-label">
                    <img id="preview-img" src="{{ asset('storage/' . $kendaraan->dir) }}" alt="Preview" class="w-full h-full object-cover absolute inset-0">
                    <div id="upload-placeholder" class="hidden flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-orange-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12V4m0 0L8 8m4-4l4 4"/>
                        </svg>
                        <span class="text-orange-400 text-sm font-semibold">Ganti foto</span>
                    </div>
                    <input type="file" id="dir" name="dir" accept="image/*" class="hidden" onchange="previewImage(event)">
                </label>
            </div>

            {{-- FORM GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Nopol</label>
                    <input type="text" name="nopol" value="{{ old('nopol', $kendaraan->nopol) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Nama Kendaraan</label>
                    <input type="text" name="nama_kendaraan" value="{{ old('nama_kendaraan', $kendaraan->nama_kendaraan) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Transmisi</label>
                    <select name="transmisi" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none bg-white">
                        <option value="Matic" {{ $kendaraan->transmisi == 'Matic' ? 'selected' : '' }}>Matic</option>
                        <option value="Manual" {{ $kendaraan->transmisi == 'Manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Harga</label>
                    <input type="number" name="harga" value="{{ old('harga', $kendaraan->harga) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Denda Keterlambatan (Rp/hari)</label>
                    <input type="number" name="denda_terlambat" value="{{ old('denda_terlambat', $kendaraan->denda_terlambat) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Warna</label>
                    <select name="warna" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none bg-white">
                        <option value="Merah" {{ old('warna', $kendaraan->warna) == 'Merah' ? 'selected' : '' }}>Merah</option>
                        <option value="Hitam" {{ old('warna', $kendaraan->warna) == 'Hitam' ? 'selected' : '' }}>Hitam</option>
                        <option value="Putih" {{ old('warna', $kendaraan->warna) == 'Putih' ? 'selected' : '' }}>Putih</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Kondisi</label>
                    <select name="kondisi" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none bg-white">
                        <option value="rusak" {{ old('kondisi', $kendaraan->kondisi) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="free" {{ old('kondisi', $kendaraan->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Bahan Bakar</label>
                    <select name="bbm" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none bg-white">
                        <option value="solar" {{ old('bbm', $kendaraan->bbm) == 'solar' ? 'selected' : '' }}>Solar</option>
                        <option value="pertalite" {{ old('bbm', $kendaraan->bbm) == 'pertalite' ? 'selected' : '' }}>Pertalite</option>
                        <option value="pertamax" {{ old('bbm', $kendaraan->bbm) == 'pertamax' ? 'selected' : '' }}>Pertamax</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                    <input type="number" name="tahun" value="{{ old('tahun', $kendaraan->tahun) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Kategori</label>
                    <select name="category_id" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none bg-white">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $kendaraan->category_id == $category->id ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Wilayah</label>
                    <select name="cabang_id" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none bg-white">
                        @foreach($cabangs as $cabang)
                            <option value="{{ $cabang->id }}" {{ old('cabang_id', $kendaraan->cabang_id) == $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs text-gray-500 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none resize-none">{{ old('deskripsi', $kendaraan->deskripsi) }}</textarea>
                </div>
            </div>

            <div class="flex justify-center mt-8 gap-4">
                <button type="submit" class="bg-orange-400 hover:bg-orange-500 text-white font-bold text-sm px-20 py-3 rounded-xl transition">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview-img');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
</x-app-layout>