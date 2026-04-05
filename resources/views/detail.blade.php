<x-user>
    <div class="max-w-5xl mx-auto px-4 py-8 font-sans">
        
        {{-- BAGIAN ATAS: Info Mobil & Spesifikasi --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-4xl font-extrabold text-gray-900">{{ $kendaraan->nama_kendaraan }}</h1>
                    @if($kendaraan->status == 'free')
                        <span class="bg-green-200 text-green-700 text-xs font-bold px-3 py-1 rounded-md uppercase">FREE</span>
                    @else
                        <span class="bg-red-200 text-red-700 text-xs font-bold px-3 py-1 rounded-md uppercase">{{ $kendaraan->status }}</span>
                    @endif
                </div>
                <div class="text-3xl font-bold text-orange-500 mb-6">
                    Rp. {{ number_format($kendaraan->harga, 0, ',', '.') }} 
                    <span class="text-base text-gray-400 font-normal">/ hari</span>
                </div>
                <div class="w-full h-auto">
                    <img src="{{ asset('storage/' . $kendaraan->dir) }}" alt="{{ $kendaraan->nama_kendaraan }}" class="w-full object-contain drop-shadow-xl">
                </div>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Spesifikasi</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Transmisi</p>
                        <p class="text-xs text-gray-500">{{ $kendaraan->transmisi }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v8l9-11h-7z" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Bahan Bakar</p>
                        <p class="text-xs text-gray-500">{{ ucfirst($kendaraan->bbm) }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Warna</p>
                        <p class="text-xs text-gray-500">{{ $kendaraan->warna }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Air Conditioner</p>
                        <p class="text-xs text-gray-500">Yes</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Tahun</p>
                        <p class="text-xs text-gray-500">{{ $kendaraan->tahun }}</p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('booking.store', $kendaraan->nopol) }}" method="POST" id="formBooking">
            @csrf
            <input type="hidden" name="nopol" value="{{ $kendaraan->nopol }}">
            <input type="hidden" id="harga_sewa" value="{{ $kendaraan->harga }}">

            {{-- Rental Duration --}}
            <div class="mb-8">
                <h3 class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-3">Rental Duration</h3>
                <div class="bg-white rounded-2xl flex flex-col md:flex-row border border-gray-200 overflow-hidden">
                    <div class="flex-1 p-5 border-b md:border-b-0 md:border-r border-gray-200">
                        <label class="text-xs text-gray-500 mb-1 block font-semibold">Pick-up Date</label>
                        <input type="date" name="tgl_sewa" id="tanggal_sewa"
                               class="w-full bg-transparent border-none p-0 text-base font-bold text-gray-900 focus:ring-0 cursor-pointer"
                               required onchange="hitungTotal()">
                    </div>
                    <div class="flex-1 p-5">
                        <label class="text-xs text-gray-500 mb-1 block font-semibold">Return Date</label>
                        <input type="date" name="jadwal_kembali" id="tanggal_kembali"
                               class="w-full bg-transparent border-none p-0 text-base font-bold text-gray-900 focus:ring-0 cursor-pointer"
                               required onchange="hitungTotal()">
                    </div>
                </div>
            </div>

            {{-- Opsi Layanan --}}
            <div class="mb-8 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Opsi Layanan & Pengambilan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 mt-3">Jenis Sewa</label>
                        <div class="space-y-3">
                            <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                                <input type="radio" name="jenis_sewa" value="lepas kunci"
                                       class="w-4 h-4 text-orange-500 focus:ring-orange-400"
                                       checked onchange="hitungTotal()">
                                <span class="ml-3 text-sm text-gray-700 font-medium">Lepas Kunci (Tanpa Supir)</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                                <input type="radio" name="jenis_sewa" value="sopir"
                                       class="w-4 h-4 text-orange-500 focus:ring-orange-400"
                                       onchange="hitungTotal()">
                                <span class="ml-3 text-sm text-gray-700 font-medium">Dengan Supir (+ Rp 150.000/hari)</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <span class="flex justify-center items-center bg-orange-100 rounded-full w-8 h-8 shrink-0">
                                <img src="{{ asset('img/location.png') }}" alt="location" class="w-4">
                            </span>
                            <span class="text-sm font-bold text-gray-700">Lokasi Pengambilan</span>
                        </div>
                        <div class="space-y-3">
                            <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                                <input type="radio" name="opsi_pengantaran" value="tidak"
                                       class="w-4 h-4 text-orange-500 focus:ring-orange-400"
                                       checked onchange="toggleAlamat()">
                                <span class="ml-3 text-sm text-gray-700 font-medium">Ambil di Cabang (Gratis)</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                                <input type="radio" name="opsi_pengantaran" value="diantar"
                                       class="w-4 h-4 text-orange-500 focus:ring-orange-400"
                                       onchange="toggleAlamat()">
                                <span class="ml-3 text-sm text-gray-700 font-medium">Diantar ke Lokasi (+ Rp 50.000)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div id="boxAlamat" class="mt-4 hidden transition-all duration-300">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Detail Alamat Penjemputan / Pengantaran</label>
                    <textarea name="lokasi_jemput" rows="2"
                              class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-300"
                              placeholder="Contoh: Jl. Merdeka No 10, RT 01/RW 02..."></textarea>
                </div>
            </div>

            {{-- Payment Summary --}}
            <div class="mb-8">
                <h3 class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-3">Payment Summary</h3>
                <div class="bg-gray-100 p-5 rounded-2xl border border-gray-200">
                    <div class="flex justify-between items-center mb-3">
                        <p class="text-sm text-gray-600">Harga Sewa <span id="text_durasi">(0 hari)</span></p>
                        <p class="text-sm font-bold text-gray-800" id="summary_sewa">Rp. 0</p>
                    </div>
                    <div class="flex justify-between items-center mb-3">
                        <p class="text-sm text-gray-600">Biaya Supir</p>
                        <p class="text-sm font-bold text-gray-800" id="summary_supir">Rp. 0</p>
                    </div>
                    <div class="flex justify-between items-center mb-5">
                        <p class="text-sm text-gray-600">Biaya Antar</p>
                        <p class="text-sm font-bold text-gray-800" id="summary_antar">Rp. 0</p>
                    </div>
                    <div class="border-t border-gray-300 pt-5 flex justify-between items-end">
                        <div>
                            <p class="text-base font-bold text-gray-900 mb-1">Total Paid (Tagihan)</p>
                            <div class="flex items-center gap-2 text-xs text-gray-600 mt-2">
                                <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded font-bold" id="summary_dp">
                                    Wajib DP 50%: Rp. 0
                                </span>
                            </div>
                        </div>
                        <div class="text-2xl md:text-3xl font-extrabold text-orange-500" id="summary_total">
                            Rp. 0
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-lg py-4 rounded-xl transition duration-200 shadow-md">
                Lanjut Booking
            </button>
        </form>
    </div>

    <script>
        const formatRupiah = (angka) => {
            return 'Rp. ' + new Intl.NumberFormat('id-ID').format(angka);
        }

        function toggleAlamat() {
            const opsi = document.querySelector('input[name="opsi_pengantaran"]:checked').value;
            document.getElementById('boxAlamat').classList.toggle('hidden', opsi !== 'diantar');
            hitungTotal();
        }

        function hitungTotal() {
            const valMulai     = document.getElementById('tanggal_sewa').value;
            const valKembali   = document.getElementById('tanggal_kembali').value;
            const hargaPerHari = parseInt(document.getElementById('harga_sewa').value) || 0;

            let durasi = 0;
            if (valMulai && valKembali) {
                const tglMulai   = new Date(valMulai);
                const tglKembali = new Date(valKembali);
                durasi = Math.ceil((tglKembali - tglMulai) / (1000 * 60 * 60 * 24)) + 1;
                if (durasi < 1) durasi = 0;
            }

            const jenisSewa = document.querySelector('input[name="jenis_sewa"]:checked').value;
            const opsiAntar = document.querySelector('input[name="opsi_pengantaran"]:checked').value;

            const totalSewa  = durasi * hargaPerHari;
            const totalSupir = (jenisSewa === 'sopir')   ? (150000 * durasi) : 0;
            const totalAntar = (opsiAntar === 'diantar') ? 50000 : 0;
            const grandTotal = totalSewa + totalSupir + totalAntar;
            const dpWajib    = grandTotal * 0.5;

            document.getElementById('text_durasi').innerText  = `(${durasi} hari)`;
            document.getElementById('summary_sewa').innerText  = formatRupiah(totalSewa);
            document.getElementById('summary_supir').innerText = formatRupiah(totalSupir);
            document.getElementById('summary_antar').innerText = formatRupiah(totalAntar);
            document.getElementById('summary_total').innerText = formatRupiah(grandTotal);
            document.getElementById('summary_dp').innerText    = `Wajib DP 50%: ${formatRupiah(dpWajib)}`;
        }
    </script>

</x-user>