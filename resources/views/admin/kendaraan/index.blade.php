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
                    
                    <div class="mt-auto flex gap-3">
                        <a href="{{ route('kendaraan.show', $item->nopol) }}" class="flex-1 inline-flex items-center justify-center text-body bg-neutral-secondary-medium border border-default-medium hover:bg-neutral-tertiary-medium px-4 py-2.5 rounded-base text-sm font-medium">
                            Detail Mobil
                            <svg class="w-4 h-4 ms-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                            </svg>
                        </a>
               
                        <form id="delete-form-{{ $item->nopol }}" action="{{ route('kendaraan.destroy', $item->nopol) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete('{{ $item->nopol }}', '{{ $item->nama_kendaraan }}')" class="inline-flex items-center text-white bg-red-500 border border-red-600 hover:bg-red-600 px-4 py-2.5 rounded-base text-sm font-medium transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-2 py-10 text-center text-gray-400 text-sm italic">
                    Belum ada data kendaraan.
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function confirmDelete(nopol, namaKendaraan) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Mobil "${namaKendaraan}" akan dihapus secara permanen`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${nopol}`).submit();
                }
            });
        }
    </script>
</x-app-layout>