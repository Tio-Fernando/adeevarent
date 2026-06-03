<x-app-layout>
<div class="p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h1>
        <a href="{{ route('admin.pengguna.create') }}"
        class="bg-orange-500 hover:bg-orange-600 active:scale-95 transition text-white text-sm font-medium px-4 py-2 rounded-lg">
            + Tambah Pengguna
        </a>
    </div>

    <div class="flex items-center justify-between gap-4 mb-6">
        <form method="GET" action="{{ route('admin.pengguna.index') }}" class="relative w-full sm:w-80 md:w-96 flex gap-2 items-center">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                    </path>
                </svg>
            </span>

            <input 
                type="text"
                name="search"
                placeholder="Cari Nama, Email atau No.HP..."
                value="{{ $search ?? '' }}"
                class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-full focus:ring-orange-500 focus:border-orange-500 pl-10 p-2.5 outline-none sm:text-sm"
            >
            
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary hover:bg-accent text-white rounded-full text-sm font-semibold transition whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>

            @if($search)
                <a href="{{ route('admin.pengguna.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-200 hover:bg-gray-300 rounded-full text-sm font-semibold text-gray-700 whitespace-nowrap">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase text-center">Nama Pengguna</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase text-center">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase text-center">Nomor HP</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase text-center">Alamat</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase text-center">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="w-10 h-10 rounded-full border-2 border-orange-100" 
                                        src="https://ui-avatars.com/api/?name={{ urlencode($user->pelanggan ? $user->pelanggan->nama_pelanggan : $user->nama) }}&background=FF9E0C&color=fff" 
                                        alt="{{ $user->nama }}">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $user->pelanggan ? $user->pelanggan->nama_pelanggan : $user->nama }}</p>
                                        <p class="text-xs text-gray-500">Terdaftar {{ $user->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700">{{ $user->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700 font-medium">{{ $user->pelanggan ? $user->pelanggan->no_hp : '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">
                                    {{ $user->pelanggan ? Str::limit($user->pelanggan->alamat, 40) : '-' }}
                                </p>
                            </td>
                                   <td class="py-3 px-4">
                                    @if ($user->status === 1)
                                        <span
                                            class="inline-flex items-center gap-1 bg-green-50 text-green-600 text-xs font-medium px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 bg-red-50 text-red-500 text-xs font-medium px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 bg-red-400 rounded-full"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openDetailModal({{ $user->id_user }})" 
                                        class="inline-flex items-center gap-1 border-2 border-gray-300 hover:border-orange-400 text-gray-700 hover:text-orange-400 font-semibold text-sm px-4 py-2 rounded-lg transition-all">
                                    Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <p class="text-sm">Belum ada pengguna terdaftar</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4 flex items-center justify-between">
            <p class="text-sm text-gray-500 mt-2">
                Menampilkan {{ $users->count() }} dari {{ $users->total() }} pengguna
            </p>
            {{ $users->links() }}
    </div>
</div>

<div id="modalDetail" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-fade-in flex flex-col overflow-hidden">
        
        <div class="bg-primary px-8 py-6 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Detail Pengguna
            </h2>
            <button onclick="closeDetailModal()" class="text-white  rounded-lg p-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-8 space-y-5">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Nama Pengguna</label>
                <p class="text-lg font-semibold text-gray-800" id="detailNama">-</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Email</label>
                <p class="text-sm text-gray-700" id="detailEmail">-</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Nomor HP</label>
                <p class="text-sm font-medium text-gray-800" id="detailPhone">-</p>
            </div>

            <div class="bg-primary/20 border border-primary p-4 rounded-lg">
                <label class="block text-xs text-primary uppercase font-bold mb-2">Alamat Lengkap</label>
                <p class="text-sm text-gray-700 leading-relaxed" id="detailAlamat">-</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Terdaftar</label>
                <p class="text-sm font-medium text-gray-700" id="detailCreatedAt">-</p>
            </div>
        </div> 
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 flex justify-between gap-3">
   <form id="toggleForm" method="POST">
    @csrf
    @method('PATCH')
    
    <button type="submit"
        id="toggleButton"
        class="text-xs px-3 py-1.5 border border-gray-200 rounded-lg text-blue-500 hover:bg-blue-50 transition">
        Toggle
    </button>
</form>

            <button onclick="closeDetailModal()" 
                    class="bg-gray-300 hover:bg-gray-400 text-white font-semibold text-sm px-6 py-2.5 rounded-lg transition-all">
                Tutup
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }
</style>

<script>
function openDetailModal(userId) {
    const modal = document.getElementById('modalDetail');
    
    fetch(`/admin/pengguna/${userId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('detailNama').textContent = data.nama || '-';
            document.getElementById('detailEmail').textContent = data.email || '-';
            document.getElementById('detailPhone').textContent = data.phone || '-';
            document.getElementById('detailAlamat').textContent = data.alamat || '-';
            document.getElementById('detailCreatedAt').textContent = data.created_at || '-';
            const form = document.getElementById('toggleForm');
            form.action = `/pengguna/status/${data.id_user}`;
            const btn = document.getElementById('toggleButton');
            btn.textContent = data.status == 1 ? 'Nonaktifkan' : 'Aktifkan';

            modal.classList.remove('hidden');
        })
        .catch(error => console.error('Error:', error));
}

function closeDetailModal() {
    const modal = document.getElementById('modalDetail');
    modal.classList.add('hidden');
}

// Tutup modal ketika klik area luar
document.getElementById('modalDetail').addEventListener('click', function(event) {
    if (event.target === this) {
        closeDetailModal();
    }
});
</script>
</x-app-layout>
