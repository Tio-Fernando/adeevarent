<x-app-layout>

       <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex justify-end">
        <a href="{{ route('kategori.create') }}" class="bg-primary rounded-lg px-4 py-2 mb-2 text-white hover:bg-accent">Tambah Kategori</a>
    </div>
<div class="bg-white shadow-sm rounded-xl border border-gray-200 p-4">

    <h2 class="text-lg font-semibold text-gray-700 mb-4">
        Detail Kategori
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                        Nama Kategori
                    </th>
                    <th class="px-6 py-3 font-medium text-right rounded-r-lg">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>
               @forelse ($kategori as $item)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item->nama_kategori }}
                    </td>

                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('kategori.edit',$item->id_kategori) }}" class="text-orange-500 hover:text-orange-600 font-medium">
                            Edit
                        </a>
                   <form id="delete-form-{{ $item->id_kategori }}" action="{{ route('kategori.destroy', $item->id_kategori) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')

                        <button type="button" onclick="confirmDelete({{ $item->id_kategori }})" class="text-red-500 hover:text-red-600 font-medium">
                            Hapus
                        </button>
                    </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center py-6 text-gray-500">
                        Kategori Kosong
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>
    </div>

</div>

<script>
window.confirmDelete = function(id){
    console.log("Tombol hapus diklik untuk ID:", id);
    Swal.fire({
        title: 'Yakin hapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f59e0b',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
</x-app-layout>