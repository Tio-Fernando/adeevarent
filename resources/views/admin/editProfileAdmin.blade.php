<x-app-layout>
    <div class="min-h-screen bg-[#FAFAF8] py-10 px-4 text-[#1A1916] font-sans">
        
        <div class="max-w-5xl mx-auto mb-9 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.profile') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-[#E4E2DC] rounded-xl text-[#6B6860] hover:border-[#C4A97D] hover:text-[#1A1916] transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M19 12H5"/><path d="M12 5l-7 7 7 7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="font-['Poppins'] text-2xl md:text-[26px] font-bold text-[#1A1916]">Edit Profil Admin</h1>
                    <p class="text-[13px] text-[#8C8882] mt-1">Perbarui informasi profil Anda di sini.</p>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-[20px] border border-[#E8E6E0] p-8 shadow-sm">
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm font-medium flex items-start gap-3">
                        <svg class="shrink-0 w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status') === 'profile-updated')
                    <div class="bg-[#ECFDF5] border border-[#A7F3D0] rounded-2xl p-4 flex items-center gap-3 mb-6">
                        <svg class="w-5 h-5 text-[#059669]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <span class="text-[#059669] text-sm font-medium">Profil berhasil diperbarui!</span>
                    </div>
                @endif

                <div class="flex items-center gap-3.5 pb-5 border-b border-[#ECEAE3] mb-7">
                    <div class="w-11 h-11 rounded-xl bg-[#FEF0DC] flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-[#D97706]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-['Poppins'] text-base font-bold text-[#1A1916]">Informasi Profil</div>
                        <div class="text-[12.5px] text-[#8C8882]">Perbarui informasi profil dan nomor telepon Anda.</div>
                    </div>
                </div>

                <form method="post" action="{{ route('admin.profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Nama --}}
                        <div>
                            <label class="text-[10.5px] font-bold tracking-widest uppercase text-[#A09C95] mb-2 block">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </span>
                                <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-sm rounded-xl py-3.5 pl-11 outline-none focus:border-[#C4A97D] focus:ring-2 focus:ring-[#C4A97D] transition" required>
                            </div>
                            @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-[10.5px] font-bold tracking-widest uppercase text-[#A09C95] mb-2 block">Email</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </span>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-sm rounded-xl py-3.5 pl-11 outline-none focus:border-[#C4A97D] focus:ring-2 focus:ring-[#C4A97D] transition" required>
                            </div>
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="pt-2 flex gap-3">
                        <a href="{{ route('admin.profile') }}" class="flex-1 text-center bg-[#F7F6F2] border border-[#E4E2DC] text-[#3A3834] text-sm font-semibold py-3 rounded-xl hover:bg-[#EDEAE2] transition-all">Batal</a>
                        <button type="submit" class="flex-1 bg-[#F0820A] hover:bg-[#D97706] active:scale-95 transition text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-orange-500/20 text-sm">
                            SIMPAN PERUBAHAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
