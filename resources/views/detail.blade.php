<x-user-layout>
    <div class="max-w-5xl mx-auto px-4 py-8 font-sans">
        
        {{-- BAGIAN ATAS: Info Mobil & Spesifikasi --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">
            
            {{-- Kiri: Foto & Harga --}}
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-4xl font-extrabold text-gray-900">Innova Reborn</h1>
                    <span class="bg-green-200 text-green-700 text-xs font-bold px-3 py-1 rounded-md">FREE</span>
                </div>
                <div class="text-3xl font-bold text-orange-500 mb-6">
                    Rp. 300.000 <span class="text-base text-gray-400 font-normal">/ hari</span>
                </div>
                
                {{-- Placeholder gambar mobil, silakan ganti src-nya sesuai asset kamu --}}
                <div class="w-full h-auto">
                    <img src="https://i.ibb.co/L5Q8sXV/innova.png" alt="Innova Reborn" class="w-full object-contain drop-shadow-xl">
                </div>
            </div>

            {{-- Kanan: Spesifikasi --}}
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4">Spesifikasi</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    {{-- Card Transmisi --}}
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Transmisi</p>
                        <p class="text-xs text-gray-500">Automat</p>
                    </div>

                    {{-- Card Bahan Bakar --}}
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v8l9-11h-7z" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Bahan Bakar</p>
                        <p class="text-xs text-gray-500">Bensin</p>
                    </div>

                    {{-- Card Warna --}}
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Warna</p>
                        <p class="text-xs text-gray-500">Putih</p>
                    </div>

                    {{-- Card AC --}}
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Air Conditioner</p>
                        <p class="text-xs text-gray-500">Yes</p>
                    </div>

                    {{-- Card Tahun --}}
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <svg class="w-6 h-6 text-gray-700 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm font-bold text-gray-900">Tahun</p>
                        <p class="text-xs text-gray-500">2024</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN TENGAH: Rental Duration --}}
        <div class="mb-8">
            <h3 class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-3">Rental Duration</h3>
            <div class="bg-gray-100 rounded-2xl flex flex-col md:flex-row border border-gray-200 overflow-hidden">
                <div class="flex-1 p-5 border-b md:border-b-0 md:border-r border-gray-200">
                    <p class="text-xs text-gray-500 mb-1">Pick-up</p>
                    <p class="text-base font-bold text-gray-900">Oct 12, 2023</p>
                    <p class="text-sm text-gray-500">09:00 AM</p>
                </div>
                <div class="flex-1 p-5">
                    <p class="text-xs text-gray-500 mb-1">Return</p>
                    <p class="text-base font-bold text-gray-900">Oct 15, 2023</p>
                    <p class="text-sm text-gray-500">05:00 PM</p>
                </div>
            </div>
        </div>

        {{-- BAGIAN BAWAH: Locations --}}
        <div class="mb-10">
            <h3 class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-4">Locations</h3>
            <div class="relative pl-4">
                {{-- Garis vertikal penghubung --}}
                <div class="absolute left-[1.6rem] top-8 bottom-8 w-0.5 border-l-2 border-dashed border-gray-300"></div>

                {{-- Pick-up Location --}}
                <div class="flex gap-4 items-start mb-6">
                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 relative z-10">
                        <svg class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-0.5">Pick-up Location</p>
                        <p class="text-sm font-bold text-gray-900">Soekarno-Hatta Airport Terminal 3</p>
                        <p class="text-xs text-gray-500">Tangerang, Banten, Indonesia</p>
                    </div>
                </div>

                {{-- Drop-off Location --}}
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center flex-shrink-0 relative z-10">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-0.5">Drop-off Location</p>
                        <p class="text-sm font-bold text-gray-900">Grand Indonesia Mall</p>
                        <p class="text-xs text-gray-500">Menteng, Central Jakarta, Indonesia</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAGIAN PEMBAYARAN: Payment Summary --}}
        <div class="mb-8">
            <h3 class="text-xs font-bold text-orange-500 uppercase tracking-widest mb-3">Payment Summary</h3>
            <div class="bg-gray-100 p-5 rounded-2xl border border-gray-200">
                <div class="flex justify-between items-center mb-3">
                    <p class="text-sm text-gray-600">Harga Sewa (Rp 300.000 × 3 hari)</p>
                    <p class="text-sm font-bold text-gray-800">Rp. 900.000</p>
                </div>
                <div class="flex justify-between items-center mb-5">
                    <p class="text-sm text-gray-600">Biaya Layanan</p>
                    <p class="text-sm font-bold text-gray-800">Rp. 20.000</p>
                </div>
                
                <div class="border-t border-gray-300 pt-5 flex justify-between items-end">
                    <div>
                        <p class="text-base font-bold text-gray-900 mb-1">Total Paid</p>
                        <div class="flex items-center gap-2 text-xs text-gray-600">
                            {{-- Placeholder Icon Bank --}}
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4 10h16v2H4v-2zm0 4h16v2H4v-2zm0-8h16v2H4V6zm0 12h16v2H4v-2z"/></svg>
                            <span>BCA •••• 4242</span>
                        </div>
                    </div>
                    <div class="text-2xl font-extrabold text-orange-500">
                        Rp. 920.000
                    </div>
                </div>
            </div>
        </div>

       
        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold text-lg py-4 rounded-xl transition duration-200 shadow-md">
            Bayar Sekarang
        </button>

    </div>
</x-user-layout>