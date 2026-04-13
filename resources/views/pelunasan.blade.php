<x-user>
    <div class="min-h-screen bg-[#F8FAFC] py-8 md:py-12 px-4 sm:px-6 lg:px-8 font-sans selection:bg-orange-100 selection:text-orange-900">
        <div class="max-w-6xl mx-auto">
            
            <div class="mb-8 md:mb-12">
                <a href="{{ route('profile.user') }}" class="group inline-flex items-center text-gray-500 hover:text-orange-500 transition-all duration-300 mb-6 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100 hover:shadow-md">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="font-semibold text-sm">Kembali</span>
                </a>
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Pelunasan Pembayaran</h1>
                <p class="text-gray-500 mt-2 text-sm md:text-base font-medium">Selesaikan sisa tagihan untuk pesanan kendaraan Anda.</p>
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
                            <div class="circle-outer w-7 h-7 rounded-full border-[3px] border-orange-500 flex items-center justify-center transition-colors shadow-sm">
                                <div class="circle-inner w-3.5 h-3.5 bg-orange-500 rounded-full opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </label>

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
                            <div class="circle-outer w-7 h-7 rounded-full border-[3px] border-gray-200 flex items-center justify-center transition-colors">
                                <div class="circle-inner w-3.5 h-3.5 bg-orange-500 rounded-full opacity-0 transition-opacity"></div>
                            </div>
                        </label>

                        <div class="flex flex-wrap gap-3 pl-0 md:pl-20 mt-2">
                            @foreach(['bca', 'mandiri', 'bni', 'bri'] as $bank)
                                <label class="cursor-pointer flex-1 sm:flex-none">
                                    <input type="radio" name="bank_code" value="{{ $bank }}" class="hidden peer bank-selector" {{ $bank == 'bca' ? 'checked' : '' }}>
                                    <div class="bg-white border-2 border-gray-100 text-gray-400 font-bold px-6 py-3 rounded-xl uppercase tracking-widest text-center text-xs md:text-sm transition-all duration-300 hover:border-gray-300 hover:bg-gray-50 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-600 peer-checked:shadow-sm">
                                        {{ $bank }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-5">
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 sticky top-24 overflow-hidden flex flex-col">
                        
                        <div class="bg-gray-900 p-6 md:p-8 text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl transform translate-x-10 -translate-y-10"></div>
                            <h3 class="font-black text-xl tracking-tight mb-1 relative z-10">Ringkasan Pelunasan</h3>
                            <p class="text-gray-400 text-xs font-medium uppercase tracking-widest relative z-10">ORDER ID: #{{ $payment?->order_id ?? 'INV-' . $sewa->id }}</p>
                        </div>
                        
                        <div class="p-6 md:p-8">
                            <div class="flex items-center gap-5 mb-8 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <div class="w-20 h-14 bg-white rounded-xl shadow-sm p-1 flex items-center justify-center overflow-hidden shrink-0 text-center">
                                    @if($sewa->kendaraan->dir)
                                        <img src="{{ asset('storage/' . $sewa->kendaraan->dir) }}" class="w-full h-full object-contain">
                                    @else
                                        <span class="text-[8px] font-bold text-gray-400 uppercase">No Image</span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-extrabold text-gray-900 text-lg leading-tight truncate">{{ $sewa->kendaraan->nama_kendaraan }}</h3>
                                    <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider">{{ $sewa->jenis_sewa }}</span>
                                </div>
                            </div>

                            <div class="space-y-4 text-sm text-gray-600">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">Total Harga Sewa</span>
                                    <span class="font-bold text-gray-900">Rp {{ number_format($sewa->harga_total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">Uang Muka (DP) Terbayar</span>
                                    <span class="font-black text-emerald-500">- Rp {{ number_format($sewa->dp, 0, ',', '.') }}</span>
                                </div>
                                <hr class="border-dashed border-gray-200">
                            </div>
                        </div>

                        <div class="p-6 md:p-8 bg-orange-50/30 border-t-2 border-dashed border-gray-200 mt-auto relative">
                            <div class="absolute -top-3 -left-3 w-6 h-6 bg-[#F8FAFC] rounded-full border-b-2 border-r-2 border-transparent"></div>
                            <div class="absolute -top-3 -right-3 w-6 h-6 bg-[#F8FAFC] rounded-full border-b-2 border-l-2 border-transparent"></div>
                            
                            <div class="flex justify-between items-end mb-6">
                                <div>
                                    <p class="text-xs font-black text-orange-500 uppercase tracking-widest mb-1">Tagihan Akhir</p>
                                    <p class="text-gray-500 text-[10px] font-semibold uppercase">Sisa yang harus dilunasi</p>
                                </div>
                                <h2 class="text-3xl md:text-4xl font-black text-orange-600 tracking-tighter">Rp {{ number_format($sewa->sisa_tagihan, 0, ',', '.') }}</h2>
                            </div>

                            <button id="btn-pay-now" class="group relative w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-black py-4 md:py-5 rounded-2xl shadow-xl shadow-orange-500/30 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-orange-500/50 active:translate-y-0 text-sm md:text-base uppercase tracking-widest overflow-hidden">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    Bayar Pelunasan Sekarang
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
        function updateUIMethods() {
            const methodRadios = document.querySelectorAll('.method-radio');
            methodRadios.forEach(radio => {
                const card = radio.closest('.method-card');
                const outerCircle = card.querySelector('.circle-outer');
                const innerCircle = card.querySelector('.circle-inner');
                const icon = card.querySelector('img');

                if (radio.checked) {
                    card.classList.replace('border-gray-100', 'border-orange-500');
                    card.classList.add('shadow-lg', 'shadow-orange-500/10');
                    outerCircle.classList.replace('border-gray-200', 'border-orange-500');
                    innerCircle.classList.replace('opacity-0', 'opacity-100');
                    if(icon.classList.contains('grayscale')) icon.classList.remove('grayscale');
                } else {
                    card.classList.replace('border-orange-500', 'border-gray-100');
                    card.classList.remove('shadow-lg', 'shadow-orange-500/10');
                    outerCircle.classList.replace('border-orange-500', 'border-gray-200');
                    innerCircle.classList.replace('opacity-100', 'opacity-0');
                    if(radio.value === 'bank_transfer') icon.classList.add('grayscale');
                }
            });
        }

        document.querySelectorAll('.method-radio').forEach(r => r.addEventListener('change', updateUIMethods));
        document.querySelectorAll('.bank-selector').forEach(b => b.addEventListener('change', () => {
            document.getElementById('method_bank').checked = true;
            updateUIMethods();
        }));
        
        updateUIMethods();

        document.getElementById('btn-pay-now').addEventListener('click', function() {
            const btn = this;
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            
            // PERBAIKAN 1: Cara ambil bankCode lebih aman, pakai optional chaining
            const bankRadio = document.querySelector('input[name="bank_code"]:checked');
            const bankCode = bankRadio ? bankRadio.value : 'bca'; // Default BCA jika VA dipilih tapi belum klik logo banknya

            btn.disabled = true;
            btn.innerHTML = `<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...</span>`;

            fetch("{{ route('booking.charge', $sewa->id) }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "Accept": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ payment_type: method, bank: bankCode })
            })
            .then(res => res.json())
            .then(data => {
                const area = document.getElementById('payment-content-area');
                
                if(method === 'qris') {
                    const qrUrl = data.actions?.find(a => a.name === 'generate-qr-code')?.url 
                                  || data.actions?.[0]?.url 
                                  || '';

                    if (!qrUrl) {
                        alert("Gagal mendapatkan kode QRIS. Silakan coba metode lain.");
                        location.reload();
                        return;
                    }

                    area.innerHTML = `
                        <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-2xl border-2 border-orange-500 text-center animate-fade-in relative overflow-hidden">
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-60"></div>
                            <h3 class="text-2xl font-black text-gray-900 mb-2 uppercase tracking-tighter relative z-10">Scan QRIS Pelunasan</h3>
                            <p class="text-sm text-gray-500 mb-8 font-medium relative z-10">Buka E-Wallet (Gopay/OVO/Dana) Anda.</p>
                            
                            <div class="bg-white p-5 inline-block rounded-[2rem] shadow-xl border border-orange-100 relative z-10">
                                <img src="${qrUrl}" 
                                     class="w-64 h-64 object-contain" 
                                     onerror="this.src='https://placehold.co/300x300?text=QR+Error+Refresh+Page'">
                            </div>
                            
                            <div class="mt-8 p-4 bg-orange-50 rounded-2xl text-orange-600 text-sm font-bold uppercase tracking-widest border border-orange-100 relative z-10">
                                Selesaikan pembayaran dalam 15 menit
                            </div>
                        </div>`;
                }
                else if(method === 'bank_transfer') {
                    const vaNumber = data.va_numbers?.[0]?.va_number || 'Error VA';
                    area.innerHTML = `
                        <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-2xl border-2 border-orange-500 text-center animate-fade-in relative overflow-hidden">
                            <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-60"></div>
                            <h3 class="text-2xl font-black text-gray-900 mb-8 uppercase tracking-tighter relative z-10">VA ${bankCode.toUpperCase()} Pelunasan</h3>
                            <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 relative z-10 mb-6">
                                <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Nomor Virtual Account</p>
                                <p class="text-3xl md:text-4xl font-black text-orange-600 tracking-tighter">${vaNumber}</p>
                            </div>
                            <button onclick="navigator.clipboard.writeText('${vaNumber}'); alert('Nomor VA Berhasil Disalin!')" class="w-full bg-gray-900 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-gray-800 transition-colors shadow-lg shadow-gray-900/20 relative z-10">Salin Nomor VA</button>
                        </div>`;
                }

                btn.parentElement.classList.add('opacity-50', 'pointer-events-none');
                btn.innerHTML = `<span class="relative z-10">Menunggu Pembayaran...</span>`;
                
                mulaiCekOtomatis();
            })
            .catch(err => {
                console.error("Error Fetch:", err); // Biar ketahuan errornya apa di console
                alert("Gagal memproses. Silakan coba lagi.");
                btn.disabled = false;
                btn.innerHTML = `<span class="relative z-10 flex items-center justify-center gap-2">Bayar Pelunasan Sekarang <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></span>`;
            });
        });

        function mulaiCekOtomatis() {
            const intervalCek = setInterval(() => {
                fetch("{{ route('booking.status', $sewa->id) }}")
                    .then(res => res.json())
                    .then(data => {
                        // PERBAIKAN 2: Penutup bracket (kurung kurawal) yang benar
                        if (data.status === 'lunas') {
                            clearInterval(intervalCek);
                            Swal.fire({
                                title: 'PELUNASAN SUKSES!',
                                text: 'Terima kasih, pesananmu telah lunas total.',
                                icon: 'success',
                                confirmButtonColor: '#F97316'
                            }).then(() => {
                                window.location.href = "{{ route('profile.rental-history') }}";
                            });
                        }
                    })
                    .catch(err => console.error("Error Cek Status:", err));
            }, 5000);
        }
    </script>

    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</x-user>