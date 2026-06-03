<x-user>
    <div class="min-h-screen bg-[#FAFAF8] py-10 px-4 text-[#1A1916] font-sans">
        
        <div id="toast-container" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex flex-col items-center"></div>

            <style>
            @keyframes toast-in {
                0% {
                    transform: translateY(-20px) scale(0.95);
                    opacity: 0;
                }
                60% {
                    transform: translateY(5px) scale(1.02);
                    opacity: 1;
                }
                100% {
                    transform: translateY(0) scale(1);
                }
            }

            @keyframes toast-out {
                to {
                    transform: translateY(-20px);
                    opacity: 0;
                }
            }

            .toast {
                animation: toast-in 0.4s ease-out, toast-out 0.4s ease-in 2.6s forwards;
            }
            </style>

        <div class="max-w-5xl mx-auto mb-9 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="w-10 h-10 flex items-center justify-center bg-white border border-[#E4E2DC] rounded-xl text-[#6B6860] hover:border-[#C4A97D] hover:text-[#1A1916] transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M19 12H5"/><path d="M12 5l-7 7 7 7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="font-['Poppins'] text-2xl md:text-[26px] font-bold text-[#1A1916]">Profil Saya</h1>
                    <p class="text-[13px] text-[#8C8882] mt-1">Atur data diri dan setelan akunmu di sini ya.</p>
                </div>
            </div>
            <a href="{{ route('profile.user.edit') }}" 
            class="inline-flex items-center gap-2 bg-[#F0820A] hover:bg-[#D97706] active:scale-95 transition text-white font-bold py-2.5 px-5 rounded-xl shadow-lg shadow-orange-500/20 text-sm">
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit Profil
            </a>
        </div>

        <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-6 items-start">

            <div class="sticky top-6">
                <div class="bg-white rounded-[20px] border border-[#E8E6E0] overflow-hidden shadow-sm">
                    <div class="h-24 bg-gradient-to-br from-[#F0820A] via-[#C45E00] to-[#8B3E00] relative"></div>
                    
                    <div class="px-7 pb-7 text-center -mt-11 relative z-10">
                        <img class="w-[88px] h-[88px] rounded-full border-4 border-white object-cover shadow-lg inline-block bg-white"
                             src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=F0820A&color=fff&size=128">

                        <div class="font-['Poppins'] text-[17px] font-bold text-[#1A1916] mt-3 mb-1">{{ $user->nama }}</div>
                        <div class="text-[12.5px] text-[#8C8882] mb-4">{{ $user->email }}</div>

                        <div class="flex items-center justify-center gap-2.5 bg-[#F7F6F2] border border-[#ECEAE3] rounded-xl py-2 px-3 mb-5">
                            <span class="text-[10px] font-bold uppercase bg-[#FEF0DC] text-[#A0520A] px-2.5 py-1 rounded-md">PELANGGAN</span>
                            <span class="text-xs text-[#8C8882]">Joined{{ $user->created_at->format('M Y') }}</span>
                        </div>

                        <div class="flex flex-col gap-2 mb-5">
                            <div class="flex items-center gap-2.5 bg-[#F7F6F2] border border-[#ECEAE3] rounded-xl py-2 px-3 text-left">
                                <div class="w-8 h-8 rounded-lg bg-[#EDEAE2] flex items-center justify-center text-[#7A7771] shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </div>
                                <span class="text-[12.5px] text-[#3A3834] truncate">{{ $user->email }}</span>
                            </div>
                         <div class="flex items-center gap-2.5 bg-[#F7F6F2] border border-[#ECEAE3] rounded-xl py-2 px-3 text-left">
    
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0
                            {{ $user->status ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">           
                            @if($user->status)
                           
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                            @else

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            @endif
                        </div>

                        <span class="text-[12.5px] font-medium truncate
                            {{ $user->status ? 'text-green-700' : 'text-red-700' }}">
                            
                            {{ $user->status ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 bg-[#FFF5F5] border border-[#FECACA] text-[#C81E1E] text-xs font-bold uppercase rounded-xl hover:bg-[#FEE2E2] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-6">

                {{-- Detail Info Pribadi --}}
                <div class="bg-white rounded-[20px] border border-[#E8E6E0] p-8 shadow-sm">
                    <div class="flex items-center gap-3.5 pb-5 border-b border-[#ECEAE3] mb-7">
                        <div class="w-11 h-11 rounded-xl bg-[#FEF0DC] flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-[#D97706]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-['Poppins'] text-base font-bold text-[#1A1916]">Informasi Pribadi</div>
                            <div class="text-[12.5px] text-[#8C8882]">Data dasar akunmu yang kami gunakan untuk layanan rental.</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Input Nama --}}
                        <div class="col-span-2">
                            <div class="text-[10.5px] font-bold tracking-widest uppercase text-[#A09C95] mb-2">Nama Lengkap</div>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </span>
                                <input type="text" value="{{ $user->nama }}" readonly class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-sm rounded-xl py-3.5 pl-11 outline-none cursor-not-allowed">
                            </div>
                        </div>

                        {{-- Input Email --}}
                        <div>
                            <div class="text-[10.5px] font-bold uppercase text-[#A09C95] mb-2">Email</div>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </span>
                                <input type="email" value="{{ $user->email }}" readonly class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-sm rounded-xl py-3.5 pl-11 outline-none cursor-not-allowed">
                            </div>
                        </div>

                        {{-- Input WhatsApp --}}
                        <div>
                            <div class="text-[10.5px] font-bold uppercase text-[#A09C95] mb-2">Nomor Telepon</div>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.92 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                                    </svg>
                                </span>
                                <input type="text" value="{{ $user->pelanggan->no_hp ?? '-' }}" readonly class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-sm rounded-xl py-3.5 pl-11 outline-none cursor-not-allowed">
                            </div>
                        </div>

                        {{-- Input Alamat --}}
                        <div class="col-span-2">
                            <div class="text-[10.5px] font-bold uppercase text-[#A09C95] mb-2">Alamat Lengkap</div>
                            <div class="relative">
                                <span class="absolute left-4 top-4 text-[#B8B4AC]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                                    </svg>
                                </span>
                                <textarea rows="3" readonly class="w-full bg-[#F7F6F2] border border-[#E8E6E0] text-sm rounded-xl py-3.5 pl-11 outline-none cursor-not-allowed resize-none">{{ $user->pelanggan->alamat ?? '-' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keamanan Akun --}}
                <div class="bg-white rounded-[20px] border border-[#E8E6E0] p-8 shadow-sm">
                    <div class="flex items-center gap-3.5 pb-5 border-b border-[#ECEAE3] mb-7">
                        <div class="w-11 h-11 rounded-xl bg-[#FFF1F2] flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-[#DC2626]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><rect x="9" y="11" width="6" height="5" rx="1"/><path d="M12 11V9a2 2 0 0 0-4 0v2"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-['Poppins'] text-base font-bold text-[#1A1916]">Keamanan Akun</div>
                            <div class="text-[12.5px] text-[#8C8882]">Yuk, pastiin akunmu tetap aman dengan pakai password yang kuat.</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-[#F7F6F2] border border-[#ECEAE3] rounded-2xl py-4 px-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#EDEAE2] rounded-xl flex items-center justify-center text-[#7A7771] shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-[#1A1916]">Password</div>
                                <div class="text-xs text-[#8C8882]">Perbarui password-mu supaya akun tetap terlindungi.</div>
                            </div>
                        </div>
                        <button onclick="openPasswordModal()" class="w-full sm:w-auto text-center bg-white border border-[#DDD9D0] text-[#3A3834] text-[12.5px] font-semibold px-4 py-2.5 rounded-xl hover:border-[#C4A97D] transition-all">Change Password</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-[20px] border border-[#E8E6E0] max-w-md w-full shadow-xl">
            <div class="p-6 border-b border-[#ECEAE3]">
                <div class="flex items-center justify-between">
                    <h3 class="font-['Poppins'] text-lg font-bold text-[#1A1916]">Ganti Password</h3>
                    <button onclick="closePasswordModal()" class="w-8 h-8 flex items-center justify-center text-[#8C8882] hover:text-[#1A1916] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <p class="text-[12.5px] text-[#8C8882] mt-1">Perbarui password-mu supaya akun tetap terlindungi.</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="p-6 space-y-4">
                @csrf

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-semibold text-[#1A1916] mb-2">Password Saat Ini</label>
                    <input id="current_password" name="current_password" type="password" class="w-full px-4 py-3 border border-[#E4E2DC] rounded-xl focus:ring-2 focus:ring-[#C4A97D] focus:border-[#C4A97D] transition-all @error('current_password') border-red-500 @enderror" required>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-[#1A1916] mb-2">Password Baru</label>
                    <input id="password" name="password" type="password" class="w-full px-4 py-3 border border-[#E4E2DC] rounded-xl focus:ring-2 focus:ring-[#C4A97D] focus:border-[#C4A97D] transition-all @error('password') border-red-500 @enderror" required>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-[#1A1916] mb-2">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-3 border border-[#E4E2DC] rounded-xl focus:ring-2 focus:ring-[#C4A97D] focus:border-[#C4A97D] transition-all @error('password_confirmation') border-red-500 @enderror" required>
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closePasswordModal()" class="flex-1 bg-[#F7F6F2] border border-[#E4E2DC] text-[#3A3834] text-sm font-semibold py-3 rounded-xl hover:bg-[#EDEAE2] transition-all">Cancel</button>
                    <button type="submit" class="flex-1 bg-[#1A1916] text-white text-sm font-semibold py-3 rounded-xl hover:bg-[#333028] transition-all">Simpan Password</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');

        let bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';

        toast.className = `${bgColor} text-white px-5 py-3 rounded-xl shadow-lg toast`;
        toast.innerText = message;

        document.getElementById('toast-container').appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    // AUTO TRIGGER
    document.addEventListener("DOMContentLoaded", function() {

        // SUCCESS
        @if (session('status') === 'password-updated')
            showToast("Password berhasil diubah!", "success");
        @endif

        // ERROR VALIDATION
        @if ($errors->any())
            showToast("{{ $errors->first() }}", "error");
            openPasswordModal();
        @endif
    });

    function openPasswordModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // klik luar modal = close
        document.getElementById('passwordModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePasswordModal();
            }
        });
    </script>
</x-user>  

