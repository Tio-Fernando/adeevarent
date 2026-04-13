<x-user>
    <div class="min-h-screen bg-[#FAFAF8] py-10 px-4 text-[#1A1916] font-sans">
        {{-- Header Section --}}
        <div class="max-w-7xl mx-auto mb-9">
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center text-gray-500 hover:text-[#D97706] transition-colors duration-200 group">
                    <svg class="w-6 h-6 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div class="flex items-center gap-3">
                    <div>
                        <h1 class="font-['Poppins'] text-2xl md:text-[26px] font-bold text-[#1A1916] tracking-tight leading-tight">Rental History</h1>
                        <p class="text-[13px] text-[#8C8882] mt-1">Complete list of all your car rental bookings.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-[20px] border border-[#E8E6E0] shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="p-8 border-b border-[#ECEAE3]">
                    <h2 class="text-lg font-bold text-[#1A1916]">Rental History</h2>
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
                        
                        $tgl_sewa = \Carbon\Carbon::parse($sewa->tgl_sewa);
                        $jadwal_kembali = \Carbon\Carbon::parse($sewa->jadwal_kembali);
                        $durasi = $sewa->durasi ?? $jadwal_kembali->diffInDays($tgl_sewa) ?: 1;
                        
                        $payment = $sewa->payments()->latest()->first();
                        $payment_type = $payment ? $payment->payment_type : 'Belum ditentukan';

                        $payment_labels = [
                            'qris' => 'QRIS',
                            'bank_transfer' => 'Transfer Bank',
                            'cash' => 'Cash',
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
                    
                    {{-- Tabel Header (hanya di item pertama) --}}
                    @if($loop->first)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b border-[#ECEAE3]">
                                    <th class="px-6 py-4 text-left font-bold text-[#1A1916]">Kendaraan</th>
                                    <th class="px-6 py-4 text-left font-bold text-[#1A1916]">Tanggal Sewa - Kembali</th>
                                    <th class="px-6 py-4 text-center font-bold text-[#1A1916]">Durasi</th>
                                    <th class="px-6 py-4 text-left font-bold text-[#1A1916]">Opsi Layanan</th>
                                    <th class="px-6 py-4 text-left font-bold text-[#1A1916]">Tipe Pembayaran</th>
                                    <th class="px-6 py-4 text-right font-bold text-[#1A1916]">Harga Total</th>
                                    <th class="px-6 py-4 text-center font-bold text-[#1A1916]">Status</th>
                                    <th class="px-6 py-4 text-center font-bold text-[#1A1916]">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                    @endif
                            <tr class="border-b border-[#ECEAE3] hover:bg-[#F7F6F2] transition-colors">
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
                                <td class="px-6 py-4 text-right text-[#1A1916] font-bold">Rp. {{ number_format($sewa->harga_total, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($lunas)
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
                                    @elseif($cashPaymentPending)
                                        <div class="space-y-2">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200 block">
                                                Menunggu Konfirmasi Admin
                                            </span>
                                            <div class="text-xs text-gray-600 font-medium">
                                                Cash Payment
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
                                <td class="px-6 py-4 text-center">
                                    @if($lunas)
                                        <span class="text-xs text-gray-400 font-medium">-</span>
                                    @elseif($dp)
                                        <a href="{{ route('pelunasan', $sewa->id) }}" class="inline-flex items-center gap-2 bg-[#D97706] hover:bg-[#B45309] text-white px-4 py-1.5 rounded-lg font-semibold text-xs transition-colors duration-200 shadow-sm hover:shadow-md whitespace-nowrap">                                            Lunasi
                                        </a>
                                    @elseif($cashPaymentPending)
                                        <span class="text-xs text-gray-400 font-medium">Menunggu</span>
                                    @elseif(!$paymentExists)
                                        <a href="{{ route('payment', $sewa->id) }}" class="inline-flex items-center gap-2 bg-[#1A1916] hover:bg-black text-white px-4 py-1.5 rounded-lg font-semibold text-xs transition-colors duration-200 shadow-sm hover:shadow-md whitespace-nowrap">
                                            Selesaikan Pembayaran
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400 font-medium">-</span>
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
                        <p class="text-gray-400 text-sm font-medium">No rental history yet.</p>
                        <p class="text-gray-300 text-xs mt-2">Start booking a vehicle now!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-user>
