<x-user>
<div class="min-h-screen bg-[#F8FAFC] py-8 px-4 sm:px-6 lg:px-8 font-['Inter',sans-serif]">
    <div class="max-w-2xl mx-auto">
        
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('profile.user') }}" class="group size-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 shadow-sm hover:border-primary hover:shadow-md transition-all duration-200 shrink-0">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-primary transform group-hover:-translate-x-0.5 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            
            <div>
                <h1 class="font-['Poppins',sans-serif] text-2xl font-bold text-gray-900 tracking-tight leading-none">Edit Profil</h1>
                <p class="text-gray-500 mt-0.5 text-sm font-normal">Perbarui informasi pribadi Anda.</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-3.5 rounded-lg mb-5 text-sm font-medium flex items-start gap-2.5">
                    <svg class="mt-0.5 shrink-0 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (session('status') === 'profile-updated')
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-3.5 rounded-lg mb-5 text-sm font-medium flex items-center gap-2.5">
                    <svg class="shrink-0 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Profil berhasil diperbarui!
                </div>
            @endif

            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="bg-orange-50 text-primary size-11 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <h3 class="font-['Poppins',sans-serif] text-base font-bold text-gray-900 leading-none">Informasi Pribadi</h3>
                    <p class="text-xs text-gray-500 font-normal mt-0.5">Perbarui data pribadi Anda.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.user.update') }}">
                @csrf
                @method('PATCH')

                <div class="space-y-5">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-0.5">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                                <svg class="w-10 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 25"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap Anda"
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 font-medium text-sm rounded-lg pl-10 pr-4 py-2.5 outline-none focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                        </div>
                        @error('name') <div class="text-[10px] text-red-600 mt-1 pl-0.5 font-medium">{{ $message }}</div> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-0.5">Alamat Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                                    <svg width="35" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                    </svg>
                                </div>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email"
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 font-medium text-sm rounded-lg pl-10 pr-4 py-2.5 outline-none focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                            </div>
                            @error('email') <div class="text-[10px] text-red-600 mt-1 pl-0.5 font-medium">{{ $message }}</div> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-0.5">No. Telepon</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400">
                                    <svg class="w-10 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" placeholder="08123456789"
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 font-medium text-sm rounded-lg pl-10 pr-4 py-2.5 outline-none focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                            </div>
                            @error('phone') <div class="text-[10px] text-red-600 mt-1 pl-0.5 font-medium">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold text-gray-500 uppercase tracking-widest pl-0.5">Alamat Lengkap</label>
                        <div class="relative">
                            <div class="absolute top-3.5 left-0 flex items-start pl-3.5 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <textarea name="address" rows="4" placeholder="Masukkan alamat lengkap Anda"
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 font-medium text-sm rounded-lg pl-10 pr-4 py-2.5 outline-none focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all resize-none">{{ old('address', $user->pelanggan->alamat ?? '') }}</textarea>
                        </div>
                        @error('address') <div class="text-[10px] text-red-600 mt-1 pl-0.5 font-medium">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row gap-3 mt-7 pt-5 border-t border-gray-100">
                    <a href="{{ route('profile.user') }}" 
                    class="flex-1 flex items-center justify-center bg-white text-gray-700 border border-gray-200 text-xs font-bold tracking-widest uppercase py-2.5 px-4 rounded-lg hover:border-gray-300 hover:bg-gray-50 hover:text-gray-900 transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit" 
                            class="flex-1 flex items-center justify-center bg-primary text-white py-2.5 rounded-xl font-semibold hover:bg-accent transition-colors">                     
                            Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-user>