<x-user>
    <div class="max-w-5xl mx-auto px-4 py-8 font-sans">  
        {{-- BAGIAN ATAS: Info Mobil & Spesifikasi --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-4xl font-extrabold text-gray-900">{{ $kendaraan->nama_kendaraan }}</h1>
                    @if($kendaraan->status == 'Free')
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Jumlah Kursi</p>
                        <p class="text-xs text-gray-500">{{ $kendaraan->jumlah_kursi ?? '-' }}</p>
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

       <div class="mt-8 bg-gray-50 border border-gray-100 rounded-2xl p-6">
    <div class="flex items-center gap-2 mb-3">
        <svg class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <h2 class="text-sm font-black text-gray-900 uppercase tracking-tighest text-justify">Deskripsi</h2>
    </div>
   <p class="text-justify text-gray-700 leading-8 tracking-normal">
        {{ $kendaraan->deskripsi ?? 'Tidak ada deskripsi.' }}
    </p>
</div>
        
        <form action="{{ route('booking.store', $kendaraan->nopol) }}" method="POST" id="formBooking">
            @csrf
            <input type="hidden" name="nopol" value="{{ $kendaraan->nopol }}">
            <input type="hidden" id="harga_sewa" value="{{ $kendaraan->harga }}">
            <input type="hidden" name="latitude" id="lat">
    <input type="hidden" name="longitude" id="lng">
        {{-- Rental Duration --}}
<div class="mb-8">
    <h3 class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-3">Durasi Sewa</h3>
    <div class="bg-white rounded-2xl flex flex-col md:flex-row border border-gray-200 overflow-hidden">
        {{-- Tanggal Pick-up --}}
        <div class="flex-1 p-5 border-b md:border-b-0 md:border-r border-gray-200">
            <label class="text-xs text-gray-500 mb-1 block font-semibold">Jadwal Pengambilan</label>
            <input type="datetime-local" name="tanggal_sewa" id="tanggal_sewa"
                   class="w-full bg-transparent border-none p-0 text-base font-bold text-gray-900 focus:ring-0 cursor-pointer"
                   required onchange="hitungTotal()">
        </div>
        {{-- Dropdown Durasi --}}
        <div class="flex-1 p-5">
            <label class="text-xs text-gray-500 mb-1 block font-semibold">Durasi</label>
            <select id="durasi_hari" name="durasi" 
                    class="w-full bg-transparent border-none p-0 text-base font-bold text-gray-900 focus:ring-0 cursor-pointer"
                    onchange="hitungTotal()">
                @for ($i = 1; $i <= 30; $i++)
                    <option value="{{ $i }}">{{ $i }} Hari</option>
                @endfor
            </select>
        </div>
    </div>
    {{-- Hidden Input untuk tanggal_kembali (rencana kembali), bukan actual tanggal_kembali setelah pengembalian --}}
    <input type="hidden" name="tanggal_kembali" id="tanggal_kembali">
    
    <p class="text-[10px] text-gray-400 mt-2 px-2">
        *Mobil dikembalikan pada jam yang sama di hari terakhir sewa (Sistem 24 Jam).
    </p>
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
                                <span class="ml-3 text-sm text-gray-700 font-medium">Dengan Supir</span>
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
                                <span class="ml-3 text-sm text-gray-700 font-medium">Diantar ke Lokasi</span>
                            </label>
                        </div>
                    </div>

                </div>

               <div id="boxAlamat" class="mt-4 hidden transition-all duration-300">
    <label class="block text-sm font-bold text-gray-700 mb-2">Detail Alamat Pengantaran</label>
    
    <button type="button" onclick="getCurrentLocation()" 
            class="mb-3 flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-accent transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Deteksi Lokasi GPS Saya
    </button>

    <div id="map" style="height: 300px; border-radius: 12px; border: 2px solid #e5e7eb; z-index: 1 !important;"></div>
    <p class="text-xs text-gray-500 mt-2">*Pastikan GPS aktif dan beri izin akses lokasi jika muncul notifikasi.</p>
</div>


                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Metode Pembayaran</label>
                    <div class="space-y-2">
                        <label class="flex items-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="tipe_pembayaran" value="dp" checked
                                class="w-4 h-4 text-orange-500 focus:ring-orange-400" onchange="hitungTotal()">
                            <span class="text-sm ml-3">DP 50%</span>
                        </label>

                        <label class="flex items-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="tipe_pembayaran" value="lunas"
                                class="w-4 h-4 text-orange-500 focus:ring-orange-400" onchange="hitungTotal()">
                            <span class="text-sm ml-3">Bayar Lunas</span>
                        </label>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Metode Pembayaran</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="cash" 
                                   class="accent-orange-500" checked>
                            <span class="text-sm font-semibold">Bayar di Tempat (Cash)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="online" 
                                   class="accent-orange-500">
                            <span class="text-sm font-semibold">Bayar Online (Transfer/QRIS)</span>
                        </label>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Cash: bayar langsung saat pengambilan unit di kantor.</p>
                </div>

                <div class="mt-4">
  <button 
    type="button"
    onclick="toggleNote()"
    class="text-sm text-orange-500 font-medium hover:underline"
  >
    + Tambahkan catatan (opsional)
  </button>

  <div id="noteField" class="hidden mt-2">
    <textarea 
      name="keterangan"
      rows="2"
      class="w-full border rounded-lg p-2 text-sm focus:ring-2 focus:ring-orange-400"
      placeholder="Contoh: DP via QRIS OVO, atau ada permintaan khusus"
    ></textarea>
  </div>
</div>
            </div>
            
            

            {{-- Payment Summary --}}
            <div class="mb-8">
                <h3 class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-3">Rincian Pembayaran</h3>
                
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
                            <p class="text-base font-bold text-gray-900 mb-1">Total Bayar (Tagihan)</p>
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

            @php $canBook = strtolower($kendaraan->status) === 'free'; @endphp
        <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-lg py-4 rounded-xl transition duration-200 shadow-md disabled:opacity-50 disabled:cursor-not-allowed"
                    {{ $canBook ? '' : 'disabled' }}>
                {{ $canBook ? 'Lanjut Booking' : 'Kendaraan Tidak Tersedia' }}
            </button>
            @unless($canBook)
                <p class="text-sm text-red-600 mt-3 font-semibold">Kendaraan tidak bisa dipesan karena status {{ strtoupper($kendaraan->status) }}.</p>
            @endunless
        </form>
    </div>

 <script>

function toggleNote(){
    const el = document.getElementById('noteField');
    el.classList.toggle('hidden');
}

    var map, marker;

    function getCurrentLocation() {
    if (navigator.geolocation) {
        // Notifikasi loading (opsional)
        const btn = event.currentTarget;
        const originalText = btn.innerHTML;
        btn.innerHTML = "Mencari Lokasi";
        btn.disabled = true;

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

             
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;

                // 2. Update Peta & Marker
                const newPos = [lat, lng];
                map.setView(newPos, 18); // Zoom sangat dekat (akurat)

                if (marker) {
                    marker.setLatLng(newPos);
                } else {
                    marker = L.marker(newPos).addTo(map);
                }

                marker.bindPopup("Lokasi Kamu Terdeteksi!").openPopup();
                
       
                btn.innerHTML = originalText;
                btn.disabled = false;
            },
            (error) => {
                alert("Gagal mengambil lokasi: " + error.message);
                btn.innerHTML = originalText;
                btn.disabled = false;
            },
            {
             enableHighAccuracy: true,
            timeout: 15000,           // Beri waktu 15 detik untuk nyari satelit
            maximumAge: 0
            }
        );
    } else {
        alert("Browser kamu tidak mendukung GPS.");
    }
}

    function toggleAlamat() {
        const opsi = document.querySelector('input[name="opsi_pengantaran"]:checked').value;
        const boxAlamat = document.getElementById('boxAlamat');
        const mapDiv = document.getElementById('map');

        if (opsi === 'diantar') {
            boxAlamat.classList.remove('hidden');
            mapDiv.style.display = 'block'; 
                        
          
            if (!map) {
             
                map = L.map('map').setView([-7.6298, 111.5239], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(map);

                map.on('click', function(e) {
                    if (marker) { map.removeLayer(marker); }
                    marker = L.marker(e.latlng).addTo(map);
                    
                    // Masukkan koordinat ke input hidden
                    document.getElementById('lat').value = e.latlng.lat;
                    document.getElementById('lng').value = e.latlng.lng;
                });
                
                // Fix bug peta abu-abu saat pertama muncul
                setTimeout(() => { map.invalidateSize(); }, 200);
            }
        } else {
            boxAlamat.classList.add('hidden');
            mapDiv.style.display = 'none';
            document.getElementById('lat').value = '';
            document.getElementById('lng').value = '';
        }
        hitungTotal();
    }

    // Fungsi Format Rupiah
    const formatRupiah = (angka) => {
        return 'Rp. ' + new Intl.NumberFormat('id-ID').format(angka);
    }

function hitungTotal() {
    const valMulai = document.getElementById('tanggal_sewa').value;
    const durasiHari = parseInt(document.getElementById('durasi_hari').value) || 1;
    const hargaPerHari = parseInt(document.getElementById('harga_sewa').value) || 0;

    if (valMulai) {
        const tglMulai = new Date(valMulai);
       
        const tglKembali = new Date(tglMulai);
        tglKembali.setDate(tglMulai.getDate() + durasiHari);

        const year = tglKembali.getFullYear();
        const month = String(tglKembali.getMonth() + 1).padStart(2, '0');
        const day = String(tglKembali.getDate()).padStart(2, '0');
        const hours = String(tglKembali.getHours()).padStart(2, '0');
        const minutes = String(tglKembali.getMinutes()).padStart(2, '0');
        
        const formatKembali = `${year}-${month}-${day}T${hours}:${minutes}`;
        document.getElementById('tanggal_kembali').value = formatKembali;
        
        
        const jenisSewa = document.querySelector('input[name="jenis_sewa"]:checked').value;

        const totalSewa  = durasiHari * hargaPerHari;
        const totalSupir = 0;
        const totalAntar = 0;
        
        const grandTotal = totalSewa + totalSupir;
        const tipePembayaran = document.querySelector('input[name="tipe_pembayaran"]:checked').value;

        let dp = 0;
        let sisaBayar = 0;

        if (tipePembayaran === 'dp') {
            dp = grandTotal * 0.5; 
            sisaBayar = grandTotal - dp;
        } else {
            dp = grandTotal;
            sisaBayar = 0;
        }


        document.getElementById('text_durasi').innerText  = `(${durasiHari} hari)`;
        document.getElementById('summary_sewa').innerText  = formatRupiah(totalSewa);
        document.getElementById('summary_supir').innerText = formatRupiah(totalSupir);
        if (document.getElementById('summary_antar')) {
            document.getElementById('summary_antar').innerText = formatRupiah(totalAntar);
        }
        
        if (tipePembayaran === 'dp') {
            document.getElementById('summary_total').innerText = formatRupiah(dp);
        } else {
            document.getElementById('summary_total').innerText = formatRupiah(grandTotal);
        }
        
        if (tipePembayaran === 'dp') {
            document.getElementById('summary_dp').innerText = `Wajib DP 50%: ${formatRupiah(dp)}`;
        } else {
            document.getElementById('summary_dp').innerText = `Bayar Lunas: ${formatRupiah(dp)}`;
        }    
        
        if(document.getElementById('summary_sisa')) {
            document.getElementById('summary_sisa').innerText = `Sisa Pelunasan: ${formatRupiah(sisaBayar)}`;
        }
    } else {
        document.getElementById('tanggal_kembali').value = '';
    }
}

// Inisialisasi settingan waktu saat halaman dibuka
document.addEventListener('DOMContentLoaded', function() {
     const now = new Date(); now.setMinutes(now.getMinutes() - now.getTimezoneOffset()); 
     hitungTotal(); 
     document.getElementById('tanggal_sewa').min = now.toISOString().slice(0, 16);
      });
</script>
</x-user>