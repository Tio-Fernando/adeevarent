<x-app-layout>

       <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

  
<div class="bg-white shadow-sm rounded-xl border border-gray-200 p-4">

    <h2 class="text-lg font-semibold text-gray-700 mb-4">
        Detail Booking
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                        Pelanggan
                    </th>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                        No Pol
                    </th>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                       tgl Sewa
                    </th>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                    Jadwal kembali
                    </th>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                        tgl Kembali
                    </th>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                       Durasi
                    </th>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                    Harga Sewa
                    </th>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                      Sub Total
                    </th>
                    <th class="px-6 py-3 font-medium rounded-l-lg">
                    Denda
                    </th>
                    <th class="px-6 py-3 font-medium text-right rounded-r-lg">
                        Status
                    </th>
                </tr>
            </thead>

            @php
            $booking = [
        [
            'pelanggan'      => 'Avanza (Budi)',
            'nopol'          => 'AE 1922 SH',
            'tgl_sewa'       => '21-08-2025',
            'jadwal_kembali' => '22-08-2025',
            'tgl_kembali'    => '22-08-2025',
            'durasi'         => '1 Hari',
            'harga_sewa'     => 100000,
            'sub_total'      => 100000,
            'denda'          => 0,
            'status'         => 'Booked'
        ],
        [
            'pelanggan'      => 'Hitam (Andi)',
            'nopol'          => 'B 1234 CD',
            'tgl_sewa'       => '25-08-2025',
            'jadwal_kembali' => '28-08-2025',
            'tgl_kembali'    => '-',
            'durasi'         => '3 Hari',
            'harga_sewa'     => 150000,
            'sub_total'      => 450000,
            'denda'          => 0,
            'status'         => 'Booked'
        ],
        [
            'pelanggan'      => 'Citra',
            'nopol'          => 'L 9999 XX',
            'tgl_sewa'       => '01-09-2025',
            'jadwal_kembali' => '02-09-2025',
            'tgl_kembali'    => '03-09-2025',
            'durasi'         => '1 Hari',
            'harga_sewa'     => 200000,
            'sub_total'      => 200000,
            'denda'          => 50000,
            'status'         => 'Booked'
        ]
    ];
    @endphp


            <tbody>
               @forelse ($booking as $item)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item['pelanggan'] }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item['nopol'] }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item['tgl_sewa'] }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item['jadwal_kembali'] }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item['tgl_kembali'] }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item['durasi'] }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item['harga_sewa']}}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item['sub_total'] }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                        {{ $item['denda'] }}
                    </td>

                   <td class="px-4 py-4">
                    @if($item['status'] == 'Booked')
                    <span class="bg-red-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                        Booked
                    </span>
                @else
                    <span class="bg-green-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                        {{ ucfirst($item['status']) }}
                    </span>
                @endif
                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center py-6 text-gray-500">
                        Booking Kosong
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