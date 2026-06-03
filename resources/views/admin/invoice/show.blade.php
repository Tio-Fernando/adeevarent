<x-app-layout>
<div class="min-h-screen bg-[#FAFAF8] py-10 px-4">
    <div class="max-w-6xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#D97706] transition text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
            <a href="{{ route('admin.invoice.download', $sewa->id_tr_sewa) }}"
               class="inline-flex items-center gap-2 bg-[#D97706] hover:bg-[#B45309] text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download PDF
            </a>
        </div>

        <div class="grid grid-cols-3 gap-6">
            <!-- Informasi Pelanggan -->
            <div class="bg-white rounded-2xl border border-[#E8E6E0] shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">Data Pelanggan</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Nama</p>
                        <p class="font-medium text-gray-800">{{ $sewa->pelanggan->nama_pelanggan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">No. HP</p>
                        <p class="font-medium text-gray-800">{{ $sewa->pelanggan->no_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Alamat</p>
                        <p class="font-medium text-gray-800 text-sm">{{ $sewa->pelanggan->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Kendaraan -->
            <div class="bg-white rounded-2xl border border-[#E8E6E0] shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">Detail Kendaraan</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Kendaraan</p>
                        <p class="font-medium text-gray-800">{{ $sewa->kendaraan->nama_kendaraan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">No. Polisi</p>
                        <p class="font-medium text-gray-800">{{ $sewa->nopol }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase mb-1">Transmisi</p>
                        <p class="font-medium text-gray-800">{{ $sewa->kendaraan->transmisi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Invoice Info -->
            <div class="bg-gradient-to-br from-[#D97706] to-[#B45309] rounded-2xl shadow-sm p-6 text-white">
                <h3 class="text-sm font-semibold uppercase tracking-wide mb-4 opacity-90">Invoice</h3>
                <div class="space-y-2">
                    <p class="text-3xl font-bold">#{{ $invoice }}</p>
                    <p class="text-sm opacity-90">Diterbitkan: {{ \Carbon\Carbon::parse($sewa->created_at)->format('d F Y') }}</p>
                    <div class="pt-2 border-t border-white border-opacity-30">
                        <p class="text-xs uppercase opacity-75 mb-1">Status</p>
                        <span class="inline-block bg-white text-[#D97706] text-xs font-semibold px-3 py-1 rounded-full">
                            {{ ucfirst($sewa->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Sewa -->
        <div class="bg-white rounded-2xl border border-[#E8E6E0] shadow-sm p-6 mt-6">
            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">Detail Sewa</h3>
            <div class="overflow-x-auto">
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

                <div class="border-t-2 border-[#ECEAE3] px-4 py-3 bg-[#FAFAF8] rounded-b-xl mt-3">
                    <div class="flex justify-end items-center space-x-6">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Subtotal</p>
                            <p class="font-semibold text-gray-800">Rp {{ number_format($sewa->sub_total, 0, ',', '.') }}</p>
                        </div>
                        @if($sewa->denda > 0)
                        <div>
                            <p class="text-sm text-red-600 mb-2">Denda</p>
                            <p class="font-semibold text-red-600">+ Rp {{ number_format($sewa->denda, 0, ',', '.') }}</p>
                        </div>
                        @endif
                        <div class="pl-6 border-l-2 border-[#ECEAE3]">
                            <p class="text-xs text-gray-600 uppercase mb-2">TOTAL</p>
                            <p class="text-2xl font-bold text-[#D97706]">Rp {{ number_format($sewa->harga_total, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pembayaran -->
        <div class="bg-white rounded-2xl border border-[#E8E6E0] shadow-sm p-6 mt-6">
            <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">Riwayat Pembayaran</h3>
            <div class="space-y-3">
                @if($langsungLunas)
                <div class="flex items-center justify-between bg-green-50 border border-green-100 rounded-xl px-4 py-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></path></svg>
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
                                <p class="font-semibold text-gray-800 text-sm">Menunggu Pelunasan</p>
                                <p class="text-xs text-gray-500">Pembayaran DP sudah diterima</p>
                                <p class="text-xs text-gray-500">
                                    Sisa: Rp {{ number_format($sewa->harga_total - $dpPayment->jumlah_bayar, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <span class="inline-block bg-orange-100 text-orange-700 text-xs font-semibold px-2 py-0.5 rounded-full">Pending</span>
                    </div>
                    @endif
                @endif
            </div>
        </div>

    </div>
</div>
</x-app-layout>
