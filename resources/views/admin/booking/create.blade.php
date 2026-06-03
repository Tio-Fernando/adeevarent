<x-app-layout>
<div class="max-w-5xl mx-auto px-4 py-8 font-sans">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('booking.index') }}"
            class="p-1.5 rounded-lg border border-gray-200 text-gray-400 hover:text-gray-600 hover:bg-gray-50 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Tambah Booking</h1>
            <p class="text-xs text-gray-400 mt-0.5">Buat booking untuk pelanggan</p>
        </div>
    </div>

    @if(session('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('booking.storeAdmin') }}" id="formBooking">
        @csrf
        <input type="hidden" name="latitude" id="lat">
        <input type="hidden" name="longitude" id="lng">
        <input type="hidden" name="tanggal_kembali" id="tanggal_kembali">

        <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-6">
            <h3 class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-4">Data Booking</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                        Pelanggan <span class="text-red-400">*</span>
                    </label>
                    <select name="id_pelanggan"
                        class="border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-orange-400 {{ $errors->has('id_pelanggan') ? 'border-red-300' : '' }}">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggan as $p)
                            <option value="{{ $p->id_pelanggan }}" {{ old('id_pelanggan') == $p->id_pelanggan ? 'selected' : '' }}>
                                {{ $p->nama_pelanggan }} ({{ $p->user->email ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_pelanggan')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                        Kendaraan <span class="text-red-400">*</span>
                    </label>
                    <select name="nopol" id="nopol"
                        class="border border-gray-200 rounded-xl px-3 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-orange-400 {{ $errors->has('nopol') ? 'border-red-300' : '' }}"
                        onchange="hitungTotal()">
                        <option value="">-- Pilih Kendaraan --</option>
                        @foreach($kendaraan as $k)
                            <option value="{{ $k->nopol }}"
                                data-harga="{{ $k->harga }}"
                                {{ old('nopol') == $k->nopol ? 'selected' : '' }}>
                                {{ $k->nama_kendaraan }} - {{ $k->nopol }}
                                (Rp {{ number_format($k->harga, 0, ',', '.') }}/hari)
                            </option>
                        @endforeach
                    </select>
                    @error('nopol')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-3">Rental Duration</h3>
            <div class="bg-white rounded-2xl flex flex-col md:flex-row border border-gray-200 overflow-hidden">
                <div class="flex-1 p-5 border-b md:border-b-0 md:border-r border-gray-200">
                    <label class="text-xs text-gray-500 mb-1 block font-semibold">Pick-up Date & Time</label>
                    <input type="datetime-local" name="tanggal_sewa" id="tanggal_sewa"
                        class="w-full bg-transparent border-none p-0 text-base font-bold text-gray-900 focus:ring-0 cursor-pointer"
                        required onchange="hitungTotal()">
                </div>
                <div class="flex-1 p-5">
                    <label class="text-xs text-gray-500 mb-1 block font-semibold">Duration</label>
                    <select id="durasi_hari"
                        class="w-full bg-transparent border-none p-0 text-base font-bold text-gray-900 focus:ring-0 cursor-pointer"
                        onchange="hitungTotal()">
                        @for($i = 1; $i <= 30; $i++)
                            <option value="{{ $i }}">{{ $i }} Hari</option>
                        @endfor
                    </select>
                </div>
            </div>
            <p class="text-[10px] text-gray-400 mt-2 px-2">
                *Mobil dikembalikan pada jam yang sama di hari terakhir sewa (Sistem 24 Jam).
            </p>
        </div>

        <div class="mb-6 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Opsi Layanan & Pengambilan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Sewa</label>
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
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
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
                            <span class="ml-3 text-sm text-gray-700 font-medium">Diantar ke Lokasi</span>
                        </label>
                    </div>
                </div>
            </div>

            <div id="boxAlamat" class="mt-4 hidden">
                <label class="block text-sm font-bold text-gray-700 mb-2">Detail Alamat Pengantaran</label>
                <button type="button" onclick="getCurrentLocation()"
                    class="mb-3 flex items-center gap-2 bg-orange-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-orange-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Deteksi Lokasi GPS Saya
                </button>
                <div id="map" style="height: 300px; border-radius: 12px; border: 2px solid #e5e7eb; z-index: 1;"></div>
                <p class="text-xs text-gray-500 mt-2">*Klik peta untuk menentukan lokasi pengantaran.</p>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Metode Pembayaran</label>
                <div class="space-y-2">
                    <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                        <input type="radio" name="tipe_pembayaran" value="dp" checked
                            class="w-4 h-4 text-orange-500 focus:ring-orange-400" onchange="hitungTotal()">
                        <span class="ml-3 text-sm text-gray-700 font-medium">DP 50%</span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                        <input type="radio" name="tipe_pembayaran" value="lunas"
                            class="w-4 h-4 text-orange-500 focus:ring-orange-400" onchange="hitungTotal()">
                        <span class="ml-3 text-sm text-gray-700 font-medium">Bayar Lunas</span>
                    </label>
                </div>
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
                <div class="flex justify-between items-center mb-5">
                    <p class="text-sm text-gray-600">Biaya Supir</p>
                    <p class="text-sm font-bold text-gray-800" id="summary_supir">Rp. 0</p>
                </div>
                <div class="border-t border-gray-300 pt-5 flex justify-between items-end">
                    <div>
                        <p class="text-base font-bold text-gray-900 mb-1">Total Tagihan</p>
                        <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-xs font-bold" id="summary_dp">
                            Wajib DP 50%: Rp. 0
                        </span>
                    </div>
                    <div class="text-2xl font-extrabold text-orange-500" id="summary_total">Rp. 0</div>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full bg-orange-500 hover:bg-orange-600 active:scale-95 text-white font-bold text-lg py-4 rounded-xl transition duration-200 shadow-md">
            Buat Booking
        </button>

    </form>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var map, marker;

    const formatRupiah = (angka) => 'Rp. ' + new Intl.NumberFormat('id-ID').format(angka);

    function getHargaPerHari() {
        const nopolSelect = document.getElementById('nopol');
        const selected = nopolSelect.options[nopolSelect.selectedIndex];
        return parseInt(selected?.dataset?.harga) || 0;
    }

    function hitungTotal() {
        const valMulai    = document.getElementById('tanggal_sewa').value;
        const durasiHari  = parseInt(document.getElementById('durasi_hari').value) || 1;
        const hargaPerHari = getHargaPerHari();

        if (valMulai) {
            const tglMulai   = new Date(valMulai);
            const tglKembali = new Date(tglMulai);
            tglKembali.setDate(tglMulai.getDate() + durasiHari);

            const pad = (n) => String(n).padStart(2, '0');
            const formatKembali = `${tglKembali.getFullYear()}-${pad(tglKembali.getMonth()+1)}-${pad(tglKembali.getDate())}T${pad(tglKembali.getHours())}:${pad(tglKembali.getMinutes())}`;
            document.getElementById('tanggal_kembali').value = formatKembali;
        }

        const jenisSewa      = document.querySelector('input[name="jenis_sewa"]:checked')?.value;
        const tipePembayaran = document.querySelector('input[name="tipe_pembayaran"]:checked')?.value;
        const durasiHari2    = parseInt(document.getElementById('durasi_hari').value) || 1;

        const totalSewa  = durasiHari2 * hargaPerHari;
        const totalSupir = jenisSewa === 'sopir' ? 150000 * durasiHari2 : 0;
        const grandTotal = totalSewa + totalSupir;
        const dp         = tipePembayaran === 'dp' ? grandTotal * 0.5 : grandTotal;

        document.getElementById('text_durasi').innerText   = `(${durasiHari2} hari)`;
        document.getElementById('summary_sewa').innerText  = formatRupiah(totalSewa);
        document.getElementById('summary_supir').innerText = formatRupiah(totalSupir);
        document.getElementById('summary_total').innerText = formatRupiah(dp);
        document.getElementById('summary_dp').innerText    = tipePembayaran === 'dp'
            ? `Wajib DP 50%: ${formatRupiah(dp)}`
            : `Bayar Lunas: ${formatRupiah(grandTotal)}`;
    }

    function toggleAlamat() {
        const opsi     = document.querySelector('input[name="opsi_pengantaran"]:checked').value;
        const boxAlamat = document.getElementById('boxAlamat');

        if (opsi === 'diantar') {
            boxAlamat.classList.remove('hidden');
            if (!map) {
                map = L.map('map').setView([-7.6298, 111.5239], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(map);

                map.on('click', function(e) {
                    if (marker) map.removeLayer(marker);
                    marker = L.marker(e.latlng).addTo(map);
                    document.getElementById('lat').value = e.latlng.lat;
                    document.getElementById('lng').value = e.latlng.lng;
                });

                setTimeout(() => map.invalidateSize(), 200);
            }
        } else {
            boxAlamat.classList.add('hidden');
            document.getElementById('lat').value = '';
            document.getElementById('lng').value = '';
        }
        hitungTotal();
    }

    function getCurrentLocation() {
        if (!navigator.geolocation) {
            alert("Browser tidak mendukung GPS.");
            return;
        }
        const btn = event.currentTarget;
        btn.textContent = "Mencari Lokasi...";
        btn.disabled = true;

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;

                const newPos = [lat, lng];
                map.setView(newPos, 18);
                if (marker) map.removeLayer(marker);
                marker = L.marker(newPos).addTo(map);
                marker.bindPopup("Lokasi Terdeteksi!").openPopup();

                btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg> Deteksi Lokasi GPS Saya`;
                btn.disabled = false;
            },
            (error) => {
                alert("Gagal: " + error.message);
                btn.disabled = false;
            },
            { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
        );
    }

    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('tanggal_sewa').min = now.toISOString().slice(0, 16);
        hitungTotal();
    });
</script>
</x-app-layout>