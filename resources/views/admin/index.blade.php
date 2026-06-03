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
            
            </div>
    
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-center py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">No
                            </th>
                            <th class="text-center py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Nama
                            </th>
                            <th class="text-center py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Email
                            </th>
                            <th class="text-center py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Level
                            </th>
                            <th class="text-center py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Status
                            </th>
                            <th class="text-center py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wide">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $index => $admin)
                            <tr class="border-b border-gray-50 hover:bg-orange-50/30 transition">
                                <td class="py-3 px-4 text-center text-gray-400 text-xs">
                                    {{$index+1}}
                                </td>
                                <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 text-[11px] font-bold flex items-center justify-center flex-shrink-0 border border-orange-200">
                                        @php
                                            $words = explode(' ', $admin->nama ?? $admin->name);
                                            $initials = '';
                                            foreach ($words as $w) {
                                                $initials .= strtoupper(substr($w, 0, 1));
                                            }
                                            echo substr($initials, 0, 2); 
                                        @endphp
                                    </div>
                                    <span class="text-gray-800 font-semibold">{{ $admin->nama ?? $admin->name }}</span>
                                </div>
                            </td>
                                <td class="py-3 px-4 text-gray-500">{{ $admin->email }}</td>
                                <td class="py-3 px-4 text-center">
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2.5 py-1 rounded-md">
                                        {{ $admin->level }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if ($admin->status == 1)
                                        <span
                                            class="inline-flex items-center gap-1 bg-green-50 text-green-600 text-xs font-medium px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full justify-center"></span>
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
                                        <a href="{{ route('admin.edit',$admin->id_user) }}"
                                            class="text-xs px-3 py-1.5 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                                            Edit
                                        </a> 

                                        {{-- Toggle Status --}}
                                        <form method="POST" action="{{ route('toggle',$admin->id_user) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="text-xs px-3 py-1.5 border border-gray-200 rounded-lg text-blue-500 hover:bg-blue-50 transition">
                                                {{ $admin->status == 1 ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form> 

                                     
                                        <form method="POST" action="{{ route('admin.destroy',$admin->id_user) }}">  
                                         @csrf
                                         @method('DELETE')  
                                            <button type="submit" onclick="confirm('Apakah anda ingin menghapus akun ini')"
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
            @if ($admins->hasPages())
                <div class="mt-5 pt-4 border-t border-gray-100">
                    {{ $admins->links() }}
                </div>
            @endif
        </div>
    
    </div>
</x-superadmin>
