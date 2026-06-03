<x-user>
<div class="min-h-screen bg-[#F8FAFC] py-8 px-4 sm:px-6 lg:px-8 font-sans text-[#1A1916]">
    <div class="max-w-2xl mx-auto">
        
        {{-- Back & Title Header --}}
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('profile.user') }}" class="group w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 shadow-sm hover:border-[#F0820A] hover:shadow-md transition-all shrink-0">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-[#F0820A] transform group-hover:-translate-x-0.5 transition-all" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 12H5"/><path d="M12 5l-7 7 7 7"/>
                </svg>
            </a>
            
            <div>
                <h1 class="font-['Poppins'] text-2xl font-bold text-gray-900 tracking-tight leading-none">Atur Profile</h1>
                <p class="text-gray-500 mt-1 text-sm">Lengkapi profilmu yuk, biar proses booking makin lancar!</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            
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
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-4 rounded-xl mb-6 text-sm font-medium flex items-center gap-3">
                    <svg class="shrink-0 w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Profil Berhasil Diperbarui!
                </div>
            @endif

            <div class="flex items-center gap-3 mb-8 pb-4 border-b border-gray-50">
                <div class="bg-[#FEF0DC] text-[#D97706] w-11 h-11 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div>
                    <h3 class="font-['Poppins'] text-base font-bold text-gray-900 leading-none">Informasi Pribadi</h3>
                    <p class="text-xs text-gray-500 mt-1">Perbarui data diri kamu agar selalu akurat.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.user.update') }}">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-[#F0820A] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->nama) }}" 
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 font-medium text-sm rounded-xl pl-11 pr-4 py-3 outline-none focus:bg-white focus:border-[#F0820A] focus:ring-4 focus:ring-[#F0820A]/10 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Alamat Email</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-[#F0820A] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </div>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 font-medium text-sm rounded-xl pl-11 pr-4 py-3 outline-none focus:bg-white focus:border-[#F0820A] focus:ring-4 focus:ring-[#F0820A]/10 transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Nomor Telepon</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-[#F0820A] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.92 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                                    </svg>
                                </div>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $user->pelanggan->no_hp ?? '') }}" 
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 font-medium text-sm rounded-xl pl-11 pr-4 py-3 outline-none focus:bg-white focus:border-[#F0820A] focus:ring-4 focus:ring-[#F0820A]/10 transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-widest pl-1">Alamat Lengkap</label>
                        <div class="relative group">
                            <div class="absolute top-4 left-0 flex items-start pl-4 text-gray-400 group-focus-within:text-[#F0820A] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <textarea name="address" rows="4" placeholder="Masukkan alamat lengkap Anda"
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 font-medium text-sm rounded-xl pl-11 pr-4 py-3 outline-none focus:bg-white focus:border-[#F0820A] focus:ring-4 focus:ring-[#F0820A]/10 transition-all resize-none">{{ old('address', $user->pelanggan->alamat ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row gap-3 mt-7 pt-5 border-t border-gray-100">
                    <a href="{{ route('profile.user') }}" 
                    class="flex-1 flex items-center justify-center bg-white text-gray-700 border border-gray-200 text-xs font-bold tracking-widest uppercase py-2.5 px-4 rounded-lg hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="flex-1 flex items-center justify-center bg-primary text-white py-2.5 rounded-xl font-semibold hover:bg-accent transition-colors">                     
                            Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-user>