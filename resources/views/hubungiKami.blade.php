<x-user>

<div id="page-content" class="min-h-screen page-transition-enter">

    
    <section class="max-w-7xl mx-auto px-6 mt-8">
        <div class="relative h-[300px] rounded-[3rem] overflow-hidden flex items-center justify-center group">
            <img src="{{ asset('img/kantor1.jpeg') }}" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-700 group-hover:scale-110" alt="Banner Profile">
            <div class="absolute inset-0 bg-[#FF9E0C] bg-opacity-60 z-10 transition-opacity duration-500 group-hover:bg-opacity-40"></div>
            <div class="relative z-20">
                <h1 class="text-6xl font-black text-white tracking-[0.3em] uppercase transition-transform duration-500 group-hover:scale-105">CONTACT US</h1>
            </div>
        </div>
    </section>

    <section class="bg-[#0B1221] py-20 mt-10 relative overflow-hidden animate-page-load">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <h2 class="text-3xl font-bold text-white mb-12 text-center lg:hidden">Pusat Bantuan</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <div class="relative flex justify-center items-center h-[350px] md:h-[450px]">
                    <div class="absolute w-full max-w-md h-full bg-gradient-to-br from-[#FF9E0C] to-[#c2410c] shadow-2xl shadow-primary/20"
                         style="border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; transform: rotate(-5deg);">
                    </div>
                    
                    <img src="{{ asset('img/kantor5.jpeg') }}" class="relative z-10 w-4/5 h-auto object-cover rounded-3xl shadow-xl transform rotate-3 hover:scale-105 transition duration-500 border-4 border-white/10" alt="Layanan Pelanggan">
                </div>

                <div class="space-y-10">
                    <h2 class="hidden lg:block text-3xl md:text-4xl font-bold text-white mb-4">Our Support Center</h2>
                    
                    <div>
                        <h3 class="text-xl font-bold text-[#FF9E0C] mb-3 flex items-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            24/7 Customer Care
                        </h3>
                        <p class="text-gray-300 leading-relaxed text-sm md:text-base font-['Inter']">
                            ADEEVA RENT menyediakan layanan pelanggan yang selalu siaga untuk menjawab kebutuhan Anda. Tim kami siap membantu memberikan informasi detail ketersediaan kendaraan, panduan reservasi, maupun dukungan darurat kapan pun Anda butuhkan.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-[#FF9E0C] mb-3 flex items-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Mobility Consultation
                        </h3>
                        <p class="text-gray-300 leading-relaxed text-sm md:text-base font-['Inter']">
                            Bingung memilih tipe mobil yang tepat? Konsultasikan rencana perjalanan Anda bersama kami. Kami akan merekomendasikan armada terbaik yang sesuai dengan jumlah penumpang, destinasi, serta anggaran perjalanan Anda untuk memastikan kenyamanan maksimal.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-16 animate-page-load">
        <div class="grid grid-cols-1 lg:grid-cols-5 bg-primary rounded-[2.5rem] overflow-hidden shadow-2xl">
            
            <div class="hidden lg:block lg:col-span-2 relative">
                <img src="{{ asset('img/kantor1.jpeg') }}" class="absolute inset-0 w-full h-full object-cover" alt="Customer Service">
                <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent"></div>
            </div>

            <div class="lg:col-span-3 p-8 md:p-12">
                <h2 class="text-3xl font-bold text-white mb-2">Send Us a Message</h2>
                <p class="text-white/75 text-sm mb-8">Isi form di bawah ini dan kami akan segera menghubungi Anda kembali.</p>

                <form id="contactForm" class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-white font-semibold text-sm mb-2">Full Name</label>
                            <input type="text" name="nama" class="w-full px-4 py-3 rounded-xl bg-white/90 text-gray-900 font-medium placeholder-gray-400 border-2 border-transparent focus:border-white" placeholder="Enter your" required>
                        </div>
                        <div>
                            <label class="block text-white font-semibold text-sm mb-2">Phone Number</label>
                            <input type="tel" name="whatsapp" class="w-full px-4 py-3 rounded-xl bg-white/90 text-gray-900 font-medium placeholder-gray-400 border-2 border-transparent focus:border-white" placeholder="08123xxx" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-white font-semibold text-sm mb-2">Email</label>
                            <input type="email" name="email" class="w-full px-4 py-3 rounded-xl bg-white/90 text-gray-900 font-medium placeholder-gray-400 border-2 border-transparent focus:border-white" placeholder="example@gmail.com" required>
                        </div>
                        <div>
                            <label class="block text-white font-semibold text-sm mb-2">Inquiry Type</label>
                            <select name="tujuan" class="w-full px-4 py-3 rounded-xl bg-white/90 text-gray-900 font-medium border-2 border-transparent focus:border-white">
                                <option value="">Select an option</option>
                                <option value="informasi">Informasi Rental</option>
                                <option value="pemesanan">Pemesanan Kendaraan</option>
                                <option value="keluhan">Keluhan</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-white font-semibold text-sm mb-2">Message</label>
                        <textarea name="pesan" rows="4" class="w-full px-4 py-3 rounded-xl bg-white/90 text-gray-900 font-medium placeholder-gray-400 border-2 border-transparent focus:border-white resize-none" placeholder="Type your message here..." required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-white text-primary font-bold py-4 rounded-2xl transition hover:bg-gray-50 shadow-lg shadow-white/20 mt-2">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>
<section class="max-w-7xl mx-auto px-6 pb-16 animate-page-load">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Service Network</h2>

        <div class="grid grid-cols-1 lg:grid-cols-4 shadow-xl border border-gray-200 bg-white">
            
            <div class="lg:col-span-1 flex flex-col h-[500px] border-r border-gray-200">
                <div class="bg-[#0B1221] p-5">
                    <h3 class="font-bold text-white text-sm mb-3">ADEEVA RENT Service Points</h3>
                    <div class="relative">
                    </div>
                </div>

                <div class="overflow-y-auto flex-1 locations-scroll bg-white">
                    
                    <div class="branch-btn w-full text-left p-5 border-b border-gray-200 border-l-4 border-l-[#FF9E0C] bg-transparent" 
                         data-map="https://maps.google.com/maps?q=Gambiran+Regency+Magetan&t=&z=14&ie=UTF8&iwloc=&output=embed">
                        <h4 class="font-bold text-[13px] mb-2 text-[#FF9E0C] btn-title">HEAD OFFICE MAGETAN</h4>
                        <div class="flex gap-2.5 items-start mb-2">
                            <svg class="w-4 h-4 shrink-0 mt-0.5 text-[#FF9E0C] btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <p class="text-[12px] text-gray-600 leading-snug">GRAHA Adeeva, Perum Gambiran Regency D.15, Sanggrahan, Magetan</p>
                        </div>
                        <div class="flex gap-2.5 items-center">
                            <svg class="w-4 h-4 shrink-0 text-[#FF9E0C] btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <p class="text-[12px] text-gray-600">+6281380555815</p>
                        </div>
                    </div>

                    <div class="branch-btn w-full text-left p-5 border-b border-gray-200 border-l-4 border-l-transparent bg-transparent" 
                         data-map="https://maps.google.com/maps?q=Jatimekar+Bekasi&t=&z=14&ie=UTF8&iwloc=&output=embed">
                        <h4 class="font-bold text-[13px] mb-2 text-gray-800 btn-title uppercase">Branch Jabodetabek</h4>
                        <div class="flex gap-2.5 items-start mb-2">
                            <svg class="w-4 h-4 shrink-0 mt-0.5 text-gray-500 btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <p class="text-[12px] text-gray-600 leading-snug">Jl . Raya Jatimekar No. 1B, Kec. Jatisampurna, Bekasi</p>
                        </div>
                        <div class="flex gap-2.5 items-center">
                            <svg class="w-4 h-4 shrink-0 text-gray-500 btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <p class="text-[12px] text-gray-600">+6281380555815</p>
                        </div>
                    </div>

                    <div class="branch-btn w-full text-left p-5 border-b border-gray-200 border-l-4 border-l-transparent bg-transparent" 
                         data-map="https://maps.google.com/maps?q=Karangpawitan+Karawang&t=&z=14&ie=UTF8&iwloc=&output=embed">
                        <h4 class="font-bold text-[13px] mb-2 text-gray-800 btn-title uppercase">Branch Karawang</h4>
                        <div class="flex gap-2.5 items-start mb-2">
                            <svg class="w-4 h-4 shrink-0 mt-0.5 text-gray-500 btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <p class="text-[12px] text-gray-600 leading-snug">Komplek Ruko Perum Karang Indah No. 3, Karawang Barat</p>
                        </div>
                        <div class="flex gap-2.5 items-center">
                            <svg class="w-4 h-4 shrink-0 text-gray-500 btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <p class="text-[12px] text-gray-600">+6281380555815</p>
                        </div>
                    </div>

                    <div class="branch-btn w-full text-left p-5 border-b border-gray-200 border-l-4 border-l-transparent bg-transparent" 
                         data-map="https://maps.google.com/maps?q=Regol+Bandung&t=&z=14&ie=UTF8&iwloc=&output=embed">
                        <h4 class="font-bold text-[13px] mb-2 text-gray-800 btn-title uppercase">Branch Bandung</h4>
                        <div class="flex gap-2.5 items-start mb-2">
                            <svg class="w-4 h-4 shrink-0 mt-0.5 text-gray-500 btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <p class="text-[12px] text-gray-600 leading-snug">Jl. Rd. H Kantil No. 34, Regol, Bandung, Jawa Barat</p>
                        </div>
                        <div class="flex gap-2.5 items-center">
                            <svg class="w-4 h-4 shrink-0 text-gray-500 btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <p class="text-[12px] text-gray-600">+6281380555815</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="lg:col-span-3 h-[400px] lg:h-full bg-gray-100">
                <iframe
                    id="branchMap"
                    src="https://maps.google.com/maps?q=Gambiran+Regency+Magetan&t=&z=14&ie=UTF8&iwloc=&output=embed"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 pb-20 animate-page-load">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 pt-10 border-t border-gray-200">
            
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center shrink-0 shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-0.5">Instagram</p>
                    <p class="font-bold text-gray-900">@adeevarent</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center shrink-0 shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-0.5">Website</p>
                    <p class="font-bold text-gray-900">www.adeevarent.com</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center shrink-0 shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-0.5">Phone</p>
                    <p class="font-bold text-gray-900">+6281380555815</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-primary flex items-center justify-center shrink-0 shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-0.5">Opening hours</p>
                    <p class="font-bold text-gray-900">Senin-Sabtu: 08:00 - 20:00</p>
                </div>
            </div>

        </div>
    </section>

</div>

@push('scripts')
<script>
    document.querySelectorAll('.branch-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            document.querySelectorAll('.branch-btn').forEach(btn => {
                btn.classList.remove('border-l-[#FF9E0C]');
                btn.classList.add('border-l-transparent');
                
                btn.querySelector('.btn-title').classList.remove('text-[#FF9E0C]');
                btn.querySelector('.btn-title').classList.add('text-gray-800');
                
                btn.querySelectorAll('.btn-icon').forEach(icon => {
                    icon.classList.remove('text-[#FF9E0C]');
                    icon.classList.add('text-gray-500');
                });
            });
            
            this.classList.remove('border-l-transparent');
            this.classList.add('border-l-[#FF9E0C]');
            
            this.querySelector('.btn-title').classList.remove('text-gray-800');
            this.querySelector('.btn-title').classList.add('text-[#FF9E0C]');
            
            this.querySelectorAll('.btn-icon').forEach(icon => {
                icon.classList.remove('text-gray-500');
                icon.classList.add('text-[#FF9E0C]');
            });
            
            const mapCode = this.getAttribute('data-map');
            if (mapCode) {
                const mapIframe = document.getElementById('branchMap');
                mapIframe.style.opacity = '0.5';
                setTimeout(() => {
                    mapIframe.src = mapCode; 
                    mapIframe.style.opacity = '1';
                }, 300);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const animatedElements = document.querySelectorAll('[class*="animate-"]');
        animatedElements.forEach(el => {
            el.style.opacity = '1';
        });

        document.addEventListener('click', function(e) {
            if (e.target.matches('a[href]') && !e.target.href.includes('#')) {
                const href = e.target.getAttribute('href');
                if (href && !href.startsWith('http') && !href.includes('logout')) {
                    e.preventDefault();
                    document.body.style.opacity = '0.7';
                    document.body.style.transition = 'opacity 0.5s ease-out';
                    setTimeout(() => {
                        window.location.href = href;
                    }, 500);
                }
            }
        });
    });

    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const button = this.querySelector('button[type="submit"]');
        const originalText = button.innerText;
        
        button.disabled = true;
        button.classList.add('btn-loading');
        button.innerText = 'Mengirim...';

        setTimeout(() => {
            button.disabled = false;
            button.classList.remove('btn-loading');
            button.innerText = originalText;
            
            Swal.fire({
                title: 'Berhasil!',
                text: 'Pesan Anda telah dikirim. Tim kami akan merespons dalam waktu singkat.',
                icon: 'success',
                confirmButtonColor: '#FF9E0C',
                confirmButtonText: 'OK'
            }).then(() => {
                this.reset();
                document.querySelector('select[name="tujuan"]').value = '';
            });
        }, 1500);
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            document.body.style.opacity = '1';
        }
    });

    window.addEventListener('pagehide', function(event) {
        if (!event.persisted) {
            document.body.style.opacity = '0.7';
        }
    });
</script>
@endpush

</x-user>