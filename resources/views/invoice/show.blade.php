<x-user>
<div class="min-h-screen bg-[#FAFAF8] py-10 px-4">
    <div class="max-w-3xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#D97706] transition text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
            <a href="{{ route('invoice.download', $sewa->id_tr_sewa) }}"
               class="inline-flex items-center gap-2 bg-[#D97706] hover:bg-[#B45309] text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download PDF
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-[#E8E6E0] shadow-sm overflow-hidden">

            <div class="bg-[#1A1916] text-white px-8 py-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">INVOICE</h1>
                        <p class="text-[#D97706] font-mono font-bold text-lg mt-1">#{{ $invoice }}</p>
                        <p class="text-gray-400 text-xs mt-2">Diterbitkan: {{ \Carbon\Carbon::parse($sewa->created_at)->format('d F Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-white font-bold text-lg">PT Adeevaindo</p>
                        <p class="text-gray-400 text-xs mt-1">Trans Utama</p>
                        <p class="text-gray-400 text-xs">Car Rental Service</p>
                    </div>
                </div>
            </div>

            <div class="px-8 py-6 space-y-6">

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Ditagihkan Kepada</p>
                        <p class="font-bold text-gray-800">{{ $sewa->pelanggan->nama_pelanggan ?? '-' }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $sewa->pelanggan->no_hp ?? '-' }}</p>
                        <p class="text-sm text-gray-500">{{ $sewa->pelanggan->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Detail Kendaraan</p>
                        <p class="font-bold text-gray-800">{{ $sewa->kendaraan->nama_kendaraan ?? '-' }}</p>
                        <p class="text-sm text-gray-500 mt-1">No. Pol: {{ $sewa->nopol }}</p>
                        <p class="text-sm text-gray-500">{{ $sewa->kendaraan->transmisi ?? '-' }}</p>
                    </div>
                </div>

                <hr class="border-[#ECEAE3]">

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Detail Sewa</p>
                    <div class="bg-[#FAFAF8] rounded-xl overflow-hidden border border-[#ECEAE3]">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-[#F0EDE6] text-gray-600">
                                    <th class="px-4 py-3 text-left font-semibold">Keterangan</th>
                                    <th class="px-4 py-3 text-center font-semibold">Durasi</th>
                                    <th class="px-4 py-3 text-right font-semibold">Harga/Hari</th>
                                    <th class="px-4 py-3 text-right font-semibold">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#ECEAE3]">
                                <tr>
                                    <td class="px-4 py-3">
                                        <p class="font-medium text-gray-800">Sewa Kendaraan</p>
                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($sewa->tanggal_sewa)->format('d M Y') }}
                                            s/d {{ \Carbon\Carbon::parse($sewa->jadwal_kembali)->format('d M Y') }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-3 text-center text-gray-700">{{ $sewa->durasi }} hari</td>
                                    <td class="px-4 py-3 text-right text-gray-700">Rp {{ number_format($sewa->harga_sewa, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right text-gray-700">Rp {{ number_format($sewa->sub_total, 0, ',', '.') }}</td>
                                </tr>
                                @if($sewa->biaya_supir > 0)
                                <tr>
                                    <td class="px-4 py-3 text-gray-700">Biaya Supir</td>
                                    <td class="px-4 py-3 text-center">-</td>
                                    <td class="px-4 py-3 text-right">-</td>
                                    <td class="px-4 py-3 text-right text-gray-700">Rp {{ number_format($sewa->biaya_supir, 0, ',', '.') }}</td>
                                </tr>
                                @endif
                                @if($sewa->denda > 0)
                                <tr>
                                    <td class="px-4 py-3 text-red-500">Denda Keterlambatan</td>
                                    <td class="px-4 py-3 text-center">-</td>
                                    <td class="px-4 py-3 text-right">-</td>
                                    <td class="px-4 py-3 text-right text-red-500">Rp {{ number_format($sewa->denda, 0, ',', '.') }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="border-t-2 border-[#ECEAE3] px-4 py-3 bg-white">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($sewa->sub_total, 0, ',', '.') }}</span>
                            </div>
                            @if($sewa->denda > 0)
                            <div class="flex justify-between text-sm text-red-500 mb-1">
                                <span>Denda</span>
                                <span>+ Rp {{ number_format($sewa->denda, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between font-bold text-base text-[#1A1916] mt-2 pt-2 border-t border-[#ECEAE3]">
                                <span>TOTAL</span>
                                <span class="text-[#D97706]">Rp {{ number_format($sewa->harga_total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-[#ECEAE3]">

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Riwayat Pembayaran</p>
                    <div class="space-y-3">

                        @if($langsungLunas)
                        <div class="flex items-center justify-between bg-green-50 border border-green-100 rounded-xl px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                    <span class="text-green-600 font-bold text-xs">1</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 text-sm">Pembayaran Lunas</p>
                                    <p class="text-xs text-gray-500">ID: {{ $lunasPayment->order_id }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ strtoupper($lunasPayment->payment_type) }} •
                                        {{ \Carbon\Carbon::parse($lunasPayment->created_at)->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-700">Rp {{ number_format($lunasPayment->jumlah_bayar, 0, ',', '.') }}</p>
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-0.5 rounded-full mt-1">Lunas</span>
                            </div>
                        </div>

                    @else
                        @if($dpPayment)
                        <div class="flex items-center justify-between bg-blue-50 border border-blue-100 rounded-xl px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-600 font-bold text-xs">1</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 text-sm">Pembayaran DP</p>
                                    <p class="text-xs text-gray-500">ID: {{ $dpPayment->order_id }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ strtoupper($dpPayment->payment_type) }} •
                                        {{ \Carbon\Carbon::parse($dpPayment->created_at)->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-blue-700">Rp {{ number_format($dpPayment->jumlah_bayar, 0, ',', '.') }}</p>
                                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded-full mt-1">Terbayar</span>
                            </div>
                        </div>
                        @endif

                        @if($lunasPayment)
                        <div class="flex items-center justify-between bg-green-50 border border-green-100 rounded-xl px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                    <span class="text-green-600 font-bold text-xs">2</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 text-sm">Pelunasan</p>
                                    <p class="text-xs text-gray-500">ID: {{ $lunasPayment->order_id }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ strtoupper($lunasPayment->payment_type) }} •
                                        {{ \Carbon\Carbon::parse($lunasPayment->created_at)->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-700">Rp {{ number_format($lunasPayment->jumlah_bayar, 0, ',', '.') }}</p>
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-0.5 rounded-full mt-1">Lunas</span>
                            </div>
                        </div>
                        @endif

                        @if($dpPayment && !$lunasPayment)
                        <div class="flex items-center justify-between bg-orange-50 border border-orange-100 rounded-xl px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-orange-700 text-sm">Menunggu Pelunasan</p>
                                    <p class="text-xs text-orange-500">Belum dilunasi</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-orange-700">Rp {{ number_format($sewa->harga_total - $dpPayment->jumlah_bayar, 0, ',', '.') }}</p>
                                <span class="inline-block bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-0.5 rounded-full mt-1">Sisa Tagihan</span>
                            </div>
                        </div>
                        @endif

                    @endif

                    @if(!$dpPayment && !$lunasPayment)
                        <div class="text-center py-4 text-gray-400 text-sm">Belum ada pembayaran tercatat</div>
                    @endif
                </div>

                <div class="flex items-center justify-between bg-[#FAFAF8] rounded-xl px-4 py-3 border border-[#ECEAE3]">
                    <span class="text-sm text-gray-500">Status Sewa</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold
                        @if($sewa->status == 'lunas') bg-green-100 text-green-700
                        @elseif($sewa->status == 'dp') bg-blue-100 text-blue-700
                        @elseif($sewa->status == 'selesai') bg-orange-100 text-orange-700
                        @elseif($sewa->status == 'batal') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ strtoupper($sewa->status) }}
                    </span>
                </div>

                <div class="text-center text-xs text-gray-400 pt-2">
                    <p>Dokumen ini digenerate otomatis oleh sistem PT Adeevaindo Trans Utama</p>
                    <p class="mt-1">Terima kasih telah menggunakan layanan kami</p>
                </div>

            </div>
        </div>
    </div>
</div>
</x-user>