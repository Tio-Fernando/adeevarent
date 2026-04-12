<x-app-layout>
<div class="p-6">

    {{-- HEADER --}}
    <div class="flex items-center mb-6">
        <a href="{{ route('kendaraan.index') }}" class="mr-4 text-gray-500 hover:text-orange-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Data Kendaraan</h1>
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
        <form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- UPLOAD FOTO --}}
            <div class="flex justify-center mb-8">
                <label for="dir"
                       class="cursor-pointer flex flex-col items-center justify-center w-64 h-40 bg-orange-50 border-2 border-orange-300 border-dashed rounded-2xl hover:bg-orange-100 transition"
                       id="upload-label">
                    <svg id="upload-icon" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-orange-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12V4m0 0L8 8m4-4l4 4"/>
                    </svg>
                    <span id="upload-text" class="text-orange-400 text-sm font-semibold">Upload foto</span>
                    <img id="preview-img" src="#" alt="Preview" class="hidden w-full h-full object-cover rounded-2xl absolute inset-0">
                    <input type="file" id="dir" name="dir" accept="image/*" class="hidden" onchange="previewImage(event)">
                </label>
            </div>

            {{-- FORM GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Nopol</label>
                    <input type="text" name="nopol" value="{{ old('nopol') }}"
                           placeholder="Contoh: AB 1234 CD"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300">
                </div>

          
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Nama Kendaraan</label>
                    <input type="text" name="nama_kendaraan" value="{{ old('nama_kendaraan') }}"
                           placeholder="Contoh: Avanza"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300">
                </div>

            
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Transmisi</label>
                     <select name="transmisi" id="transmisi" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300 bg-white">
                         <option value="" disabled selected>Selected Option</option>
                          <option value="Matic">Matic</option>
                          <option value="Manual">Manual</option>
                     </select>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Harga</label>
                    <input type="number" name="harga" value="{{ old('harga') }}"
                           placeholder="Contoh: 100000"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300">
                </div>

                {{-- Denda Keterlambatan --}}
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Denda Keterlambatan (Rp/hari)</label>
                    <input type="number" name="denda_terlambat" value="{{ old('denda_terlambat') }}"
                           placeholder="Contoh: 50000"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300">
                </div>

                {{-- Warna --}}
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Warna</label>
             <select name="warna" id="warna" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300 bg-white">
                 <option value="" disabled selected>Selected Option</option>
                 <option value="Merah">Merah</option>
                 <option value="Hitam">Hitam</option>
                 <option value="Putih">Putih</option>
             </select>
                </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Kondisi</label>
                         <select name="kondisi" id="kondisi" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300 bg-white">
                             <option value="" disabled selected>Selected Option</option>
                            <option value="rusak">Rusak</option>
                            <option value="baik">Baik</option>
                         </select>
                </div>

          
                  <div>
                    <label class="block text-xs text-gray-500 mb-1">Bahan Bakar</label>
                   <select name="bbm" id="bbm" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300 bg-white">
                    <option value="" disabled selected>Selected Option</option>
                    <option value="solar">Solar</option>
                    <option value="pertalite">Pertalite</option>
                    <option value="pertamax">Pertamax</option>
                   </select>
                </div>

                {{-- Tahun --}}
                <div>
                    <label class="block text-xs text-gray-500 mb-1">Tahun</label>
                    <input type="number" name="tahun" value="{{ old('tahun') }}"
                           placeholder="Contoh: 2021"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300">
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Kategori</label>
                    <select name="category_id"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300 bg-white">
                        <option value="" disabled selected>Selected Option</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs text-gray-500 mb-1">Wilayah</label>
                    <select name="cabang_id"
                            class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300 bg-white">
                        <option value="" disabled selected>Selected Option</option>
                        @foreach($cabangs as $cabang)
                            <option value="{{ $cabang->id }}" {{ old('cabang_id') == $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->lokasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-1 md:col-start-2 row-span-2">
                    <label class="block text-xs text-gray-500 mb-1">Description</label>
                    <textarea name="deskripsi" rows="4"
                              placeholder="Tulis deskripsi kendaraan..."
                              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-300 resize-none">{{ old('deskripsi') }}</textarea>
                </div>

            </div>

            {{-- SAVE BUTTON --}}
            <div class="flex justify-center mt-8">
                <button type="submit"
                        class="bg-orange-400 hover:bg-orange-500 text-white font-bold text-sm px-20 py-3 rounded-xl transition">
                    Save
                </button>
            </div>

        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const label = document.getElementById('upload-label');
        const icon  = document.getElementById('upload-icon');
        const text  = document.getElementById('upload-text');
        const img   = document.getElementById('preview-img');

        label.classList.add('relative', 'overflow-hidden', 'p-0');
        icon.classList.add('hidden');
        text.classList.add('hidden');
        img.src = e.target.result;
        img.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}
</script>
</x-app-layout>