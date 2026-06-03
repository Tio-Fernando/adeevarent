<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #1A1916; background: #fff; }
        .header { background: #1A1916; color: white; padding: 24px 32px; }
        .header-flex { display: flex; justify-content: space-between; align-items: flex-start; }
        .invoice-title { font-size: 24px; font-weight: 700; }
        .invoice-no { color: #D97706; font-size: 16px; font-weight: 700; margin-top: 4px; }
        .company-name { font-size: 14px; font-weight: 700; text-align: right; }
        .company-sub { color: #9CA3AF; font-size: 11px; text-align: right; margin-top: 2px; }
        .body { padding: 24px 32px; }
        .section-title { font-size: 10px; font-weight: 700; color: #9CA3AF; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
        .info-grid { display: flex; gap: 24px; margin-bottom: 20px; }
        .info-col { flex: 1; }
        .info-name { font-weight: 700; font-size: 13px; }
        .info-sub { color: #6B7280; font-size: 11px; margin-top: 2px; }
        hr { border: none; border-top: 1px solid #E5E7EB; margin: 16px 0; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #F3F4F6; }
        th { padding: 8px 12px; text-align: left; font-size: 11px; font-weight: 600; color: #4B5563; }
        th.right { text-align: right; }
        th.center { text-align: center; }
        td { padding: 8px 12px; font-size: 11px; border-bottom: 1px solid #F3F4F6; color: #374151; }
        td.right { text-align: right; }
        td.center { text-align: center; }
        .total-row { background: #FEF3C7; }
        .total-label { font-weight: 700; font-size: 12px; }
        .total-amount { font-weight: 700; font-size: 13px; color: #D97706; text-align: right; }
        .payment-box { border: 1px solid #E5E7EB; border-radius: 8px; padding: 10px 14px; margin-bottom: 8px; display: flex; justify-content: space-between; align-items: center; }
        .payment-box.dp { background: #EFF6FF; border-color: #BFDBFE; }
        .payment-box.lunas { background: #F0FDF4; border-color: #BBF7D0; }
        .pay-label { font-weight: 700; font-size: 12px; }
        .pay-id { color: #6B7280; font-size: 10px; margin-top: 2px; }
        .pay-amount { font-weight: 700; font-size: 13px; }
        .dp .pay-amount { color: #1D4ED8; }
        .lunas .pay-amount { color: #16A34A; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 9999px; font-size: 10px; font-weight: 700; margin-top: 4px; }
        .badge-dp { background: #DBEAFE; color: #1D4ED8; }
        .badge-lunas { background: #DCFCE7; color: #16A34A; }
        .footer-note { text-align: center; color: #9CA3AF; font-size: 10px; margin-top: 24px; padding-top: 16px; border-top: 1px solid #E5E7EB; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-flex">
            <div>
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-no">#{{ $invoice }}</div>
                <div style="color:#9CA3AF;font-size:10px;margin-top:4px;">
                    Diterbitkan: {{ \Carbon\Carbon::parse($sewa->created_at)->format('d F Y') }}
                </div>
            </div>
            <div>
                <div class="company-name">PT Adeevaindo</div>
                <div class="company-sub">Trans Utama</div>
                <div class="company-sub">Car Rental Service</div>
            </div>
        </div>
    </div>

    <div class="body">
        <div class="info-grid">
            <div class="info-col">
                <div class="section-title">Ditagihkan Kepada</div>
                <div class="info-name">{{ $sewa->pelanggan->nama_pelanggan ?? '-' }}</div>
                <div class="info-sub">{{ $sewa->pelanggan->no_hp ?? '-' }}</div>
                <div class="info-sub">{{ $sewa->pelanggan->alamat ?? '-' }}</div>
            </div>
            <div class="info-col">
                <div class="section-title">Detail Kendaraan</div>
                <div class="info-name">{{ $sewa->kendaraan->nama_kendaraan ?? '-' }}</div>
                <div class="info-sub">No. Pol: {{ $sewa->nopol }}</div>
                <div class="info-sub">{{ $sewa->kendaraan->transmisi ?? '-' }}</div>
            </div>
        </div>

        <hr>

        <div class="section-title">Detail Sewa</div>
        <table>
            <thead>
                <tr>
                    <th>Keterangan</th>
                    <th class="center">Durasi</th>
                    <th class="right">Harga/Hari</th>
                    <th class="right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Sewa Kendaraan<br>
                        <span style="color:#9CA3AF;font-size:10px;">
                            {{ \Carbon\Carbon::parse($sewa->tanggal_sewa)->format('d M Y') }}
                            s/d {{ \Carbon\Carbon::parse($sewa->tanggal_kembali)->format('d M Y') }}
                        </span>
                    </td>
                    <td class="center">{{ $sewa->durasi }} hari</td>
                    <td class="right">Rp {{ number_format($sewa->harga_sewa, 0, ',', '.') }}</td>
                    <td class="right">Rp {{ number_format($sewa->sub_total, 0, ',', '.') }}</td>
                </tr>
                @if($sewa->biaya_supir > 0)
                <tr>
                    <td>Biaya Supir</td>
                    <td class="center">-</td>
                    <td class="right">-</td>
                    <td class="right">Rp {{ number_format($sewa->biaya_supir, 0, ',', '.') }}</td>
                </tr>
                @endif
                @if($sewa->denda > 0)
                <tr>
                    <td style="color:#EF4444;">Denda Keterlambatan</td>
                    <td class="center">-</td>
                    <td class="right">-</td>
                    <td class="right" style="color:#EF4444;">Rp {{ number_format($sewa->denda, 0, ',', '.') }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td colspan="3" class="total-label">TOTAL</td>
                    <td class="total-amount">Rp {{ number_format($sewa->harga_total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <hr>

        <div class="section-title" style="margin-top:16px;">Riwayat Pembayaran</div>

        @if($dpPayment)
        <div class="payment-box dp">
            <div>
                <div class="pay-label">Pembayaran DP</div>
                <div class="pay-id">ID: {{ $dpPayment->order_id }}</div>
                <div class="pay-id">{{ strtoupper($dpPayment->payment_type) }} • {{ \Carbon\Carbon::parse($dpPayment->created_at)->format('d M Y, H:i') }}</div>
                <span class="badge badge-dp">Terbayar</span>
            </div>
            <div class="pay-amount">Rp {{ number_format($dpPayment->jumlah_bayar, 0, ',', '.') }}</div>
        </div>
        @endif

        @if($lunasPayment)
        <div class="payment-box lunas">
            <div>
                <div class="pay-label">Pelunasan</div>
                <div class="pay-id">ID: {{ $lunasPayment->order_id }}</div>
                <div class="pay-id">{{ strtoupper($lunasPayment->payment_type) }} • {{ \Carbon\Carbon::parse($lunasPayment->created_at)->format('d M Y, H:i') }}</div>
                <span class="badge badge-lunas">Terbayar</span>
            </div>
            <div class="pay-amount">Rp {{ number_format($lunasPayment->jumlah_bayar, 0, ',', '.') }}</div>
        </div>
        @endif

        <div class="footer-note">
            Dokumen ini digenerate otomatis oleh sistem PT Adeevaindo Trans Utama<br>
            Terima kasih telah menggunakan layanan kami
        </div>
    </div>
</body>
</html>