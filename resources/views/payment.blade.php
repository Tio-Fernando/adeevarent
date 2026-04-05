<x-user>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-5xl mx-auto">
            
            <!-- Header & Back Button -->
            <div class="mb-10">
                <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-black transition-colors mb-6">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Metode Pembayaran</h1>
                <p class="text-gray-500 mt-2 text-sm md:text-base">Selesaikan pesanan Anda untuk mengamankan unit armada pilihan.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                <!-- BAGIAN KIRI: Opsi Pembayaran -->
                <div id="payment-content-area" class="lg:col-span-2 space-y-5">
                    
                    <!-- 1. QRIS -->
                    <!-- Kita gunakan class 'method-card' untuk target JavaScript nanti -->
                    <label class="method-card block bg-white p-6 rounded-2xl border-2 border-orange-500 shadow-sm cursor-pointer transition-all">
                        <input type="radio" name="payment_method" value="qris" id="method_qris" class="hidden method-radio" checked>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-5">
                                <div class="bg-orange-50 p-3 rounded-xl">
                                    <img src="https://img.icons8.com/color/48/qr-code.png" class="w-8 h-8" alt="QRIS">
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg tracking-tight uppercase">QRIS</h4>
                                    <p class="text-xs text-gray-500 font-medium mt-1">Gopay, OVO, Dana, LinkAja</p>
                                </div>
                            </div>
                            <!-- Lingkaran Indikator -->
                            <div class="circle-outer w-6 h-6 rounded-full border-2 border-orange-500 flex items-center justify-center transition-colors">
                                <div class="circle-inner w-3 h-3 bg-orange-500 rounded-full opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </label>

                    <!-- 2. TRANSFER BANK -->
                    <div class="method-card bg-white p-6 rounded-2xl border-2 border-gray-100 shadow-sm transition-all">
                        <label class="flex items-center justify-between cursor-pointer mb-5">
                            <input type="radio" name="payment_method" value="bank_transfer" id="method_bank" class="hidden method-radio">
                            <div class="flex items-center gap-5">
                                <div class="bg-gray-50 p-3 rounded-xl">
                                    <img src="https://img.icons8.com/fluency/48/bank.png" class="w-8 h-8" alt="Bank">
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg tracking-tight">Transfer Bank</h4>
                                    <p class="text-xs text-gray-500 font-medium mt-1">Virtual Account (BCA, Mandiri, BNI, BRI)</p>
                                </div>
                            </div>
                            <!-- Lingkaran Indikator -->
                            <div class="circle-outer w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition-colors">
                                <div class="circle-inner w-3 h-3 bg-orange-500 rounded-full opacity-0 transition-opacity"></div>
                            </div>
                        </label>

                        <!-- Pilihan Bank (Interaktif) -->
                        <div class="flex flex-wrap gap-3 pl-16">
                            @foreach(['bca', 'mandiri', 'bni', 'bri'] as $bank)
                                <label class="cursor-pointer">
                                    <input type="radio" name="bank_code" value="{{ $bank }}" class="hidden peer bank-selector" {{ $bank == 'bca' ? 'checked' : '' }}>
                                    <span class="bg-gray-100 text-xs font-bold text-gray-500 px-5 py-2.5 rounded-lg uppercase tracking-widest peer-checked:bg-orange-500 peer-checked:text-white transition-colors hover:bg-gray-200 block shadow-sm">
                                        {{ $bank }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- BAGIAN KANAN: Ringkasan & Tombol Bayar -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 sticky top-24">
                        
                        <!-- Mobil Info -->
                        <div class="flex items-center gap-4 mb-8">
                            <img src="{{ asset('storage/' . $sewa->kendaraan->dir) }}" class="w-24 h-16 object-contain rounded-xl bg-gray-50">
                            <div>
                                <h3 class="font-bold text-gray-900 text-base leading-tight">{{ $sewa->kendaraan->nama_kendaraan }}</h3>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-2 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ Carbon\Carbon::parse($sewa->tgl_sewa)->format('d M') }} - {{ Carbon\Carbon::parse($sewa->jadwal_kembali)->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Rincian -->
                        <div class="space-y-4 text-xs md:text-sm text-gray-600 border-t border-gray-100 pt-6">
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Sewa Kendaraan</span>
                                <span class="font-bold text-gray-900 uppercase">Rp {{ number_format($sewa->sub_total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Antar-Jemput</span>
                                <span class="font-bold text-gray-900 uppercase">Rp {{ number_format($sewa->biaya_antar, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-medium">Biaya Admin</span>
                                <span class="font-black text-green-500 uppercase tracking-widest">FREE</span>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="mt-8 pt-6 border-t border-dashed border-gray-200">
                            <p class="text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1">Total Pembayaran (DP 50%)</p>
                            <h2 class="text-3xl md:text-4xl font-black text-orange-500 tracking-tighter">Rp {{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</h2>
                        </div>

                        <!-- Tombol Submit -->
                        <button id="btn-pay-now" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl mt-8 shadow-lg shadow-orange-200 transition-all transform active:scale-95 text-sm uppercase tracking-widest">
                            Bayar Sekarang
                        </button>
                        
                        <p class="text-[10px] text-gray-400 text-center mt-6 flex items-center justify-center gap-1.5 font-bold uppercase tracking-widest">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            Pembayaran aman & terenkripsi
                        </p>
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
                
                if(radio.checked) {
                    // Beri warna oranye jika dipilih
                    card.classList.add('border-orange-500');
                    card.classList.remove('border-gray-100');
                    outerCircle.classList.add('border-orange-500');
                    outerCircle.classList.remove('border-gray-300');
                    innerCircle.classList.remove('opacity-0');
                    innerCircle.classList.add('opacity-100');
                } else {
                    // Ubah jadi abu-abu jika tidak dipilih
                    card.classList.remove('border-orange-500');
                    card.classList.add('border-gray-100');
                    outerCircle.classList.remove('border-orange-500');
                    outerCircle.classList.add('border-gray-300');
                    innerCircle.classList.add('opacity-0');
                    innerCircle.classList.remove('opacity-100');
                }
            });
        }

        // Jalankan fungsi saat radio berubah
        methodRadios.forEach(radio => {
            radio.addEventListener('change', updateUIMethods);
        });

        // Jika user klik tombol Bank (BCA, Mandiri), otomatis pilih "Transfer Bank"
        document.querySelectorAll('.bank-selector').forEach(bank => {
            bank.addEventListener('change', () => {
                document.getElementById('method_bank').checked = true;
                updateUIMethods();
            });
        });

        // 2. SCRIPT UNTUK TOMBOL BAYAR SEKARANG (AJAX MIDTRANS)
        document.getElementById('btn-pay-now').addEventListener('click', function() {
            const btn = this;
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            const bankCode = document.querySelector('input[name="bank_code"]:checked').value;

            btn.disabled = true;
            btn.innerText = "Memproses...";

            fetch("{{ route('charge.payment', $sewa->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
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
                
                if(method === 'qris') {
                    area.innerHTML = `
                    <div class="flex justify-center items-center">
                        <div class="bg-white p-12 rounded-[2rem] shadow-xl border-2 border-orange-500 text-center animate-fade-in">
                            <h3 class="text-2xl font-black text-gray-900 mb-2 uppercase tracking-tighter">Scan QRIS Untuk Bayar</h3>
                            <p class="text-sm text-gray-500 mb-8 font-medium">Gunakan aplikasi E-Wallet Anda (Gopay, OVO, Dana, dll).</p>
                            <div class="bg-white p-4 inline-block rounded-2xl shadow-inner border border-gray-100">
                                <img src="${data.actions[0].url}" class="w-64 h-64 object-contain">
                            </div>
                            <div class="mt-8 p-4 bg-orange-50 rounded-xl text-orange-600 text-xs font-bold uppercase tracking-widest border border-orange-100">
                                Selesaikan pembayaran segera
                            </div>
                        </div>
                        </div>
                    `;
                } else if(method === 'bank_transfer') {
                    area.innerHTML = `
                        <div class="bg-white p-12 rounded-[2rem] shadow-xl border-2 border-orange-500 animate-fade-in text-center">
                            <h3 class="text-2xl font-black text-gray-900 mb-6 uppercase tracking-tighter">Virtual Account ${bankCode.toUpperCase()}</h3>
                            <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100">
                                <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Nomor Pembayaran</p>
                                <p class="text-4xl md:text-5xl font-black text-gray-800 tracking-tighter">${data.va_numbers[0].va_number}</p>
                            </div>
                            <button onclick="navigator.clipboard.writeText('${data.va_numbers[0].va_number}'); alert('Nomor disalin!')" 
                                    class="mt-8 bg-gray-900 text-white px-6 py-3 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-gray-800 transition-colors">
                                Salin Nomor
                            </button>
                        </div>
                    `;
                }
                btn.parentElement.classList.add('opacity-50', 'pointer-events-none');
                btn.innerText = "Menunggu Pembayaran";
            })
            .catch(err => {
                alert("Gagal memproses pembayaran. Coba lagi.");
                btn.disabled = false;
                btn.innerText = "Bayar Sekarang";
            });
        });
    </script>

    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
    </style>
</x-user>