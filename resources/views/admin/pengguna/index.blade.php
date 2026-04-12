<x-app-layout>
<div class="p-6">

    {{-- HEADER --}}
    <div class="flex items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Nama Pengguna</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Nomor HP</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Alamat</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="w-10 h-10 rounded-full border-2 border-orange-100" 
                                        src="https://ui-avatars.com/api/?name={{ urlencode($user->pelanggan->nama_pelanggan ?? $user->name) }}&background=FF9E0C&color=fff" 
                                        alt="{{ $user->name }}">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $user->pelanggan->nama_pelanggan ?? $user->name }}</p>
                                        <p class="text-xs text-gray-500">Terdaftar {{ $user->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700">{{ $user->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700 font-medium">{{ $user->phone ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">
                                    {{ Str::limit($user->pelanggan->alamat ?? '-', 40) }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $user->pelanggan && $user->pelanggan->status ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $user->pelanggan && $user->pelanggan->status ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openDetailModal({{ $user->id }})" 
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

</div>

{{-- MODAL DETAIL ALAMAT --}}
<div id="modalDetail" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-fade-in">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-t-2xl px-8 py-6 flex justify-between items-center">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Detail Pengguna
            </h2>
            <button onclick="closeDetailModal()" class="text-white hover:bg-blue-700 rounded-lg p-1 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-8 space-y-5">
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Nama Pengguna</label>
                <p class="text-lg font-semibold text-gray-800" id="detailNama">-</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Email</label>
                <p class="text-sm text-gray-700" id="detailEmail">-</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Nomor HP</label>
                <p class="text-sm font-medium text-gray-800" id="detailPhone">-</p>
            </div>

            <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                <label class="block text-xs text-gray-500 uppercase font-bold mb-2">Alamat Lengkap</label>
                <p class="text-sm text-gray-700 leading-relaxed" id="detailAlamat">-</p>
            </div>

            <div class="flex gap-4">
                <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                    <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Status</label>
                    <p id="detailStatus" class="text-center text-xs font-bold">-</p>
                </div>

                <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                    <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Terdaftar</label>
                    <p class="text-xs text-gray-700 text-center" id="detailCreatedAt">-</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 rounded-b-2xl flex justify-end gap-3">
            <button onclick="closeDetailModal()" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold text-sm px-6 py-2.5 rounded-lg transition-all">
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
            document.getElementById('detailStatus').textContent = data.status ? 'Aktif' : 'Nonaktif';
            document.getElementById('detailCreatedAt').textContent = data.created_at || '-';
            
            // Style untuk status
            const statusEl = document.getElementById('detailStatus');
            if (data.status) {
                statusEl.className = 'text-gray-800 bg-green-100 px-3 py-1 rounded-full text-sm font-bold w-fit';
                statusEl.textContent = 'Aktif';
            } else {
                statusEl.className = 'text-gray-800 bg-red-100 px-3 py-1 rounded-full text-sm font-bold w-fit';
                statusEl.textContent = 'Nonaktif';
            }
            
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
