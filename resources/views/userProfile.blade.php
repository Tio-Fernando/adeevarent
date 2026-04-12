<x-user>
    <div class="min-h-screen bg-[#FAFAF8] py-10 px-4 text-[#1A1916] font-sans">
        
        {{-- Pesan Sukses Update Profil --}}
        @if (session('status') === 'profile-updated')
            <div class="max-w-5xl mx-auto mb-6">
                <div class="bg-[#ECFDF5] border border-[#A7F3D0] rounded-2xl p-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span class="text-[#059669] text-sm font-medium">Profil berhasil diperbarui!</span>
                </div>
            </div>
        @endif

        {{-- Header Section --}}
        <div class="max-w-5xl mx-auto mb-9 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-[#E4E2DC] rounded-xl text-[#6B6860] hover:border-[#C4A97D] hover:text-[#1A1916] hover:-translate-x-0.5 transition-all shadow-sm shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"/><path d="M12 5l-7 7 7 7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="font-['Poppins'] text-2xl md:text-[26px] font-bold text-[#1A1916] tracking-tight leading-tight">Profile Saya</h1>
                    <p class="text-[13px] text-[#8C8882] mt-1">Kelola informasi pribadi dan keamanan akun Anda.</p>
                </div>
            </div>
            <a href="{{ route('profile.user.edit') }}" class="inline-flex items-center justify-center gap-2 bg-[#1A1916] text-white text-xs font-semibold tracking-wider uppercase px-5 py-3 rounded-xl hover:bg-[#333028] hover:-translate-y-px transition-all shadow-lg shadow-black/10 whitespace-nowrap">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit Profil
            </a>
        </div>

        {{-- Main Grid --}}
        <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-6 items-start">

            {{-- SIDEBAR: Info User --}}
            <div class="sticky top-6">
                <div class="bg-white rounded-[20px] border border-[#E8E6E0] overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    {{-- Cover Pattern --}}
                    <div class="h-24 bg-gradient-to-br from-[#F0820A] via-[#C45E00] to-[#8B3E00] relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 18px, #fff 18px, #fff 19px);"></div>
                    </div>
                    
                    <div class="px-7 pb-7 text-center -mt-11 relative z-10">
                        <img class="w-[88px] h-[88px] rounded-full border-4 border-white object-cover shadow-lg inline-block bg-white"
                             src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=F0820A&color=fff&size=128"
                             alt="{{ $user->name }}">

                        <div class="font-['Poppins'] text-[17px] font-bold text-[#1A1916] tracking-tight mt-3 mb-1">{{ $user->name }}</div>
                        <div class="text-[12.5px] text-[#8C8882] mb-4.5">{{ $user->email }}</div>

                        <div class="flex items-center justify-center gap-2.5 bg-[#F7F6F2] border border-[#ECEAE3] rounded-xl py-2.5 px-3 mb-5">
                            <span class="text-[10px] font-bold tracking-wider uppercase bg-[#FEF0DC] text-[#A0520A] border border-[#F7D99A] px-2.5 py-1 rounded-md">{{ $user->role ?? 'Pelanggan' }}</span>
                            <span class="text-[#D4D0C8] text-xs">|</span>
                            <span class="text-xs text-[#8C8882] font-medium">Gabung {{ $user->created_at->format('M Y') }}</span>
                        </div>

                        <div class="flex flex-col gap-2 mb-5">
                            <div class="flex items-center gap-2.5 bg-[#F7F6F2] border border-[#ECEAE3] rounded-xl py-2.5 px-3.5 text-left">
                                <div class="w-8 h-8 rounded-lg bg-[#EDEAE2] flex items-center justify-center text-[#7A7771] shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                </div>
                                <span class="text-[12.5px] text-[#3A3834] font-medium truncate">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-[#F7F6F2] border border-[#ECEAE3] rounded-xl py-2.5 px-3.5 text-left">
                                <div class="w-8 h-8 rounded-lg bg-[#EDEAE2] flex items-center justify-center text-[#7A7771] shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.92 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </div>
                                <span class="text-[12.5px] text-[#3A3834] font-medium truncate">{{ $user->phone ?? 'Belum diisi' }}</span>
                            </div>
                        </div>

                        <hr class="border-t border-[#ECEAE3] my-5">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 bg-[#FFF5F5] border border-[#FECACA] text-[#C81E1E] text-xs font-bold tracking-wider uppercase rounded-xl hover:bg-[#FEE2E2] hover:border-[#FCA5A5] transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Keluar dari Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- KONTEN KANAN --}}
            <div class="flex flex-col gap-6">

                {{-- Card: Detail Info Pribadi --}}
                <div class="bg-white rounded-[20px] border border-[#E8E6E0] shadow-sm hover:shadow-md transition-shadow p-8">
                    <div class="flex items-center gap-3.5 pb-5 border-b border-[#ECEAE3] mb-7">
                        <div class="w-11 h-11 rounded-xl bg-[#FEF0DC] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-[#D97706]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/></svg>
                        </div>
                        <div>
                            <div class="font-['Poppins'] text-base font-bold text-[#1A1916] tracking-tight">Detail Informasi Pribadi</div>
                            <div class="text-[12.5px] text-[#8C8882] mt-0.5">Data dasar akun Anda yang digunakan untuk layanan.</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="col-span-1 md:col-span-2">
                            <div class="text-[10.5px] font-bold tracking-widest uppercase text-[#A09C95] mb-2 pl-0.5">Nama Lengkap</div>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/></svg>
                                </span>
                                <input type="text" value="{{ $user->name }}" readonly class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-[#1A1916] text-sm font-medium rounded-xl py-3.5 pr-4 pl-11 outline-none cursor-not-allowed">
                            </div>
                        </div>

                        <div>
                            <div class="text-[10.5px] font-bold tracking-widest uppercase text-[#A09C95] mb-2 pl-0.5">Alamat Email</div>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                </span>
                                <input type="email" value="{{ $user->email }}" readonly class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-[#1A1916] text-sm font-medium rounded-xl py-3.5 pr-4 pl-11 outline-none cursor-not-allowed">
                            </div>
                        </div>

                        <div>
                            <div class="text-[10.5px] font-bold tracking-widest uppercase text-[#A09C95] mb-2 pl-0.5">No. WhatsApp</div>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.92 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                <input type="text" value="{{ $user->phone ?? '-' }}" readonly class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-[#1A1916] text-sm font-medium rounded-xl py-3.5 pr-4 pl-11 outline-none cursor-not-allowed">
                            </div>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <div class="text-[10.5px] font-bold tracking-widest uppercase text-[#A09C95] mb-2 pl-0.5">Alamat Lengkap</div>
                            <div class="relative">
                                <span class="absolute left-4 top-4 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 13-8 13s-8-7-8-13a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                <textarea rows="3" readonly class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-[#1A1916] text-sm font-medium rounded-xl py-3.5 pr-4 pl-11 outline-none cursor-not-allowed resize-none">{{ $user->pelanggan->alamat ?? '-' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card: Keamanan Akun --}}
                <div class="bg-white rounded-[20px] border border-[#E8E6E0] shadow-sm hover:shadow-md transition-shadow p-8">
                    <div class="flex items-center gap-3.5 pb-5 border-b border-[#ECEAE3] mb-7">
                        <div class="w-11 h-11 rounded-xl bg-[#FFF1F2] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-[#DC2626]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><rect x="9" y="11" width="6" height="5" rx="1"/><path d="M12 11V9a2 2 0 0 0-4 0v2"/></svg>
                        </div>
                        <div>
                            <div class="font-['Poppins'] text-base font-bold text-[#1A1916] tracking-tight">Keamanan Akun</div>
                            <div class="text-[12.5px] text-[#8C8882] mt-0.5">Pastikan kata sandi Anda kuat untuk melindungi akun.</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-[#F7F6F2] border border-[#ECEAE3] rounded-2xl py-4 px-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#EDEAE2] rounded-xl flex items-center justify-center text-[#7A7771] shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="7.5" cy="15.5" r="5.5"/><path d="m21 2-9.6 9.6"/><path d="m15.5 7.5 3 3L22 7l-3-3"/></svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-[#1A1916]">Kata Sandi (Password)</div>
                                <div class="text-xs text-[#8C8882] mt-0.5">Ganti kata sandi secara berkala demi keamanan akun.</div>
                            </div>
                        </div>
                        {{-- Sesuaikan link ubah password jika ada route-nya --}}
                        <a href="#" class="w-full sm:w-auto text-center bg-white border border-[#DDD9D0] text-[#3A3834] text-[12.5px] font-semibold px-4 py-2.5 rounded-xl hover:border-[#C4A97D] hover:shadow-sm transition-all whitespace-nowrap">Ubah Sandi</a>
                    </div>
                </div>

                {{-- Card: Riwayat Mobil (Terintegrasi $riwayat) --}}
                <div class="bg-white rounded-[20px] border border-[#E8E6E0] shadow-sm hover:shadow-md transition-shadow p-8">
                    <div class="flex items-center gap-3.5 pb-5 border-b border-[#ECEAE3] mb-7">
                        <div class="w-11 h-11 rounded-xl bg-[#FEF0DC] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-[#D97706]" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-1"/><path d="M13 1h-2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2z"/><path d="m5 8-3 4v5a2 2 0 0 0 2 2h4"/><circle cx="5" cy="13" r="1"/></svg>
                        </div>
                        <div>
                            <div class="font-['Poppins'] text-base font-bold text-[#1A1916] tracking-tight">Riwayat Penyewaan Mobil</div>
                            <div class="text-[12.5px] text-[#8C8882] mt-0.5">Daftar kendaraan yang pernah Anda sewa.</div>
                        </div>
                    </div>

                   <div class="space-y-4">
                        @forelse ($riwayat as $sewa)
                            <div class="bg-[#F7F6F2] border border-[#ECEAE3] rounded-2xl p-4 flex flex-col sm:flex-row items-center gap-4">
                                {{-- Gambar --}}
                                <div class="w-full sm:w-[100px] h-[70px] bg-white border rounded-xl overflow-hidden flex items-center justify-center">
                                    @if($sewa->kendaraan && $sewa->kendaraan->dir)
                                        <img src="{{ asset('storage/' . $sewa->kendaraan->dir) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xs text-gray-400">No Image</span>
                                    @endif
                                </div>

                                {{-- Detail --}}
                                {{-- Detail --}}
<div class="flex-1 w-full">
    <div class="flex justify-between items-start mb-1">
        <div class="text-sm font-bold text-[#1A1916]">{{ $sewa->kendaraan->nama_kendaraan ?? 'Mobil' }}</div>
        
        {{-- LOGIKA TAMPILAN HARGA --}}
        @if($sewa->status == 'Dibayar' || $sewa->payments()->where('status_pembayaran', 'DP')->where('transaction_status', 'settlement')->exists())
            {{-- Jika sudah DP, tampilkan SISA TAGIHAN --}}
            <div class="font-bold text-[#D97706] text-sm">
                Rp {{ number_format($sewa->sisa_tagihan, 0, ',', '.') }}
                <span class="block text-[9px] text-gray-400 font-normal mt-0.5 text-right">Sisa Tagihan</span>
            </div>
        @else
            {{-- Jika belum DP atau sudah lunas total, tampilkan TOTAL HARGA --}}
            <div class="font-bold text-[#D97706] text-sm">
                Rp {{ number_format($sewa->harga_total, 0, ',', '.') }}
            </div>
        @endif
    </div>
    
    <div class="text-[11px] text-[#8C8882] flex gap-4 mb-2">
        <span>📅 {{ \Carbon\Carbon::parse($sewa->tgl_sewa)->format('d M') }} - {{ \Carbon\Carbon::parse($sewa->jadwal_kembali)->format('d M') }}</span>
        <span>📍 {{ $sewa->opsi_pengantaran }}</span>
    </div>
    
    <div class="flex items-center justify-between">
        {{-- LOGIKA STATUS & TOMBOL --}}
        @php
            $sudahDP = $sewa->payments()->where('status_pembayaran', 'DP')->where('transaction_status', 'settlement')->exists();
        @endphp

        @if(in_array(strtolower($sewa->status), ['selesai', 'lunas']))
            <span class="text-[10px] font-bold bg-green-100 text-green-700 px-2.5 py-1 rounded-md border border-green-200 uppercase">SELESAI LUNAS</span>
            
        @elseif(strtolower($sewa->status) == 'dp' || $sudahDP)
            <span class="text-[10px] font-bold bg-blue-100 text-blue-700 px-2.5 py-1 rounded-md border border-blue-200 uppercase">MENUNGGU PELUNASAN</span>
            <a href="{{ route('payment', $sewa->id) }}" class="text-[11px] font-bold bg-[#D97706] text-white px-3 py-1.5 rounded-lg shadow-sm hover:bg-[#B45309] transition-colors">Bayar Pelunasan</a>
            
        @elseif(strtolower($sewa->status) == 'booking')
            <span class="text-[10px] font-bold bg-orange-100 text-orange-700 px-2.5 py-1 rounded-md border border-orange-200 uppercase">MENUNGGU DP</span>
            <a href="{{ route('payment', $sewa->id) }}" class="text-[11px] font-bold bg-[#1A1916] text-white px-3 py-1.5 rounded-lg shadow-sm hover:bg-black transition-colors">Bayar DP Sekarang</a>
            
        @else
            <span class="text-[10px] font-bold bg-gray-100 text-gray-500 px-2.5 py-1 rounded-md border border-gray-200 uppercase">{{ $sewa->status }}</span>
        @endif
    </div>
</div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-gray-500 text-sm">Belum ada riwayat penyewaan.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-user>