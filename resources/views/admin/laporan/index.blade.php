<x-app-layout>
    <div class="p-6">
    
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Data Laporan</h1>
            
            <button class="bg-emerald-400 hover:bg-emerald-500 text-white font-semibold py-2 px-6 rounded-full text-sm transition shadow-sm">
                Export Excel
            </button>
        </div>
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-2">
            
        
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">
                    Data Laporan
                </h2>
                
                <div class="relative">
                    <select class="appearance-none bg-white border border-gray-200 text-gray-700 py-1.5 pl-4 pr-10 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </div>

            @php
                $laporan = [
                    [
                        'nopol'        => 'AE 1022 SH',
                        'pelanggan'    => 'Tio Ferna',
                        'jenis'        => 'Tanpa Supir',
                        'tanggal_sewa' => '12-05-2025',
                        'kembali'      => '12-05-2025',
                        'durasi'       => 5,
                        'harga'        => 200000,
                        'sub_total'    => 200000,
                        'denda'        => 20000,
                        'harga_total'  => 220000,
                        'status'       => 'Selesai'
                    ],
                    [
                        'nopol'        => 'AE 1022 SH',
                        'pelanggan'    => 'Tio Ferna',
                        'jenis'        => 'Tanpa Supir',
                        'tanggal_sewa' => '12-05-2025',
                        'kembali'      => '12-05-2025',
                        'durasi'       => 5,
                        'harga'        => 200000,
                        'sub_total'    => 200000,
                        'denda'        => 20000,
                        'harga_total'  => 220000,
                        'status'       => 'Selesai'
                    ]
                ];
            @endphp

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-600">
                    <thead class="bg-gray-50 text-gray-700 font-bold">
                        <tr>
                            <th class="px-4 py-4 rounded-l-xl">No Pol</th>
                            <th class="px-4 py-4">Pelanggan</th>
                            <th class="px-4 py-4">Jenis</th>
                            <th class="px-4 py-4">Tanggal Sewa</th>
                            <th class="px-4 py-4">Kembali</th>
                            <th class="px-4 py-4">Durasi</th>
                            <th class="px-4 py-4">Harga</th>
                            <th class="px-4 py-4">Sub Total</th>
                            <th class="px-4 py-4">Denda</th>
                            <th class="px-4 py-4">Harga Total</th>
                            <th class="px-4 py-4 rounded-r-xl">Status</th>
                        </tr>
                    </thead>
                    
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($laporan as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-5">{{ $item['nopol'] }}</td>
                                <td class="px-4 py-5">{{ $item['pelanggan'] }}</td>
                                <td class="px-4 py-5">{{ $item['jenis'] }}</td>
                                <td class="px-4 py-5">{{ $item['tanggal_sewa'] }}</td>
                                <td class="px-4 py-5">{{ $item['kembali'] }}</td>
                                <td class="px-4 py-5">{{ $item['durasi'] }}</td>
                                <td class="px-4 py-5">Rp. {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="px-4 py-5">Rp. {{ number_format($item['sub_total'], 0, ',', '.') }}</td>
                                <td class="px-4 py-5">Rp. {{ number_format($item['denda'], 0, ',', '.') }}</td>
                                <td class="px-4 py-5">Rp. {{ number_format($item['harga_total'], 0, ',', '.') }}</td>
                                <td class="px-4 py-5">
                                    @if($item['status'] == 'Selesai')
                                        <span class="bg-emerald-500 text-white px-5 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                                            {{ $item['status'] }}
                                        </span>
                                    @else
                                        <span class="bg-gray-500 text-white px-5 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                                            {{ $item['status'] }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-10 text-gray-500 italic">
                                    Belum ada data laporan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>