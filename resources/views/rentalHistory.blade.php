<x-user>
    <div class="min-h-screen bg-[#FAFAF8] py-10 px-4 text-[#1A1916] font-sans">
        <div class="max-w-7xl mx-auto mb-9">
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center text-gray-500 hover:text-[#D97706] transition-colors duration-200 group">
                    <svg class="w-6 h-6 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div class="flex items-center gap-3">
                    <div>
                        <h1 class="font-['Poppins'] text-2xl md:text-[26px] font-bold text-[#1A1916] tracking-tight leading-tight">Riwayat Rental</h1>
                        <p class="text-[13px] text-[#8C8882] mt-1">Daftar lengkap semua pemesanan penyewaan mobil Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-[20px] border border-[#E8E6E0] shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="p-8 border-b border-[#ECEAE3]">
                    <h2 class="text-lg font-bold text-[#1A1916]">Riwayat Rental</h2>
                </div>

                @forelse ($riwayat as $sewa)
                    @php
                        $status = strtolower($sewa->status);           
                        $paymentExists = $sewa->payments()->exists();
                        $dpPayment = $sewa->payments()
                            ->where('status_pembayaran', 'dp')
                            ->where('transaction_status', 'settlement')
                            ->first();
                        $dp = $dpPayment ? true : false;
                        $lunasPayment = $sewa->payments()
                            ->where('status_pembayaran', 'lunas')
                            ->where('transaction_status', 'settlement')
                            ->first();
                        $lunas = $lunasPayment ? true : false;
                        $cashPaymentPending = $sewa->payments()
                            ->where('payment_type', 'cash')
                            ->where('transaction_status', '!=', 'settlement')
                            ->exists();
                        $pendingPayment = $sewa->payments()
                        ->where('transaction_status', 'pending')
                        ->whereIn('status_pembayaran', ['dp', 'lunas'])
                        ->first();
                            $sudahUploadJaminan = $sewa->jaminan !== null;

                    $adaPendingPayment = $pendingPayment ? true : false;

                        
                        $tgl_sewa = \Carbon\Carbon::parse($sewa->tanggal_sewa);
                        $jadwal_kembali = \Carbon\Carbon::parse($sewa->jadwal_kembali);
                        $durasi = $sewa->durasi ?? $jadwal_kembali->diffInDays($tgl_sewa) ?: 1;
                        
                        $payment = $sewa->payments()->latest()->first();
                        $payment_type = $payment ? $payment->payment_type : 'Belum ditentukan';

                        $payment_labels = [
                            'qris' => 'QRIS',
                            'bank_transfer' => 'Transfer Bank',
                            'gopay' => 'GoPay',
                            'ovo' => 'OVO',
                            'dana' => 'DANA'
                        ];
                        $payment_label = $payment_labels[strtolower($payment_type)] ?? $payment_type;
                        
                        $sisa_bayar = $sewa->sisa_tagihan ?? 0;
                        if ($dp && $dpPayment) {
                            $sisa_bayar = $sewa->harga_total - $dpPayment->jumlah_bayar;
                        }
                    @endphp
                    
                    @if($loop->first)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b border-[#ECEAE3]">
                                    <th class="px-6 py-4 text-center font-bold text-[#1A1916]">Invoice</th>
                                    <th class="px-6 py-4 text-left font-bold text-[#1A1916]">Kendaraan</th>
                                    <th class="px-6 py-4 text-left font-bold text-[#1A1916]">Tanggal Sewa - Kembali</th>
                                    <th class="px-6 py-4 text-center font-bold text-[#1A1916]">Durasi</th>
                                    <th class="px-6 py-4 text-left font-bold text-[#1A1916]">Opsi Layanan</th>
                                    <th class="px-6 py-4 text-left font-bold text-[#1A1916]">Tipe Pembayaran</th>
                                    <th class="px-6 py-4 text-right font-bold text-[#1A1916]">Harga Total</th>
                                    <th class="px-6 py-4 text-center font-bold text-[#1A1916]">Status</th>
                                    <th class="px-6 py-4 text-center font-bold text-[#1A1916]">Aksi</th>
                                    <th class="px-6 py-4 text-center font-bold text-[#1A1916]">Dokumen</th>
                                </tr>
                            </thead>
                            <tbody>
                            @endif
                            <tr class="border-b border-[#ECEAE3] hover:bg-[#F7F6F2] transition-colors">
                                <td class="px-6 py-4 text-center">
                                    @if($paymentExists)
                                        @php
                                            $invoiceNo = \Carbon\Carbon::parse($sewa->created_at)->format('Ymd') . str_pad($sewa->id_tr_sewa, 3, '0', STR_PAD_LEFT);
                                        @endphp
                                        <div class="flex items-center gap-2 justify-center">
                                            <span class="font-mono font-bold text-gray-700 text-xs tracking-wide">
                                                #{{ $invoiceNo }}
                                            </span>
                                            <a href="{{ route('invoice.show', $sewa->id_tr_sewa) }}"
                                                class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-orange-100 hover:bg-orange-200 text-orange-600 transition" 
                                                title="Lihat Invoice">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-300">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-[#1A1916] font-bold">{{ $sewa->kendaraan->nama_kendaraan ?? $sewa->kendaraan->nopol }}</div>
                                    <div class="text-xs text-[#8C8882]">{{ $sewa->kendaraan->nopol ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-[#1A1916] text-xs">
                                    <div>{{ $tgl_sewa->format('d M Y') }}</div>
                                    <div class="text-[#8C8882] mt-1">s/d {{ $jadwal_kembali->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 text-center text-[#1A1916] font-bold">{{ $durasi }} hari</td>
                                <td class="px-6 py-4 text-[#1A1916] text-xs">
                                    <span class="inline-block bg-[#FEF0DC] text-[#D97706] px-3 py-1.5 rounded-lg font-medium">
                                        {{ ucfirst(str_replace('_', ' ', $sewa->opsi_pengantaran ?? '-')) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg font-medium text-xs">
                                        {{ $payment_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-[#1A1916] font-bold whitespace-nowrap">
                                    <span class="inline-flex items-center justify-end whitespace-nowrap">Rp.&nbsp;{{ number_format($sewa->harga_total, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($status == 'batal' || $status == 'cancelled')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                        Dibatalkan
                                    </span>
                                    @elseif($lunas)
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                            Selesai
                                        </span>
                                    @elseif($dp)
                                        <div class="space-y-2">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200 block">
                                                Menunggu Pelunasan
                                            </span>
                                            <div class="text-xs text-gray-600 font-medium">
                                                Sisa: Rp. {{ number_format($sisa_bayar, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    @elseif(!$paymentExists)
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                            Menunggu Pembayaran
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                            {{ $sewa->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center align-middle">
                                    @if($status == 'batal' || $status == 'cancelled' || $status == 'selesai')
                                        <span class="text-xs text-gray-400 font-medium">-</span>
                                    @else
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <button @click="open = !open" @click.away="open = false" type="button" class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-[#D97706] shadow-sm transition-all">
                                                Opsi
                                                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <div x-show="open" 
                                                 x-transition:enter="transition ease-out duration-100" 
                                                 x-transition:enter-start="transform opacity-0 scale-95" 
                                                 x-transition:enter-end="transform opacity-100 scale-100" 
                                                 x-transition:leave="transition ease-in duration-75" 
                                                 x-transition:leave-start="transform opacity-100 scale-100" 
                                                 x-transition:leave-end="transform opacity-0 scale-95" 
                                                 class="absolute right-0 z-[60] w-44 mt-2 origin-top-right bg-white border border-gray-100 rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none overflow-hidden" style="display: none;">
                                                
                                            
<div class="py-1">

    @if($lunas)
        {{-- Tidak ada aksi pembayaran --}}

    @elseif($dp)
        {{-- DP settlement → Lunasi --}}
        @if(!$sudahUploadJaminan)
            {{-- Jaminan belum upload walau sudah DP --}}
            <a href="{{ route('jaminan.show', $sewa->id_tr_sewa) }}"
               class="flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-purple-600 hover:bg-purple-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Upload Dokumen
            </a>
        @else
            <a href="{{ route('pelunasan', $sewa->id_tr_sewa) }}"
               class="flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-[#FEF0DC] hover:text-[#D97706] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Lunasi
            </a>
        @endif

    @elseif($adaPendingPayment && $status === 'booking')
        {{-- Ada payment pending → cek jaminan dulu --}}
        @if(!$sudahUploadJaminan)
            <a href="{{ route('jaminan.show', $sewa->id_tr_sewa) }}"
               class="flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-purple-600 hover:bg-purple-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Upload Dokumen
            </a>
        @else
            <a href="{{ route('payment', $sewa->id_tr_sewa) }}"
               class="flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-[#FEF0DC] hover:text-[#D97706] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                Bayar Sekarang
            </a>
        @endif
@elseif($status === 'pending_konfirmasi')
    <div class="flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-yellow-600">
        <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Menunggu Konfirmasi Admin
    </div>

    @elseif(!$paymentExists)
        {{-- Belum ada payment sama sekali --}}
        @if(!$sudahUploadJaminan)
            <a href="{{ route('jaminan.show', $sewa->id_tr_sewa) }}"
               class="flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-purple-600 hover:bg-purple-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Upload Dokumen
            </a>
        @else
            <a href="{{ route('payment', $sewa->id_tr_sewa) }}"
               class="flex items-center gap-2 px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-[#FEF0DC] hover:text-[#D97706] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                Bayar Sekarang
            </a>
        @endif

    @endif

    {{-- Divider --}}
    @if(!$lunas && !$cashPaymentPending)
        <div class="h-px bg-gray-100 my-1"></div>
    @endif

    {{-- Batalkan --}}
    <button type="button"
            onclick="konfirmasiBatal({{ $sewa->id_tr_sewa }}, '{{ $status }}')"
            class="flex items-center w-full gap-2 px-4 py-2.5 text-xs font-semibold text-red-600 hover:bg-red-50 transition-colors text-left">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
        Batalkan
    </button>

    <form id="form-batal-{{ $sewa->id_tr_sewa }}" action="{{ route('sewa.cancel', $sewa->id_tr_sewa) }}" method="POST" class="hidden">
        @csrf
        @method('PUT')
    </form>
</div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($sewa->jaminan)
                                    <button onclick="lihatDokumenSaya({{ $sewa->id_tr_sewa }})"
                                        class="inline-flex items-center justify-center gap-1 border border-purple-200 bg-purple-50 text-purple-600 hover:bg-purple-100 px-3 py-1.5 rounded-lg font-medium text-xs transition-colors w-full">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Dokumen
                                    </button>
                                @endif
                        </td>
                            </tr>
                    @if($loop->last)
                            </tbody>
                        </table>
                    </div>
                    @endif
                @empty
                    <div class="p-8 text-center">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M19 17h2a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-1M13 1h-2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2z"/>
                        </svg>
                        <p class="text-gray-400 text-sm font-medium">Tidak ada riwayat rental</p>
                        <p class="text-gray-300 text-xs mt-2">Ayo rental kendaraan sekarang!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div id="modalDokumen" class="hidden fixed inset-0 z-50 bg-black/60 flex items-center justify-center p-4" onclick="closeDokumenModal()">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl" onclick="event.stopPropagation()">
            <div class="sticky top-0 bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4 flex items-center justify-between border-b border-orange-600 z-10">
                <h2 class="text-xl font-bold text-white">Dokumen Jaminan</h2>
                <button type="button" onclick="closeDokumenModal()" class="text-white hover:bg-white/20 p-2 rounded-lg transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-4" id="modalContent">
                <div class="flex items-center justify-center py-8">
                    <div class="text-center">
                        <svg class="w-8 h-8 text-orange-500 mx-auto animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <p class="text-gray-500 mt-2">Memuat dokumen...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Preview Gambar Penuh --}}
    <div id="previewModal" class="hidden fixed inset-0 z-[60] bg-black/90 flex items-center justify-center p-4" onclick="closePreviewModal()">
        <button type="button" class="absolute top-6 right-6 bg-white/20 hover:bg-white/40 text-white rounded-full p-2 transition" onclick="closePreviewModal()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="previewImage" src="" class="max-w-[90vw] max-h-[85vh] rounded-lg object-contain shadow-2xl" onclick="event.stopPropagation()">
    </div>

    <script>
        function lihatDokumenSaya(id_tr_sewa) {
            const modal = document.getElementById('modalDokumen');
            const content = document.getElementById('modalContent');
            
            modal.classList.remove('hidden');

            fetch(`{{ url('/jaminan') }}/${id_tr_sewa}/view`)
                .then(response => response.json())
                .then(data => {
                    if (data.documents && data.documents.length > 0) {
                        let html = '<div class="grid grid-cols-2 gap-4">';
                        
                        data.documents.forEach(doc => {
                            const isImage = /\.(jpg|jpeg|png|gif|webp)$/i.test(doc.url);
                            
                            html += `
                                <div class="flex flex-col gap-2 p-4 border border-gray-200 rounded-lg hover:shadow-md transition bg-white">
                                    <p class="text-sm font-semibold text-gray-700">${doc.label}</p>
                                    <div class="flex gap-2 mt-auto">
                                        ${isImage ? `
                                            <button onclick="previewImage('${doc.path}')" 
                                                class="flex-1 inline-flex items-center justify-center gap-2 bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-lg text-xs font-medium transition" title="Lihat Dokumen">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Lihat
                                            </button>
                                        ` : `
                                            <a href="${doc.path}" target="_blank"
                                                class="flex-1 inline-flex items-center justify-center gap-2 bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-lg text-xs font-medium transition" title="Lihat PDF/File">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Lihat
                                            </a>
                                        `}
                                    </div>
                                </div>
                            `;
                        });
                        
                        html += '</div>';
                        content.innerHTML = html;
                    } else {
                        content.innerHTML = `
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-500 font-medium">Belum ada dokumen yang diunggah</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    content.innerHTML = `
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-red-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-gray-500 font-medium">Gagal memuat dokumen</p>
                        </div>
                    `;
                });
        }

        function submitEditForm(fieldName) {
            const fileInput = document.getElementById(`file-${fieldName}`);
            if (fileInput.files.length > 0) {
                Swal.fire({
                    title: 'Mengunggah...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                document.getElementById(`form-edit-${fieldName}`).submit();
            }
        }

        function konfirmasiBatal(id, statusSewa) {
            let textWarning = "Apakah Anda yakin ingin membatalkan pesanan ini? Aksi ini tidak dapat diurungkan.";
            
            if (statusSewa === 'dp' || statusSewa === 'lunas') {
                textWarning = "Apakah Anda yakin ingin membatalkan pesanan ini? Uang pembayaran (DP/Lunas) yang sudah masuk akan OTOMATIS HANGUS dan tidak dapat dikembalikan.";
            }

            Swal.fire({
                title: 'Batalkan Pesanan?',
                text: textWarning,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444', 
                cancelButtonColor: '#9CA3AF', 
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Membatalkan pesanan Anda.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('form-batal-' + id).submit();
                }
            });
        }

        function closeDokumenModal() {
            document.getElementById('modalDokumen').classList.add('hidden');
        }

        function previewImage(src) {
            document.getElementById('previewImage').src = src;
            document.getElementById('previewModal').classList.remove('hidden');
        }

        function closePreviewModal() {
            document.getElementById('previewModal').classList.add('hidden');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDokumenModal();
                closePreviewModal();
            }
        });
    </script>
</x-user>
