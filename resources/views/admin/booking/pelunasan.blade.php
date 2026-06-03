<x-app-layout>
<div class="min-h-screen bg-[#F8FAFC] py-8 px-4 font-sans">
    <div class="max-w-6xl mx-auto">

        <div class="mb-8">
            <a href="{{ route('booking.index') }}" class="group inline-flex items-center text-gray-500 hover:text-orange-500 transition-all mb-6 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-semibold text-sm">Kembali ke Daftar Booking</span>
            </a>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Pelunasan Booking</h1>
            <p class="text-gray-500 mt-2 text-sm">Proses pelunasan sisa tagihan untuk pelanggan.</p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">

            <div id="payment-content-area" class="xl:col-span-7 space-y-6">

                <label class="method-card group block bg-white p-6 rounded-[2rem] border-2 border-orange-500 shadow-lg shadow-orange-500/10 cursor-pointer transition-all hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-60"></div>
                    <input type="radio" name="payment_method" value="qris" class="hidden method-radio" checked>
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex items-center gap-5">
                            <div class="bg-gradient-to-br from-orange-100 to-orange-50 p-4 rounded-2xl border border-orange-100/50">
                                <img src="https://img.icons8.com/color/48/qr-code.png" class="w-8 h-8" alt="QRIS">
                            </div>
                            <div>
                                <h4 class="font-extrabold text-gray-900 text-lg uppercase">QRIS</h4>
                                <p class="text-xs text-gray-500 mt-1">Gopay, OVO, Dana, LinkAja, ShopeePay</p>
                            </div>
                        </div>
                        <div class="circle-outer w-7 h-7 rounded-full border-[3px] border-orange-500 flex items-center justify-center">
                            <div class="circle-inner w-3.5 h-3.5 bg-orange-500 rounded-full opacity-100"></div>
                        </div>
                    </div>
                </label>

                <div class="method-card bg-white p-6 rounded-[2rem] border-2 border-gray-100 shadow-sm transition-all hover:shadow-md relative overflow-hidden">
                    <label class="flex items-center justify-between cursor-pointer mb-6 group">
                        <input type="radio" name="payment_method" value="bank_transfer" id="method_bank" class="hidden method-radio">
                        <div class="flex items-center gap-5 relative z-10">
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <img src="https://img.icons8.com/fluency/48/bank.png" class="w-8 h-8 grayscale group-hover:grayscale-0 transition-all" alt="Bank">
                            </div>
                            <div>
                                <h4 class="font-extrabold text-gray-900 text-lg">Transfer Bank (VA)</h4>
                                <p class="text-xs text-gray-500 mt-1">Bayar via ATM atau Mobile Banking</p>
                            </div>
                        </div>
                        <div class="circle-outer w-7 h-7 rounded-full border-[3px] border-gray-200 flex items-center justify-center">
                            <div class="circle-inner w-3.5 h-3.5 bg-orange-500 rounded-full opacity-0"></div>
                        </div>
                    </label>
                    <div class="flex flex-wrap gap-3 pl-0 md:pl-20">
                        @foreach(['bca','mandiri','bni','bri'] as $bank)
                            <label class="cursor-pointer">
                                <input type="radio" name="bank_code" value="{{ $bank }}" class="hidden peer bank-selector" {{ $bank == 'bca' ? 'checked' : '' }}>
                                <div class="bg-white border-2 border-gray-100 text-gray-400 font-bold px-6 py-3 rounded-xl uppercase text-xs transition-all hover:border-gray-300 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-600">
                                    {{ $bank }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <label class="method-card group block bg-white p-6 rounded-[2rem] border-2 border-gray-100 shadow-sm cursor-pointer transition-all hover:border-orange-500 relative overflow-hidden">
                    <input type="radio" name="payment_method" value="cash" class="hidden method-radio">
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex items-center gap-5">
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <img src="https://img.icons8.com/fluency/48/money-box.png" class="w-8 h-8 grayscale group-hover:grayscale-0" alt="Cash">
                            </div>
                            <div>
                                <h4 class="font-extrabold text-gray-900 text-lg uppercase">Bayar di Tempat (Cash)</h4>
                                <p class="text-xs text-gray-500 mt-1">Bayar langsung saat pengambilan unit.</p>
                            </div>
                        </div>
                        <div class="circle-outer w-7 h-7 rounded-full border-[3px] border-gray-200 flex items-center justify-center">
                            <div class="circle-inner w-3.5 h-3.5 bg-orange-500 rounded-full opacity-0"></div>
                        </div>
                    </div>
                </label>

            </div>

            <div class="xl:col-span-5">
                <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 sticky top-24 overflow-hidden flex flex-col">

                    <div class="bg-gray-900 p-6 text-white">
                        <h3 class="font-black text-xl tracking-tight mb-1">Ringkasan Pelunasan</h3>
                        <p class="text-gray-400 text-xs uppercase tracking-widest">ORDER ID: #{{ $payment->order_id }}</p>
                    </div>

                    <div class="p-6">
                        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 mb-6">
                            <p class="text-xs font-bold text-blue-500 uppercase tracking-widest mb-1">Pelanggan</p>
                            <p class="font-bold text-gray-800">{{ $sewa->pelanggan->nama_pelanggan ?? '-' }}</p>
                            <p class="text-xs text-gray-500">{{ $sewa->pelanggan->no_hp ?? '-' }}</p>
                        </div>

                        <div class="flex items-center gap-4 mb-6 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <div class="w-20 h-14 bg-white rounded-xl shadow-sm p-1 flex items-center justify-center overflow-hidden shrink-0">
                                <img src="{{ asset('storage/' . $sewa->kendaraan->dir) }}" class="w-full h-full object-contain">
                            </div>
                            <div>
                                <h3 class="font-extrabold text-gray-900 text-base leading-tight">{{ $sewa->kendaraan->nama_kendaraan }}</h3>
                                <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-1 rounded-md uppercase">{{ $sewa->jenis_sewa }}</span>
                            </div>
                        </div>

                        {{-- Rincian --}}
                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Total Harga Sewa</span>
                                <span class="font-bold text-gray-900">Rp {{ number_format($sewa->harga_total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>DP Terbayar</span>
                                <span class="font-black text-emerald-500">- Rp {{ number_format($sewa->dp, 0, ',', '.') }}</span>
                            </div>
                            <hr class="border-dashed border-gray-200">
                        </div>
                    </div>

                    <div class="p-6 bg-orange-50/30 border-t-2 border-dashed border-gray-200">
                        <div class="flex justify-between items-end mb-6">
                            <div>
                                <p class="text-xs font-black text-orange-500 uppercase tracking-widest mb-1">Tagihan Akhir</p>
                                <p class="text-gray-500 text-[10px] font-semibold uppercase">Sisa yang harus dilunasi</p>
                            </div>
                            <h2 class="text-3xl font-black text-orange-600">
                                Rp {{ number_format($sewa->sisa_tagihan, 0, ',', '.') }}
                            </h2>
                        </div>

                        <button id="btn-pay-now"
                            class="group relative w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-black py-4 rounded-2xl shadow-xl shadow-orange-500/30 transition-all hover:-translate-y-1 text-sm uppercase tracking-widest overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                Proses Pelunasan
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const methodRadios = document.querySelectorAll('.method-radio');

    function updateUIMethods() {
        methodRadios.forEach(radio => {
            const card = radio.closest('.method-card');
            const outerCircle = card.querySelector('.circle-outer');
            const innerCircle = card.querySelector('.circle-inner');
            const icon = card.querySelector('img');

            if (radio.checked) {
                card.classList.add('border-orange-500', 'shadow-lg', 'shadow-orange-500/10');
                card.classList.remove('border-gray-100');
                outerCircle.classList.add('border-orange-500');
                outerCircle.classList.remove('border-gray-200');
                innerCircle.classList.remove('opacity-0');
                innerCircle.classList.add('opacity-100');
                if (icon?.classList.contains('grayscale')) icon.classList.remove('grayscale');
            } else {
                card.classList.remove('border-orange-500', 'shadow-lg', 'shadow-orange-500/10');
                card.classList.add('border-gray-100');
                outerCircle.classList.remove('border-orange-500');
                outerCircle.classList.add('border-gray-200');
                innerCircle.classList.add('opacity-0');
                innerCircle.classList.remove('opacity-100');
                if (radio.value === 'bank_transfer') icon?.classList.add('grayscale');
            }
        });
    }

    methodRadios.forEach(r => r.addEventListener('change', updateUIMethods));
    document.querySelectorAll('.bank-selector').forEach(b => b.addEventListener('change', () => {
        document.getElementById('method_bank').checked = true;
        updateUIMethods();
    }));
    updateUIMethods();

    document.getElementById('btn-pay-now').addEventListener('click', function () {
        const btn = this;
        const method = document.querySelector('input[name="payment_method"]:checked').value;
        const bankCode = document.querySelector('input[name="bank_code"]:checked')?.value ?? 'bca';

        btn.disabled = true;
        btn.innerHTML = `<span class="relative z-10 flex items-center justify-center gap-2"><svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Memproses...</span>`;

        fetch("{{ route('booking.charge', $sewa->id_tr_sewa) }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ payment_type: method, bank: bankCode })
        })
        .then(res => res.json())
        .then(data => {
            const area = document.getElementById('payment-content-area');

            if (method === 'cash') {
                area.innerHTML = `
                    <div class="bg-white p-8 rounded-[2rem] shadow-2xl border-2 border-orange-500 text-center animate-fade-in">
                        <h3 class="text-2xl font-black text-gray-900 mb-4 uppercase">Pelunasan Cash</h3>
                        <p class="text-sm text-gray-500 mb-6">Pelanggan akan melakukan pelunasan langsung di kantor.</p>
                        <div class="bg-orange-50 p-6 rounded-2xl border border-orange-100 relative z-10">
                                        <p class="text-orange-600 font-bold uppercase tracking-widest text-xs mb-1">ID Pesanan:</p>
                                        <p class="text-orange-600 font-black text-xl md:text-2xl tracking-tight">
                                            {{ $invoice }}
                                        </p>
                                    </div>
                        <a href="{{ route('booking.index') }}" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-gray-800 transition">
                            Kembali ke Daftar Booking
                        </a>
                    </div>`;
                return;
            }

            if (method === 'qris') {
                const qrString = data?.qr_string || '';
                if (!qrString) { 
                    console.error('QRIS Response:', data);
                    alert('Gagal mendapatkan QR Code'); 
                    btn.disabled = false; 
                    return; 
                }
                
                const encodedQR = encodeURIComponent(qrString);
                const qrImageUrl = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodedQR}`;
                
                area.innerHTML = `
                    <div class="bg-white p-8 rounded-[2rem] shadow-2xl border-2 border-orange-500 text-center animate-fade-in">
                        <h3 class="text-2xl font-black text-gray-900 mb-2 uppercase">Scan QRIS Pelunasan</h3>
                        <p class="text-sm text-gray-500 mb-6">Arahkan kamera E-Wallet ke QR Code di bawah.</p>
                        <div class="bg-white p-4 inline-block rounded-[2rem] shadow-xl border border-orange-100">
                            <img src="${qrImageUrl}" class="w-64 h-64 object-contain" alt="QRIS QR Code" onerror="this.style.display='none'; document.getElementById('qr-fallback-${Date.now()}').style.display='block';">
                        </div>
                        <div id="qr-fallback-${Date.now()}" style="display:none;" class="text-red-500 text-sm font-bold p-4">
                            QR Code gagal dimuat. Silakan refresh halaman.
                        </div>
                        <div class="mt-6 p-4 bg-orange-50 rounded-2xl text-orange-600 text-sm font-bold uppercase border border-orange-100">
                            Selesaikan pembayaran dalam 15 menit
                        </div>
                    </div>`;
            }
                           else if(method === 'bank_transfer') {
    if(bankCode === 'mandiri') {

        const billKey = data?.mandiri?.bill_key;
        const billerCode = data?.mandiri?.biller_code;

        if(!billKey || !billerCode){
            alert('Error: Bill Mandiri tidak tergenerate');
            btn.disabled = false;
            btn.innerHTML = `<span class="relative z-10">Bayar Sekarang</span>`;
            return;
        }

        area.innerHTML = `
        <div class="flex justify-center items-center h-full">
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-2xl border-2 border-orange-500 animate-fade-in text-center w-full max-w-lg relative overflow-hidden">

                <h3 class="text-2xl font-black text-gray-900 mb-8 uppercase tracking-tighter">
                    Mandiri Bill Payment
                </h3>

                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 mb-4">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">
                        Biller Code
                    </p>
                    <p class="text-3xl font-black text-orange-600">
                        ${billerCode}
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">
                        Bill Key
                    </p>

                    <p class="text-3xl font-black text-orange-600 break-all">
                        ${billKey}
                    </p>
                </div>

                <button
                    onclick="navigator.clipboard.writeText('${billKey}')"
                    class="mt-8 w-full bg-gray-900 text-white px-6 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-gray-800 transition-colors"
                >
                    Salin Bill Key
                </button>
            </div>
        </div>
        `;

    } else {

        // VA BIASA
        if(!data.va_numbers || !data.va_numbers[0] || !data.va_numbers[0].va_number) {
            alert('Error: Nomor VA tidak tergenerate');
            btn.disabled = false;
            btn.innerHTML = `<span class="relative z-10">Bayar Sekarang</span>`;
            return;
        }

        const vaNumber = data.va_numbers[0].va_number;

        area.innerHTML = `
        <div class="flex justify-center items-center h-full">
            <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-2xl border-2 border-orange-500 animate-fade-in text-center w-full max-w-lg relative overflow-hidden">

                <h3 class="text-2xl font-black text-gray-900 mb-8 uppercase tracking-tighter">
                    Virtual Account ${bankCode.toUpperCase()}
                </h3>

                <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">
                        Nomor Pembayaran
                    </p>

                    <p class="text-3xl md:text-4xl font-black text-orange-600 tracking-tighter">
                        ${vaNumber}
                    </p>
                </div>

                <button
                    onclick="navigator.clipboard.writeText('${vaNumber}')"
                    class="mt-8 w-full bg-gray-900 text-white px-6 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-gray-800 transition-colors"
                >
                    Salin Nomor VA
                </button>
            </div>
        </div>
        `;
    }
}

            btn.parentElement.classList.add('opacity-50', 'pointer-events-none');
            btn.innerHTML = `<span class="relative z-10">Menunggu Pembayaran...</span>`;

            mulaiCekOtomatis();
        })
        .catch(() => {
            alert("Gagal memproses. Coba lagi.");
            btn.disabled = false;
            btn.innerHTML = `<span class="relative z-10 flex items-center justify-center gap-2">Proses Pelunasan <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></span>`;
        });
    });

    function mulaiCekOtomatis() {
        const intervalCek = setInterval(() => {
            fetch("{{ route('booking.status', $sewa->id_tr_sewa) }}")
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'lunas') {
                        clearInterval(intervalCek);
                        Swal.fire({
                            title: 'Pelunasan Berhasil!',
                            text: 'Booking telah lunas total.',
                            icon: 'success',
                            confirmButtonColor: '#F97316'
                        }).then(() => {
                            window.location.href = "{{ route('booking.index') }}";
                        });
                    }
                });
        }, 5000);
    }
</script>

<style>
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
</x-app-layout>