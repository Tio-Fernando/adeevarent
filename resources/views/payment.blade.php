<x-user>
    <div class="min-h-screen bg-[#F8FAFC] py-8 md:py-12 px-4 sm:px-6 lg:px-8 font-sans selection:bg-orange-100 selection:text-orange-900">
        <div class="max-w-6xl mx-auto">
            
            <!-- Header & Back Button -->
            <div class="mb-8 md:mb-12">
                <a href="{{ url()->previous() }}" class="group inline-flex items-center text-gray-500 hover:text-orange-500 transition-all duration-300 mb-6 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100 hover:shadow-md">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="font-semibold text-sm">Kembali</span>
                </a>
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Metode Pembayaran</h1>
                <p class="text-gray-500 mt-2 text-sm md:text-base font-medium">Pilih metode pembayaran yang paling nyaman untuk Anda.</p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 lg:gap-12">
            
                <div id="payment-content-area" class="xl:col-span-7 space-y-6">
              
                    <label class="method-card group block bg-white p-6 md:p-8 rounded-[2rem] border-2 border-orange-500 shadow-lg shadow-orange-500/10 cursor-pointer transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                    
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-60"></div>
                        
                        <input type="radio" name="payment_method" value="qris" id="method_qris" class="hidden method-radio" checked>
                        <div class="flex items-center justify-between relative z-10">
                            <div class="flex items-center gap-5 md:gap-6">
                                <div class="bg-gradient-to-br from-orange-100 to-orange-50 p-4 rounded-2xl shadow-inner border border-orange-100/50">
                                    <img src="https://img.icons8.com/color/48/qr-code.png" class="w-8 h-8 md:w-10 md:h-10 transform group-hover:scale-110 transition-transform duration-300" alt="QRIS">
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-gray-900 text-lg md:text-xl tracking-tight uppercase">QRIS</h4>
                                    <p class="text-xs md:text-sm text-gray-500 font-medium mt-1">Gopay, OVO, Dana, LinkAja, ShopeePay</p>
                                </div>
                            </div>
                            <!-- Lingkaran Indikator -->
                            <div class="circle-outer w-7 h-7 rounded-full border-[3px] border-orange-500 flex items-center justify-center transition-colors shadow-sm">
                                <div class="circle-inner w-3.5 h-3.5 bg-orange-500 rounded-full opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </label>

                    <!-- 2. TRANSFER BANK -->
                    <div class="method-card bg-white p-6 md:p-8 rounded-[2rem] border-2 border-gray-100 shadow-sm transition-all duration-300 hover:border-gray-200 hover:shadow-md relative overflow-hidden">
                        <label class="flex items-center justify-between cursor-pointer mb-6 group">
                            <input type="radio" name="payment_method" value="bank_transfer" id="method_bank" class="hidden method-radio">
                            <div class="flex items-center gap-5 md:gap-6 relative z-10">
                                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 group-hover:bg-gray-100 transition-colors">
                                    <img src="https://img.icons8.com/fluency/48/bank.png" class="w-8 h-8 md:w-10 md:h-10 grayscale group-hover:grayscale-0 transition-all duration-500" alt="Bank">
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-gray-900 text-lg md:text-xl tracking-tight">Transfer Bank (VA)</h4>
                                    <p class="text-xs md:text-sm text-gray-500 font-medium mt-1">Bayar via ATM atau Mobile Banking</p>
                                </div>
                            </div>
                            <!-- Lingkaran Indikator -->
                            <div class="circle-outer w-7 h-7 rounded-full border-[3px] border-gray-200 flex items-center justify-center transition-colors">
                                <div class="circle-inner w-3.5 h-3.5 bg-orange-500 rounded-full opacity-0 transition-opacity"></div>
                            </div>
                        </label>

                        <!-- Pilihan Bank (Interaktif) -->
                        <div class="flex flex-wrap gap-3 pl-0 md:pl-20 mt-2">
                            @foreach(['bca', 'mandiri', 'bni', 'bri'] as $bank)
                                <label class="cursor-pointer flex-1 sm:flex-none">
                                    <input type="radio" name="bank_code" value="{{ $bank }}" class="hidden peer bank-selector" {{ $bank == 'bca' ? 'checked' : '' }}>
                                    <div class="bg-white border-2 border-gray-100 text-gray-400 font-bold px-6 py-3 rounded-xl uppercase tracking-widest text-center text-xs md:text-sm transition-all duration-300 
                                                hover:border-gray-300 hover:bg-gray-50 
                                                peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-600 peer-checked:shadow-sm">
                                        {{ $bank }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <label class="method-card group block bg-white p-6 md:p-8 rounded-[2rem] border-2 border-gray-100 shadow-sm cursor-pointer transition-all duration-300 hover:border-orange-500 relative overflow-hidden">
                    <input type="radio" name="payment_method" value="cash" class="hidden method-radio">
                    <div class="flex items-center justify-between relative z-10">
                        <div class="flex items-center gap-5 md:gap-6">
                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <img src="https://img.icons8.com/fluency/48/money-box.png" class="w-8 h-8 md:w-10 md:h-10 grayscale group-hover:grayscale-0" alt="Cash">
                            </div>
                            <div>
                                <h4 class="font-extrabold text-gray-900 text-lg md:text-xl tracking-tight uppercase">Bayar di Tempat (Cash)</h4>
                                <p class="text-xs md:text-sm text-gray-500 font-medium mt-1">Bayar langsung di kantor saat pengambilan unit.</p>
                            </div>
                        </div>
                        <div class="circle-outer w-7 h-7 rounded-full border-[3px] border-gray-200 flex items-center justify-center">
                            <div class="circle-inner w-3.5 h-3.5 bg-orange-500 rounded-full opacity-0"></div>
                        </div>
                    </div>
                </label>
                </div>
                

             
                <div class="xl:col-span-5">
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 sticky top-24 overflow-hidden flex flex-col">
                        
                        <!-- Header Card -->
                        <div class="bg-gray-900 p-6 md:p-8 text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl transform translate-x-10 -translate-y-10"></div>
                            <h3 class="font-black text-xl tracking-tight mb-1 relative z-10">Ringkasan Pesanan</h3>
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-widest relative z-10">ID: #{{ strtoupper(Str::random(8)) }}</p>
                        </div>
                        
                        <div class="p-6 md:p-8">
                            <!-- Mobil Info -->
                            <div class="flex items-center gap-5 mb-8 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <div class="w-20 h-14 bg-white rounded-xl shadow-sm p-1 flex items-center justify-center overflow-hidden shrink-0">
                                    <img src="{{ asset('storage/' . $sewa->kendaraan->dir) }}" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-gray-900 text-lg leading-tight truncate">{{ $sewa->kendaraan->nama_kendaraan }}</h3>
                                    <div class="flex items-center gap-2 mt-1.5">
                                        <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">
                                            {{ $sewa->jenis_sewa }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Waktu Sewa -->
                            <div class="flex items-center justify-between bg-gray-50/50 p-4 rounded-2xl border border-gray-100/50 mb-8">
                                <div class="text-left">
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Mulai</p>
                                    <p class="text-sm font-bold text-gray-800">{{ Carbon\Carbon::parse($sewa->tgl_sewa)->format('d M Y') }}</p>
                                </div>
                                <div class="flex-1 flex items-center justify-center px-4">
                                    <div class="h-px bg-gray-300 w-full relative">
                                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-2 text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Kembali</p>
                                    <p class="text-sm font-bold text-gray-800">{{ Carbon\Carbon::parse($sewa->jadwal_kembali)->format('d M Y') }}</p>
                                </div>
                            </div>

                            <!-- Rincian Biaya -->
                            <div class="space-y-4 text-sm text-gray-600">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">Biaya Sewa</span>
                                    <span class="font-bold text-gray-900">Rp {{ number_format($sewa->sub_total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">Biaya Supir</span>
                                    <span class="font-bold text-gray-900">Rp {{ number_format($sewa->biaya_supir, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">Biaya Admin</span>
                                    <span class="font-black text-emerald-500 uppercase tracking-widest bg-emerald-50 px-2 py-0.5 rounded text-xs">GRATIS</span>
                                </div>
                            </div>
                        </div>

                        <!-- Total Bottom (Garis Putus-putus ala Struk) -->
                        <div class="p-6 md:p-8 bg-orange-50/30 border-t-2 border-dashed border-gray-200 mt-auto relative">
                            <div class="absolute -top-3 -left-3 w-6 h-6 bg-[#F8FAFC] rounded-full border-b-2 border-r-2 border-transparent"></div>
                            <div class="absolute -top-3 -right-3 w-6 h-6 bg-[#F8FAFC] rounded-full border-b-2 border-l-2 border-transparent"></div>
                            
                            <div class="flex justify-between items-end mb-6">
                                <div>
                                    <p class="text-xs font-black text-orange-500 uppercase tracking-widest mb-1">Total Pembayaran</p>
                                    <p class="text-gray-500 text-[10px] font-semibold uppercase">DP 50% dari total tagihan</p>
                                </div>
                                <h2 class="text-3xl md:text-4xl font-black text-orange-600 tracking-tighter">Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</h2>
                            </div>

                            <!-- Tombol Submit -->
                            <button id="btn-pay-now" class="group relative w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-black py-4 md:py-5 rounded-2xl shadow-xl shadow-orange-500/30 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-orange-500/50 active:translate-y-0 text-sm md:text-base uppercase tracking-widest overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    Bayar Sekarang
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </span>
                                <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                            </button>
                            
                            <p class="text-[10px] text-gray-400 text-center mt-6 flex items-center justify-center gap-1.5 font-bold uppercase tracking-widest">
                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                SSL Secured Payment
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT LOGIKA UI & CORE API -->
    <script>
        // 1. SCRIPT UNTUK MEMBUAT UI BISA DIPENCET-PENCET (INTERAKTIF)
        const methodRadios = document.querySelectorAll('.method-radio');
        
        function updateUIMethods() {
            methodRadios.forEach(radio => {
                const card = radio.closest('.method-card');
                const outerCircle = card.querySelector('.circle-outer');
                const innerCircle = card.querySelector('.circle-inner');
                const icon = card.querySelector('img');
                
                if(radio.checked) {
                    // Beri warna oranye dan shadow jika dipilih
                    card.classList.add('border-orange-500', 'shadow-lg', 'shadow-orange-500/10');
                    card.classList.remove('border-gray-100');
                    outerCircle.classList.add('border-orange-500');
                    outerCircle.classList.remove('border-gray-200');
                    innerCircle.classList.remove('opacity-0');
                    innerCircle.classList.add('opacity-100');
                    if(icon.classList.contains('grayscale')) {
                        icon.classList.remove('grayscale');
                    }
                } else {
                    // Ubah jadi abu-abu jika tidak dipilih
                    card.classList.remove('border-orange-500', 'shadow-lg', 'shadow-orange-500/10');
                    card.classList.add('border-gray-100');
                    outerCircle.classList.remove('border-orange-500');
                    outerCircle.classList.add('border-gray-200');
                    innerCircle.classList.add('opacity-0');
                    innerCircle.classList.remove('opacity-100');
                    if(radio.value === 'bank_transfer') {
                        icon.classList.add('grayscale');
                    }
                }
            });
        }

        // Jalankan fungsi saat radio berubah
        methodRadios.forEach(radio => {
            radio.addEventListener('change', updateUIMethods);
        });

        // Panggil sekali saat load untuk state awal
        updateUIMethods();

       
        document.querySelectorAll('.bank-selector').forEach(bank => {
            bank.addEventListener('change', () => {
                document.getElementById('method_bank').checked = true;
                updateUIMethods();
            });
        });
        
        document.getElementById('btn-pay-now').addEventListener('click', function() {
            const btn = this;
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            const bankCode = document.querySelector('input[name="bank_code"]:checked').value;

            btn.disabled = true;
            btn.innerHTML = `
                <span class="relative z-10 flex items-center justify-center gap-2">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                </span>
            `;

            fetch("{{ route('booking.charge', $sewa->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ 
                    payment_type: method,
                    bank: bankCode 
                })
            })
            .then(res => res.json())
            .then(data => {
                const area = document.getElementById('payment-content-area');
                
                if(!data || data.message === 'error' || data.code) {
                    alert('Error: ' + (data.message || 'Gagal memproses pembayaran'));
                    btn.disabled = false;
                    btn.innerHTML = `<span class="relative z-10">Bayar Sekarang</span>`;
                    return;
                }
                

                if(method === 'cash'){
                    area.innerHTML = `
                       <div class="flex justify-center items-center h-full">
                        <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-2xl border-2 border-orange-500 text-center animate-fade-in w-full max-w-lg relative overflow-hidden">
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-60"></div>
                            <h3 class="text-2xl md:text-3xl font-black text-gray-900 mb-2 uppercase tracking-tighter relative z-10">Scan QRIS</h3>
                            <p class="text-sm text-gray-500 mb-8 font-medium relative z-10">Silakan datang ke kantor kami untuk melakukan pembayaran secara langsung dan melakukan verifikasi unit.</p>
                            
                           <div class="bg-orange-50 p-6 rounded-2xl border border-orange-100">
                    <p class="text-orange-600 font-bold uppercase tracking-widest">Sebutkan ID Pesanan: ${data.order_id || 'ID Kamu'}</p>
                </div>
                            <div class="mt-8 p-4 bg-orange-50 rounded-2xl text-orange-600 text-xs md:text-sm font-bold uppercase tracking-widest border border-orange-100 relative z-10">
                                Selesaikan pembayaran dalam 15 menit
                            </div>
                        </div>
                    </div>
                    `
                    return;
                }

                
                if(method === 'qris') {
                    const qrUrl = data?.actions?.[0]?.url || data?.qr_string || data?.redirect_url || '';
                    if(!qrUrl) {
                        alert('Error: QR Code tidak tergenerate');
                        btn.disabled = false;
                        btn.innerHTML = `<span class="relative z-10">Bayar Sekarang</span>`;
                        return;
                    }
                    area.innerHTML = `
                    <div class="flex justify-center items-center h-full">
                        <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-2xl border-2 border-orange-500 text-center animate-fade-in w-full max-w-lg relative overflow-hidden">
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-60"></div>
                            <h3 class="text-2xl md:text-3xl font-black text-gray-900 mb-2 uppercase tracking-tighter relative z-10">Scan QRIS</h3>
                            <p class="text-sm text-gray-500 mb-8 font-medium relative z-10">Buka E-Wallet Anda (Gopay, OVO, Dana, ShopeePay).</p>
                            
                            <div class="bg-white p-5 inline-block rounded-[2rem] shadow-[0_0_40px_rgba(249,115,22,0.15)] border border-orange-100 relative z-10">
                                <img src="${qrUrl}" class="w-56 h-56 md:w-64 md:h-64 object-contain" alt="QRIS">
                            </div>
                            
                            <div class="mt-8 p-4 bg-orange-50 rounded-2xl text-orange-600 text-xs md:text-sm font-bold uppercase tracking-widest border border-orange-100 relative z-10">
                                Selesaikan pembayaran dalam 15 menit
                            </div>
                        </div>
                    </div>
                    `;
                } else if(method === 'bank_transfer') {
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
                                <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-60"></div>
                                <h3 class="text-2xl font-black text-gray-900 mb-8 uppercase tracking-tighter relative z-10">Virtual Account ${bankCode.toUpperCase()}</h3>
                                
                                <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 relative z-10">
                                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Nomor Pembayaran</p>
                                    <p class="text-3xl md:text-4xl font-black text-orange-600 tracking-tighter">${vaNumber}</p>
                                </div>
                                
                                <button onclick="navigator.clipboard.writeText('${vaNumber}'); alert('Nomor disalin!')" 
                                        class="mt-8 w-full bg-gray-900 text-white px-6 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-lg shadow-gray-900/20 relative z-10">
                                    Salin Nomor VA
                                </button>
                            </div>
                        </div>
                    `;
                }
                
                btn.parentElement.classList.add('opacity-50', 'pointer-events-none');
                btn.innerHTML = `<span class="relative z-10">Menunggu Pembayaran...</span>`;
                btn.classList.remove('from-orange-500', 'to-orange-600');
                btn.classList.add('bg-gray-500');

                mulaiCekOtomatis();
            })
            .catch(err => {
                alert("Gagal memproses pembayaran. Coba lagi.");
                btn.disabled = false;
                btn.innerHTML = `<span class="relative z-10">Bayar Sekarang</span>`;
            });
        });

        function mulaiCekOtomatis() {
    const intervalCek = setInterval(() => {
        fetch("{{ route('booking.status', $sewa->id) }}")
            .then(res => res.json())
            .then(data => {
                if (['settlement', 'capture'].includes(data.transaction_status)) {
                    clearInterval(intervalCek);
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Pembayaran berhasil, mengalihkan ke Home...',
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    setTimeout(() => {
                        window.location.href = "{{ route('home') }}";
                    }, 3000);
                }
            });
    }, 5000); // Cek setiap 5 detik
}
    </script>

    <style>
        @keyframes fadeIn { 
            from { opacity: 0; transform: translateY(20px) scale(0.98); } 
            to { opacity: 1; transform: translateY(0) scale(1); } 
        }
        .animate-fade-in { animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>

    
</x-user>