<x-superadmin>
    {{-- Tombol buka drawer --}}
    <button onclick="document.getElementById('drawer').classList.remove('translate-x-full')"
        class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-4 py-2 rounded-lg">
        + Tambah Pengguna
    </button>
    
    {{-- Overlay --}}
    <div id="overlay" onclick="closeDrawer()" class="fixed inset-0 bg-black/30 z-10 hidden"></div>
    
    {{-- Drawer --}}
    <div id="drawer" class="fixed top-0 right-0 h-full w-80 bg-white shadow-xl z-20 
             transform translate-x-full transition-transform duration-300 p-6 flex flex-col gap-4">
    
        <div class="flex justify-between items-center">
            <h2 class="text-base font-medium">Tambah Pengguna</h2>
            <button onclick="closeDrawer()" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <hr class="border-gray-100">
    
        <form method="POST" action="{{ route('admin.store') }}" class="flex flex-col gap-4 flex-1">
            @csrf
            <div class="flex flex-col gap-1">
                <label class="text-xs text-gray-500 font-medium">NAMA LENGKAP</label>
                <input type="text" name="nama" class="border border-gray-200 rounded-lg px-3 py-2 text-sm">
            </div>
            {{-- ...field lainnya... --}}
            <button type="submit" class="mt-auto bg-orange-500 text-white rounded-lg py-2 text-sm font-medium">
                Simpan
            </button>
        </form>
    </div>
</x-superadmin>