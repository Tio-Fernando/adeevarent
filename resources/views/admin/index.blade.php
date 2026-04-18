<x-superadmin>
    {{-- resources/views/admin/data-admin/index.blade.php --}}
    
    <div class="p-6">
    
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-medium text-gray-800">Data Admin</h1>
            <a href="{{ route('admin.create') }}"
                class="bg-orange-500 hover:bg-orange-600 active:scale-95 transition text-white text-sm font-medium px-4 py-2 rounded-lg">
                + Tambah Pengguna
            </a>
        </div>
    
        @if (session('success'))
            <div
                class="mb-4 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif
    
        @if (session('error'))
            <div class="mb-4 flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                {{ session('error') }}
            </div>
        @endif
    
        {{-- TABEL --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-4">
                <span class="text-base font-medium text-gray-700">Data Admin</span>
                <span class="text-xs text-gray-400 border border-gray-200 px-3 py-1 rounded-lg">
                    {{ now()->translatedFormat('F Y') }}
                </span>
            </div>
    
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">No
                            </th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Nama
                            </th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Email
                            </th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Password</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Level
                            </th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Status
                            </th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $index => $admin)
                            <tr class="border-b border-gray-50 hover:bg-orange-50/30 transition">
                                <td class="py-3 px-4 text-gray-400 text-xs">
                                    {{$index+1}}
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-7 h-7 rounded-full bg-orange-100 text-orange-500 text-xs font-semibold flex items-center justify-center flex-shrink-0">
                                            {{ strtoupper(substr($admin->nama, 0, 1)) }}
                                        </div>
                                        <span class="text-gray-800 font-medium">{{ $admin->nama }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-gray-500">{{ $admin->email }}</td>
                                <td class="py-3 px-4 text-gray-300 tracking-widest text-xs">••••••••••</td>
                                <td class="py-3 px-4">
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2.5 py-1 rounded-md">
                                        {{ $admin->level }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    @if ($admin->status === 'aktif')
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
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-1.5">
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.edit',$admin->id) }}"
                                            class="text-xs px-3 py-1.5 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                                            Edit
                                        </a> 

                                        {{-- Toggle Status --}}
                                        <form method="POST" action="{{ route('superadmin.admin.toggleStatus', $admin->id) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="text-xs px-3 py-1.5 border border-gray-200 rounded-lg text-blue-500 hover:bg-blue-50 transition">
                                                {{ $admin->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form> 

                                        {{-- Hapus --}}
                                        <form method="POST" action="{{ route('admin.destroy',$admin->id) }}">  
                                         @csrf
                                         @method('DELETE')  
                                            <button type="submit"
                                                class="text-xs px-3 py-1.5 border border-gray-200 rounded-lg text-red-400 hover:bg-red-50 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-16 text-center">
                                    <div class="flex flex-col items-center gap-2 text-gray-300">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                                        </svg>
                                        <span class="text-sm">Belum ada data admin</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    
            {{-- PAGINATION --}}
            {{-- @if ($admins->hasPages())
                <div class="mt-5 pt-4 border-t border-gray-100">
                    {{ $admins->links() }}
                </div>
            @endif --}}
        </div>
    
    </div>
</x-superadmin>
