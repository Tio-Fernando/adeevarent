<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-4">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Detail Booking</h2>
            <a href="{{ route('booking.create') }}"
            class="bg-primary hover:bg-accent active:scale-95 transition text-white text-sm font-medium px-4 py-2 rounded-lg">
                + Tambah Booking
            </a>
        </div>

        <div class="flex items-center justify-between gap-4 mb-4">
            <form method="GET" action="{{ route('booking.index') }}" class="w-full flex flex-col lg:flex-row items-center gap-3 justify-between">
                <div class="flex-1 min-w-0 flex items-center gap-2">
                    <div class="relative w-full sm:w-80">
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
                            placeholder="Cari Invoice, No.Pol atau Pelanggan..."
                            value="{{ $search ?? '' }}"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-full focus:ring-orange-500 focus:border-orange-500 pl-10 pr-4 py-2.5 outline-none sm:text-sm"
                        >
                    </div>
                    <button type="submit"
                            class="px-5 py-2.5 bg-primary hover:bg-accent text-white rounded-full text-sm font-semibold transition whitespace-nowrap">
                        Cari
                    </button>
                    @if($search)
                        <a href="{{ route('booking.index') }}"
                           class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 rounded-full text-sm font-semibold text-gray-700 whitespace-nowrap">
                            Reset
                        </a>
                    @endif
                </div>

                <div class="flex items-center gap-2 justify-end">
                    <div class="flex flex-col text-left text-xs text-gray-500">
                        <label for="filterTanggalDari" class="mb-1">Dari</label>
                        <input
                            id="filterTanggalDari"
                            name="tanggal_dari"
                            type="date"
                            value="{{ $tanggalDari ?? now()->toDateString() }}"
                            onchange="this.form.submit()"
                            class="w-40 bg-white border border-gray-200 text-gray-700 rounded-full py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-300"
                        />
                    </div>

                    <div class="flex flex-col text-left text-xs text-gray-500">
                        <label for="filterTanggalSampai" class="mb-1">Sampai</label>
                        <input
                            id="filterTanggalSampai"
                            name="tanggal_sampai"
                            type="date"
                            value="{{ $tanggalSampai ?? now()->toDateString() }}"
                            onchange="this.form.submit()"
                            class="w-40 bg-white border border-gray-200 text-gray-700 rounded-full py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-300"
                        />
                    </div>
                </div>
            </form>
        </div>

        <div x-data="{ terbuka: {} }" class="overflow-x-auto ">
            <table class="w-full text-sm text-left text-gray-600">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-bold rounded-l-lg text-center">Invoice</th>
                        <th class="px-6 py-3 font-bold text-center">Pelanggan</th>
                        <th class="px-6 py-3 font-bold text-center">No Pol</th>
                        <th class="px-6 py-3 font-bold text-center">tanggal Sewa</th>
                        <th class="px-6 py-3 font-bold text-center">Jadwal kembali</th>
                        <th class="px-6 py-3 font-bold text-center">tanggal Kembali</th>
                        <th class="px-6 py-3 font-bold text-center">Durasi</th>
                        <th class="px-6 py-3 font-bold text-center">Opsi Pengantaran</th>
                        <th class="px-6 py-3 font-bold text-center">Lokasi Antar</th>
                        <th class="px-6 py-3 font-bold text-center">Denda</th>
                        <th class="px-6 py-3 font-bold text-center">Status</th>
                        <th class="px-6 py-3 font-bold text-center">Dokumen</th>
                        <th class="px-6 py-3 font-bold text-center">Keterangan</th>
                        <th class="px-6 py-3 font-bold rounded-r-lg text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($booking as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                            @php
                                $invoiceNo = \Carbon\Carbon::parse($item->created_at)->format('Ymd') . str_pad($item->id_tr_sewa, 3, '0', STR_PAD_LEFT);
                            @endphp
                            <div class="flex items-center justify-center gap-2">
                                <span class="font-mono font-bold text-gray-800 text-xs">#{{ $invoiceNo }}</span>
                                <a href="{{ route('admin.invoice.show', $item->id_tr_sewa) }}"
                                    class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-orange-100 hover:bg-orange-200 text-orange-600 transition" 
                                    title="Lihat Invoice">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                            {{ $item->pelanggan->nama_pelanggan }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                            {{ $item->nopol }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal_sewa)->translatedFormat('j F Y H:i') }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                            {{ \Carbon\Carbon::parse($item->jadwal_kembali)->translatedFormat('j F Y H:i') }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                            @if($item->tanggal_kembali)
                                {{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('j F Y H:i') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                            {{ $item->durasi }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                            {{ $item->opsi_pengantaran }}
                        </td>
                        
                        @if ($item->opsi_pengantaran === 'diantar')
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                @if($item->lokasi_antar)
                                    @php
                                        [$lat, $lng] = explode(',', $item->lokasi_antar);
                                    @endphp
                                    <div class="flex flex-col items-center">
                                        <div id="map-{{ $item->id_tr_sewa }}"
                                            class="w-32 h-20 rounded-lg  z-10 overflow-hidden border border-gray-200 cursor-pointer"
                                            data-lat="{{ trim($lat) }}"
                                            data-lng="{{ trim($lng) }}">
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1 text-center">
                                            {{ trim($lat) }}, {{ trim($lng) }}
                                        </p>
                                    </div>
                                @else
                                    <div class="text-center"><span class="text-gray-400 text-xs">Tidak ada lokasi</span></div>
                                @endif
                            </td>
                        @else
                            <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                                Ambil Dicabang
                            </td>
                        @endif

                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                            {{ $item->denda }}
                        </td>

                        <td class="px-4 py-4 text-center">
                        @php
                            // Membersihkan string dari spasi dan mengubah ke huruf kecil
                            $statusClean = strtolower(trim($item->status));
                        @endphp

                        @if($statusClean == 'booking')
                            <span class="bg-red-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm">Booking</span>
                        @elseif($statusClean == 'dp')
                            <span class="bg-yellow-400 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm">DP</span>
                        @elseif($statusClean == 'lunas')
                            <span class="bg-green-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm">Lunas</span>
                        @elseif($statusClean == 'selesai')
                            <span class="bg-orange-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm">Selesai</span>
                        @elseif($statusClean == 'batal')
                        <span class="bg-gray-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-sm">Batal</span>
                        @else   
                            <span class="bg-gray-300 text-gray-700 px-4 py-1.5 rounded-full text-xs font-semibold">
                                {{ $item->status ?? 'Tanpa Status' }}
                            </span>
                        @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($item->jaminan)
                                <button type="button" onclick="lihatDokumen({{ $item->id_tr_sewa }})"
                                    class="inline-flex items-center gap-1 border-2 border-gray-300 hover:border-orange-400 text-gray-700 hover:text-orange-400 font-semibold text-sm px-4 py-2 rounded-lg transition-all whitespace-nowrap">
                                    Dokumen
                                </button>
                            @else
                                <span class="text-xs text-gray-400 font-medium whitespace-nowrap bg-gray-100 px-2 py-1 rounded-md">Belum Upload</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap text-center">
                        {{ $item->payments->first()->keterangan ?? '-' }}
                        </td>
                        
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button 
                                    @click="$dispatch('open-detail', {{ $item->id_tr_sewa }})"
                                    class="inline-flex items-center gap-1 border-2 border-gray-300 hover:border-orange-400 text-gray-700 hover:text-orange-400 font-semibold text-sm px-4 py-2 rounded-lg transition-all whitespace-nowrap">
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
                            <td colspan="14" class="text-center py-6 text-gray-500">
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
                    <p class="text-xs text-gray-400 mt-0.5" x-text="'ID: #' + item.id_tr_sewa"></p>
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
                <div>
                        <div class="bg-gray-50 rounded-xl p-3">
                        <p class="text-xs text-gray-400 mb-1">Keterangan</p>
                        <p class="text-sm font-semibold text-gray-800" 
                x-text="item.keterangan ?? '-'">
                    </p>
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
                    <span :class="{
                        'bg-red-100 text-red-600': item.status?.toLowerCase() === 'booking',
                        'bg-yellow-100 text-yellow-600': item.status?.toLowerCase() === 'dp',
                        'bg-green-100 text-green-600': item.status?.toLowerCase() === 'lunas',
                        'bg-orange-100 text-orange-600': item.status?.toLowerCase() === 'selesai',
                        'bg-gray-100 text-gray-600': item.status?.toLowerCase() === 'batal',
                    }" 
                    class="px-3 py-1 rounded-full text-xs font-semibold" 
                    x-text="item.status"></span>
                </div>
            </div>

            <div class="px-6 py-4 border-t flex flex-wrap gap-2 justify-start bg-gray-50 rounded-b-2xl">
                    
                 <form 
                        :action="`/admin/payment/${item.id_tr_sewa}/konfirmasi`" 
                        method="POST" 
                        x-show="item.status === 'booking' && item.is_cash && item.transaction_status !== 'settlement'"
                        @submit.prevent="handleKonfirmasiDP($event, item.id_tr_sewa)"
                    >
                        @csrf
                        <button 
                            type="submit" 
                            class="px-5 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-medium shadow-md shadow-green-500/20"
                        >
                            Konfirmasi DP
                        </button>
                    </form>
                 <form 
                        :action="`/admin/payment/${item.id_tr_sewa}/lunas`" 
                        method="POST" 
                        x-show="item.status === 'dp' && item.is_cash && item.transaction_status !== 'settlement'"
                        @submit.prevent="handleKonfirmasiLunas($event, item.id_tr_sewa)"
                    >
                        @csrf
                        <button 
                            type="submit" 
                            class="px-5 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg transition font-medium shadow-md shadow-green-500/20"
                        >
                            Konfirmasi Lunas
                        </button>
                    </form>
                
                     <form :action="`/admin/payment/${item.id_tr_sewa}/batal`" method="POST" id="form-batal"
                     x-show="item.status === 'dp' || item.status === 'lunas'"
                     >
                        @csrf
                        <button 
                            type="button" 
                            @click="confirmBatal(item.id_tr_sewa)"
                            class="px-5 py-2 text-sm bg-red-500 hover:bg-red-600 text-white rounded-lg transition font-medium"
                        >
                            Batalkan Sewa
                        </button>
                    </form>

                <form :action="`/booking/${item.id_tr_sewa}`" method="POST" x-show="item.status === 'lunas'">
                    @csrf
                    <button type="submit" class="px-5 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition font-medium shadow-md shadow-blue-500/20">
                        Selesai Sewa
                    </button>
                </form>
                
                <a :href="`/booking/${item.id_tr_sewa}/pelunasan`"
                x-show="item.status === 'dp'"
                class="px-5 py-2 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition font-medium">
                    Pelunasan
                </a>
            </div>
        </div>
    </div>

    <script>
        window.confirmDelete = function(id){
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
            window.confirmBatal = function(id){
                Swal.fire({
                    title: 'Batalkan Pesanan?',
                    text: "Pesanan yang dibatalkan tidak dapat dikembalikan statusnya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Batalkan!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-batal').submit();
                    }
                });
            }

        window.handleKonfirmasiDP = function(event, id) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            Swal.fire({
                title: 'Konfirmasi DP?',
                text: "Apakah Anda yakin ingin mengkonfirmasi pembayaran DP ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Konfirmasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: "Sedang mengonfirmasi DP",
                        icon: 'info',
                        allowOutsideClick: false,
                        didOpen: async () => {
                            Swal.showLoading();
                            try {
                                const response = await fetch(form.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                    }
                                });

                                const data = await response.json();

                                if (response.ok) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: data.message || 'DP berhasil dikonfirmasi',
                                        icon: 'success',
                                        timer: 2000
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message || 'Terjadi kesalahan saat mengonfirmasi DP',
                                        icon: 'error',
                                        confirmButtonColor: '#ef4444'
                                    });
                                }
                            } catch (error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: error.message || 'Terjadi kesalahan jaringan',
                                    icon: 'error',
                                    confirmButtonColor: '#ef4444'
                                });
                            }
                        }
                    });
                }
            });
        }

        window.handleKonfirmasiLunas = function(event, id) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            Swal.fire({
                title: 'Konfirmasi Pelunasan?',
                text: "Apakah Anda yakin ingin mengkonfirmasi pembayaran pelunasan ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Konfirmasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: "Sedang mengonfirmasi Lunas",
                        icon: 'info',
                        allowOutsideClick: false,
                        didOpen: async () => {
                            Swal.showLoading();
                            try {
                                const response = await fetch(form.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                    }
                                });

                                const data = await response.json();

                                if (response.ok) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: data.message || 'Pembayaran berhasil dikonfirmasi',
                                        icon: 'success',
                                        timer: 2000
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message || 'Terjadi kesalahan saat mengonfirmasi pembayaran',
                                        icon: 'error',
                                        confirmButtonColor: '#ef4444'
                                    });
                                }
                            } catch (error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: error.message || 'Terjadi kesalahan jaringan',
                                    icon: 'error',
                                    confirmButtonColor: '#ef4444'
                                });
                            }
                        }
                    });
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

                    el.addEventListener('click', function () {
                        window.open(`https://www.google.com/maps?q=${lat},${lng}`, '_blank');
                    });
                }
            });
        });

        window.lihatDokumen = function(id) {
        fetch(`/sewa/${id}/jaminan`)
            .then(r => r.json())
            .then(data => {
                const jaminan = data.jaminan;
                if (!jaminan) {
                    Swal.fire('Info', 'Belum ada dokumen yang diupload', 'info');
                    return;
                }

                const fields = {
                    'KTP': jaminan.ktp,
                    'Kartu Keluarga': jaminan.kk,
                    'SIM A': jaminan.simA,
                    'Motor': jaminan.motor,
                    'Mutasi Rekening': jaminan.rekening,
                    'Rekening Listrik': jaminan.rekening_listrik,
                    'Foto Rumah': jaminan.rumah,
                    'Selfie KTP': jaminan.foto_wajah,
                };

                let html = `
                <style>
                    .doc-card .hover-overlay { opacity: 0; pointer-events: none; transition: opacity 0.2s ease-in-out; }
                    .doc-card:hover .hover-overlay { opacity: 1; pointer-events: auto; }
                </style>
                <div class="grid grid-cols-2 gap-3 text-left">`;
                
                for (const [label, path] of Object.entries(fields)) {
                    if (path) {
                        const url = `/storage/${path}`;
                        const isImage = /\.(jpg|jpeg|png)$/i.test(path);
                        html += `
                            <div class="relative w-full h-32 doc-card rounded-xl overflow-hidden border border-gray-200 shadow-sm bg-gray-50">
                                ${isImage 
                                    ? `<img src="${url}" class="w-full h-full object-cover">`
                                    : `<div class="w-full h-full flex flex-col items-center justify-center pb-4">
                                        <svg class="w-10 h-10 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>`
                                }
                                
                                <div class="absolute bottom-0 inset-x-0 bg-orange-500 py-1.5 px-2">
                                    <p class="text-[10px] font-bold text-white text-center uppercase tracking-widest">${label}</p>
                                </div>

                                <div class="hover-overlay absolute inset-0 bg-black/60 flex items-center justify-center gap-3 backdrop-blur-[1px]">
                                    <a href="${url}" target="_blank" class="w-9 h-9 flex items-center justify-center bg-gray-500 hover:bg-gray-400 text-white rounded-full transition-colors shadow-md" title="Lihat">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    
                                    <a href="${url}" download class="w-9 h-9 flex items-center justify-center bg-green-500 hover:bg-green-400 text-white rounded-full transition-colors shadow-md" title="Download">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    </a>
                                </div>
                            </div>`;
                    }
                }
                html += '</div>';

                Swal.fire({
                    title: `<span class="text-lg">Dokumen Jaminan — ${data.pelanggan}</span>`,
                    html: html,
                    width: '650px',
                    showCloseButton: true,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'rounded-2xl',
                    }
                });
            });
    }
    </script>
</x-app-layout>