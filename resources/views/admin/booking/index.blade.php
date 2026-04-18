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

        <div x-data="{ terbuka: {} }" class="overflow-x-auto ">
            <table class="w-full text-sm text-left text-gray-600">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-medium rounded-l-lg">Invoice</th>
                        <th class="px-6 py-3 font-medium rounded-l-lg">Pelanggan</th>
                        <th class="px-6 py-3 font-medium rounded-l-lg">No Pol</th>
                        <th class="px-6 py-3 font-medium rounded-l-lg">tgl Sewa</th>
                        <th class="px-6 py-3 font-medium rounded-l-lg">Jadwal kembali</th>
                        <th class="px-6 py-3 font-medium rounded-l-lg">tgl Kembali</th>
                        <th class="px-6 py-3 font-medium rounded-l-lg">Durasi</th>
                        <th class="px-6 py-3 font-medium rounded-l-lg">Opsi Pengantaran</th>
                        <th class="px-6 py-3 font-medium rounded-l-lg">Lokasi Antar</th>
                        <th class="px-6 py-3 font-medium rounded-l-lg">Denda</th>
                        <th class="px-6 py-3 font-medium text-right rounded-r-lg">Status</th>
                        <th class="px-6 py-3 font-medium text-center rounded-r-lg">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($booking as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ $item->invoice }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ $item->pelanggan->nama_pelanggan }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ $item->nopol }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->tgl_sewa)->translatedFormat('j F Y H:i') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->jadwal_kembali)->translatedFormat('j F Y H:i') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                @if($item->tgl_kembali)
                                    {{ \Carbon\Carbon::parse($item->tgl_kembali)->translatedFormat('j F Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ $item->durasi }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ $item->opsi_pengantaran }}
                            </td>
                            
                            @if ($item->opsi_pengantaran === 'diantar')
                                <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                    @if($item->lokasi_antar)
                                        @php
                                            [$lat, $lng] = explode(',', $item->lokasi_antar);
                                        @endphp
                                        <div id="map-{{ $item->id_tr_sewa }}"
                                            class="w-32 h-20 rounded-lg overflow-hidden border border-gray-200 cursor-pointer"
                                            data-lat="{{ trim($lat) }}"
                                            data-lng="{{ trim($lng) }}">
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1 text-center">
                                            {{ trim($lat) }}, {{ trim($lng) }}
                                        </p>
                                    @else
                                        <span class="text-gray-400 text-xs">Tidak ada lokasi</span>
                                    @endif
                                </td>
                            @else
                                <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                    Ambil Dicabang
                                </td>
                            @endif

                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                {{ $item->denda }}
                            </td>

                            <td class="px-4 py-4">
                                @if($item->status == 'Booking')
                                    <span class="bg-red-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                                        Booking
                                    </span>
                                @else
                                    <span class="bg-green-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @endif
                            </td>

                            {{-- BAGIAN AKSI --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Tombol Detail --}}
                                    <button 
                                        @click="$dispatch('open-detail', {{ $item->id }})"
                                        class="inline-flex items-center gap-1 border-2 border-gray-300 hover:border-orange-400 text-gray-700 hover:text-orange-400 font-semibold text-sm px-4 py-2 rounded-lg transition-all">
                                        Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>

                           
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-6 text-gray-500">
                                Booking Kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $booking->links() }}
        </div>
    </div>

    <div
        x-data="{ show: false, item: {} }"
        @open-detail.window="
            fetch('/sewa/' + $event.detail + '/detail')
                .then(r => r.json())
                .then(data => { item = data; show = true })
        "
        x-show="show"
        @keydown.escape.window="show = false"
        class="fixed inset-0 z-50 flex items-center justify-center px-4"
        style="display:none"
    >
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="show = false"></div>

        <div
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 text-left"
        >
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <div>
                    <h3 class="text-base font-bold text-gray-800">Detail Transaksi Sewa</h3>
                    <p class="text-xs text-gray-400 mt-0.5" x-text="'ID: #' + item.id"></p>
                </div>
                <button @click="show = false" class="p-1.5 rounded-full hover:bg-gray-100 transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="px-6 py-4 space-y-4 max-h-[70vh] overflow-y-auto">
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-50 rounded-xl p-3">
                        <p class="text-xs text-gray-400 mb-1">Pelanggan</p>
                        <p class="text-sm font-semibold text-gray-800" x-text="item.pelanggan?.nama_pelanggan ?? '-'"></p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3">
                        <p class="text-xs text-gray-400 mb-1">No Polisi</p>
                        <p class="text-sm font-semibold text-gray-800" x-text="item.nopol ?? '-'"></p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3">
                        <p class="text-xs text-gray-400 mb-1">Jenis Sewa</p>
                        <p class="text-sm font-semibold text-gray-800" x-text="item.jenis_sewa ?? '-'"></p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3">
                        <p class="text-xs text-gray-400 mb-1">Opsi Pengantaran</p>
                        <p class="text-sm font-semibold text-gray-800" x-text="item.opsi_pengantaran ?? '-'"></p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-orange-50 rounded-xl p-3">
                        <p class="text-xs text-orange-500 mb-1">Tgl Sewa</p>
                        <p class="text-xs font-semibold text-gray-800" x-text="item.tanggal_sewa ?? '-'"></p>
                    </div>
                    <div class="bg-orange-50 rounded-xl p-3">
                        <p class="text-xs text-orange-500 mb-1">Jadwal Kembali</p>
                        <p class="text-xs font-semibold text-gray-800" x-text="item.jadwal_kembali ?? '-'"></p>
                    </div>
                    <div class="bg-orange-50 rounded-xl p-3">
                        <p class="text-xs text-orange-500 mb-1">Tgl Kembali</p>
                        <p class="text-xs font-semibold text-gray-800" x-text="item.tanggal_kembali ?? '-'"></p>
                    </div>
                </div>

                <div class="border rounded-xl overflow-hidden">
                    <div class="bg-gray-50 px-4 py-2 border-b">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Rincian Biaya</p>
                    </div>
                    <div class="divide-y">
                        <div class="flex justify-between px-4 py-2.5">
                            <span class="text-sm text-gray-500">Durasi</span>
                            <span class="text-sm font-medium text-gray-800" x-text="(item.durasi ?? 0) + ' hari'"></span>
                        </div>
                        <div class="flex justify-between px-4 py-2.5">
                            <span class="text-sm text-gray-500">Harga Sewa/hari</span>
                            <span class="text-sm font-medium text-gray-800" x-text="'Rp ' + Number(item.harga_sewa ?? 0).toLocaleString('id-ID')"></span>
                        </div>
                        <div class="flex justify-between px-4 py-2.5">
                            <span class="text-sm text-gray-500">Sub Total</span>
                            <span class="text-sm font-medium text-gray-800" x-text="'Rp ' + Number(item.sub_total ?? 0).toLocaleString('id-ID')"></span>
                        </div>
                        <div class="flex justify-between px-4 py-2.5">
                            <span class="text-sm text-gray-500">Biaya Supir</span>
                            <span class="text-sm font-medium text-gray-800" x-text="'Rp ' + Number(item.biaya_supir ?? 0).toLocaleString('id-ID')"></span>
                        </div>
                        <div class="flex justify-between px-4 py-2.5">
                            <span class="text-sm text-gray-500">Denda</span>
                            <span class="text-sm font-medium text-red-500" x-text="'Rp ' + Number(item.denda ?? 0).toLocaleString('id-ID')"></span>
                        </div>
                        <div class="flex justify-between px-4 py-2.5">
                            <span class="text-sm text-gray-500">DP</span>
                            <span class="text-sm font-medium text-gray-800" x-text="'Rp ' + Number(item.dp ?? 0).toLocaleString('id-ID')"></span>
                        </div>
                    </div>
                    <div class="flex justify-between px-4 py-3 bg-orange-50 border-t-2 border-orange-200">
                        <span class="text-sm font-bold text-gray-700">Harga Total</span>
                        <span class="text-sm font-bold text-orange-600" x-text="'Rp ' + Number(item.harga_total ?? 0).toLocaleString('id-ID')"></span>
                    </div>
                    <div class="flex justify-between px-4 py-3 bg-red-50 border-t border-red-100">
                        <span class="text-sm font-bold text-red-600">Sisa Tagihan</span>
                        <span class="text-sm font-bold text-red-600" x-text="'Rp ' + Number(item.sisa_tagihan ?? 0).toLocaleString('id-ID')"></span>
                    </div>
                </div>

                <div class="flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3">
                    <span class="text-sm text-gray-500">Status</span>
                    <span :class="item.status === 'Booked' ? 'bg-red-100 text-red-600' : 'bg-red-400 text-white'" class="px-3 py-1 rounded-full text-xs font-semibold" x-text="item.status"></span>
                </div>
            </div>

            <div class="px-6 py-4 border-t flex justify-between bg-gray-50 rounded-b-2xl">
                
                <div class="flex gap-2">
                    
                    
                 <form 
                        :action="`/admin/payment/${item.id}/konfirmasi`" 
                        method="POST" 
                        x-show="item.status == 'booking'"
                    >
                        @csrf
                        <button 
                            type="submit" 
                            class="px-5 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-medium" 
                            x-show="item.status === 'booking'"
                        >
                           <span >
                          Konfirmasi DP
                            </span>
                        </button>
                    </form>
                 <form 
                        :action="`/admin/payment/${item.id}/lunas`" 
                        method="POST" 
                        x-show="item.status == 'dp'"
                    >
                        @csrf
                        <button 
                            type="submit" 
                            class="px-5 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-medium" 
                            x-show="item.status === 'dp'"
                        >
                           <span> 
                          Konfirmasi Lunas
                            </span>
                        </button>
                    </form>

                     <form :action="`/booking/${item.id}`" method="POST" x-show="item.status === 'lunas'">
                        @csrf
                        <button type="submit" class="px-5 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-medium">
                            Selesai Sewa
                        </button>
                    </form>

                </div>
                <button @click="show = false" class="px-5 py-2 text-sm bg-gray-400 hover:bg-gray-500 text-white rounded-lg transition font-medium">
                    Tutup
                </button>
            </div>
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

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[id^="map-"]').forEach(function (el) {
                const lat = parseFloat(el.dataset.lat);
                const lng = parseFloat(el.dataset.lng);

                if (!isNaN(lat) && !isNaN(lng)) {
                    const map = L.map(el.id, {
                        center: [lat, lng],
                        zoom: 15,
                        zoomControl: false,      
                        scrollWheelZoom: false,  
                        dragging: false,         
                        attributionControl: false
                    });

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                    L.marker([lat, lng]).addTo(map);

                    // Klik mini map → buka Google Maps
                    el.addEventListener('click', function () {
                        window.open(`https://www.google.com/maps?q=${lat},${lng}`, '_blank');
                    });
                }
            });
        });
    </script>
</x-app-layout>