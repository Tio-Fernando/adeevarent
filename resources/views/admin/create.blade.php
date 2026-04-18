<x-superadmin>
  
    <div class="p-6 max-w-2xl mx-auto">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.index') }}"
                class="p-1.5 rounded-lg border border-gray-200 text-gray-400 hover:text-gray-600 hover:bg-gray-50 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-medium text-gray-800">Tambah Pengguna</h1>
                <p class="text-xs text-gray-400 mt-0.5">Isi data di bawah untuk menambahkan akun admin baru</p>
            </div>
        </div>


        
        @if (session('error'))
            <div class="mb-4 flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

    
        <div class="flex justify-center items-center">
            <div class="bg-white border flex justify-center border-gray-100 rounded-2xl p-6">
        
                <form method="POST" action="{{ route('superadmin.admin.store') }}" class="flex flex-col gap-5">
                    @csrf
        
                    {{-- Nama --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="nama" class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                            Nama Lengkap <span class="text-red-400">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="cth. Budi Santoso"
                            class="border rounded-lg px-3 py-2.5 text-sm text-gray-800 transition
                                   focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent
                                   {{ $errors->has('nama') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}">
                        @error('nama')
                            <span class="text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
        
                    {{-- Email --}}
                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                            Email <span class="text-red-400">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="cth. budi@gmail.com"
                            class="border rounded-lg px-3 py-2.5 text-sm text-gray-800 transition
                                   focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent
                                   {{ $errors->has('email') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}">
                        @error('email')
                            <span class="text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
        
                    {{-- Password + Konfirmasi --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1.5">
                            <label for="password" class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Password <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password" placeholder="Min. 8 karakter" class="w-full border rounded-lg px-3 py-2.5 text-sm text-gray-800 transition
                                           focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent
                                           {{ $errors->has('password') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}">
                                <button type="button" onclick="togglePassword('password', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-10.07.01C6.27 8.48 8.91 6 12 6s5.73 2.48 7.07 6.01C17.73 15.52 15.09 18 12 18s-5.73-2.48-7.07-5.99z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
        
                        <div class="flex flex-col gap-1.5">
                            <label for="password_confirmation"
                                class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Konfirmasi <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Ulang password" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm text-gray-800 transition
                                           focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent">
                                <button type="button" onclick="togglePassword('password_confirmation', this)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-10.07.01C6.27 8.48 8.91 6 12 6s5.73 2.48 7.07 6.01C17.73 15.52 15.09 18 12 18s-5.73-2.48-7.07-5.99z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
        
                    {{-- Level + Status --}}
                    <input type="hidden" name="level" value="Administrator">
                <input type="hidden" name="status" value="aktif">
        
                    <hr class="border-gray-100">
                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.index') }}"
                            class="px-5 py-2.5 border border-gray-200 rounded-lg text-sm text-gray-500 hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-orange-500 hover:bg-orange-600 active:scale-95
                                   text-white text-sm font-medium rounded-lg transition">
                            Simpan Pengguna
                        </button>
                    </div>
        
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            btn.querySelector('svg path').setAttribute('d',
                isPassword
                    ? 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21'
                    : 'M15 12a3 3 0 11-6 0 3 3 0 016 0zm-10.07.01C6.27 8.48 8.91 6 12 6s5.73 2.48 7.07 6.01C17.73 15.52 15.09 18 12 18s-5.73-2.48-7.07-5.99z'
            );
        }
    </script>
</x-superadmin>