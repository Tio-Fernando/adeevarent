<x-user>

<div id="page-content" class="min-h-screen page-transition-enter">
    <section class="max-w-7xl mx-auto px-6 mt-8">
        <div class="relative h-[300px] rounded-[3rem] overflow-hidden flex items-center justify-center group">
            <img src="{{ asset('img/kantor1.jpeg') }}" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-700 group-hover:scale-110" alt="Banner Profile">
            <div class="absolute inset-0 bg-[#FF9E0C] bg-opacity-60 z-10 transition-opacity duration-500 group-hover:bg-opacity-40"></div>
            <div class="relative z-20">
                <h1 class="text-6xl font-black text-white tracking-[0.3em] uppercase transition-transform duration-500 group-hover:scale-105">PROFILE</h1>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="flex flex-col items-center group cursor-default">
                <span class="text-5xl font-bold text-[#FF9E0C] transition-transform duration-300 group-hover:-translate-y-2">100+</span>
                <span class="text-gray-900 font-bold text-sm mt-2">Customer</span>
            </div>
            <div class="flex flex-col items-center border-x-0 md:border-x border-gray-100 px-10 group cursor-default">
                <span class="text-5xl font-black text-[#FF9E0C] transition-transform duration-300 group-hover:-translate-y-2">50+</span>
                <span class="text-gray-900 font-bold text-sm mt-2">Fleet of Vehicles</span>
            </div>
            <div class="flex flex-col items-center group cursor-default">
                <span class="text-5xl font-black text-[#FF9E0C] transition-transform duration-300 group-hover:-translate-y-2">5+</span>
                <span class="text-gray-900 font-bold text-sm mt-2">Years of Industry Experience</span>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2">
                <h2 class="text-3xl font-extrabold text-gray-900 leading-tight mb-6">About Us</h2>
                <div class="space-y-4 text-gray-600 text-justify text-sm leading-relaxed font-['Inter']">
                    <p>Adeeva Rent merupakan perusahaan yang bergerak di bidang jasa penyewaan kendaraan (Mobil) yang berada di bawah naungan PT Adeevaindo Trans Utama. Perusahaan ini didirikan dengan tujuan untuk memenuhi kebutuhan transportasi masyarakat yang semakin meningkat.</p>
                    <p>Sejak awal berdiri, Adeeva Rent berkomitmen untuk memberikan layanan transportasi yang nyaman, aman, dan terpercaya dengan mengikuti tren industri kendaraan yang terus berkembang.</p>
                </div>
            </div>
            <div class="lg:w-1/2 overflow-hidden rounded-[2.5rem] shadow-2xl group">
                <img src="{{ asset('img/kantor5.jpeg') }}" class="w-full h-[350px] object-cover transition-transform duration-700 group-hover:scale-110">
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-20 font-['Poppins']">
        <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-12">Customer Testimonials</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-50 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-4 hover:shadow-2xl group">
                <div class="text-[#FF9E0C] text-4xl font-serif mb-2 transition-transform group-hover:scale-110">“</div>
                <p class="text-gray-600 text-sm leading-relaxed mb-6 italic">Saya sangat puas dengan pelayanan dari Adeva Rent. Mobil yang disediakan bersih, nyaman, dan kondisinya sangat baik.</p>
                <img src="https://ui-avatars.com/api/?name=Alpin+Kunsung&background=FF9E0C&color=fff" class="w-14 h-14 rounded-full mb-3 border-2 border-orange-100 group-hover:border-orange-400 transition-colors">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Kepala Server</p>
                <h4 class="font-bold text-sm text-[#FF9E0C]">Alpin Kunsung</h4>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-50 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-4 hover:shadow-2xl group">
                <div class="text-[#FF9E0C] text-4xl font-serif mb-2 transition-transform group-hover:scale-110">“</div>
                <p class="text-gray-600 text-sm leading-relaxed mb-6 italic">Pelayanannya ramah dan profesional. Saya menyewa mobil untuk perjalanan keluarga dan semuanya berjalan lancar.</p>
                <img src="https://ui-avatars.com/api/?name=Alucard&background=FF9E0C&color=fff" class="w-14 h-14 rounded-full mb-3 border-2 border-orange-100 group-hover:border-orange-400 transition-colors">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Kepala Departemen ML</p>
                <h4 class="font-bold text-sm text-[#FF9E0C]">Alucard</h4>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-50 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-4 hover:shadow-2xl group">
                <div class="text-[#FF9E0C] text-4xl font-serif mb-2 transition-transform group-hover:scale-110">“</div>
                <p class="text-gray-600 text-sm leading-relaxed mb-6 italic">Booking mobil di Adeva Rent sangat mudah. Timnya responsif dan membantu menjelaskan semua proses penyewaan.</p>
                <img src="https://ui-avatars.com/api/?name=Awa+Voldemord&background=FF9E0C&color=fff" class="w-14 h-14 rounded-full mb-3 border-2 border-orange-100 group-hover:border-orange-400 transition-colors">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Kepala Departemen SI/V</p>
                <h4 class="font-bold text-sm text-[#FF9E0C]">Awa Voldemord</h4>
            </div>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-6 py-20 font-['Poppins']" x-data="{ active: 1 }">
    <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-12">Top Car Rental Questions</h2>
    
    <div class="space-y-4">
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
            <button @click="active = (active === 1 ? 0 : 1)" class="w-full px-8 py-6 text-left flex justify-between items-center group">
                <span class="font-bold text-gray-800 text-base group-hover:text-[#FF9E0C] transition-colors">How do I book a car with Adeva Rent?</span>
                <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="active === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="active === 1" x-collapse x-cloak>
                <div class="px-8 pb-6 text-sm text-gray-500 leading-relaxed font-['Inter']">
                    Imperdiet ut tristique viverra nunc. Ultrices orci vel auctor cursus turpis nibh placerat massa. Fermentum urna ut at et in. Turpis aliquet cras hendrerit enim condimentum. Condimentum interdum risus bibendum urna. Augue aliquet varius faucibus ut integer tristique ut. Pellentesque id nibh sed nulla non nulla.
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
            <button @click="active = (active === 2 ? 0 : 2)" class="w-full px-8 py-6 text-left flex justify-between items-center group">
                <span class="font-bold text-gray-800 text-base group-hover:text-[#FF9E0C] transition-colors">What are the requirements to rent a car?</span>
                <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="active === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="active === 2" x-collapse x-cloak>
                <div class="px-8 pb-6 text-sm text-gray-500 leading-relaxed font-['Inter']">
                    Syarat utama penyewaan adalah KTP asli, SIM A yang masih aktif, dan jaminan sesuai unit yang dipilih. Verifikasi dilakukan secara cepat melalui tim admin kami.
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
            <button @click="active = (active === 3 ? 0 : 3)" class="w-full px-8 py-6 text-left flex justify-between items-center group">
                <span class="font-bold text-gray-800 text-base group-hover:text-[#FF9E0C] transition-colors">Do you offer self-drive rentals?</span>
                <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="active === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="active === 3" x-collapse x-cloak>
                <div class="px-8 pb-6 text-sm text-gray-500 leading-relaxed font-['Inter']">
                    Ya, kami menyediakan layanan lepas kunci maupun layanan dengan driver profesional untuk memastikan kenyamanan perjalanan Anda.
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
            <button @click="active = (active === 4 ? 0 : 4)" class="w-full px-8 py-6 text-left flex justify-between items-center group">
                <span class="font-bold text-gray-800 text-base group-hover:text-[#FF9E0C] transition-colors">What is the minimum rental duration?</span>
                <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="active === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="active === 4" x-collapse x-cloak>
                <div class="px-8 pb-6 text-sm text-gray-500 leading-relaxed font-['Inter']">
                    Minimal durasi penyewaan adalah 24 jam (1 hari). Kami juga melayani sewa mingguan dan bulanan dengan harga khusus.
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
            <button @click="active = (active === 5 ? 0 : 5)" class="w-full px-8 py-6 text-left flex justify-between items-center group">
                <span class="font-bold text-gray-800 text-base group-hover:text-[#FF9E0C] transition-colors">What payment methods do you accept?</span>
                <svg class="w-5 h-5 text-gray-500 transition-transform duration-300" :class="active === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="active === 5" x-collapse x-cloak>
                <div class="px-8 pb-6 text-sm text-gray-500 leading-relaxed font-['Inter']">
                    Kami menerima berbagai metode pembayaran mulai dari transfer bank (BCA, Mandiri, BRI), E-Wallet (Dana, OVO, ShopeePay), hingga tunai di kantor kami.
                </div>
            </div>
        </div>
    </div>
</section>
<style>
[x-cloak] { display: none !important; }
</style>

    <section class="max-w-7xl mx-auto px-6 py-10 mb-10">
        <div class="bg-[#FF9E0C] rounded-[2.5rem] p-12 relative overflow-hidden flex flex-col md:flex-row items-center justify-between shadow-2xl shadow-orange-200 group">
            <div class="absolute inset-0 opacity-10 pointer-events-none tire-track group-hover:opacity-20 transition-opacity"></div>
            <div class="relative z-10 md:w-2/3 text-white">
                <h2 class="text-4xl font-black italic mb-2 tracking-tight">Looking to Rent a Car?   </h2>
                <h3 class="text-3xl font-bold mb-6 italic">+537 547-8401</h3>
                <p class="text-white/90 text-sm leading-relaxed max-w-xl font-['Inter']">Adeva Rent hadir sebagai solusi rental mobil yang praktis, aman, dan terpercaya.</p>
                <button class="mt-8 bg-white text-[#FF9E0C] font-bold px-10 py-3 rounded-xl hover:bg-gray-800 hover:text-white hover:scale-105 active:scale-95 transition-all shadow-lg text-sm uppercase">Book Now</button>
            </div>
            <div class="md:w-1/3 mt-10 md:mt-0 relative z-10">
                <img src="{{ asset('img/mobil2.png') }}" class="w-full drop-shadow-2xl transition-transform duration-500 group-hover:scale-110 group-hover:rotate-2">
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const pageContent = document.getElementById('page-content');

        requestAnimationFrame(() => {
            pageContent.classList.remove('page-transition-enter');
            pageContent.classList.add('page-transition-enter-active');
        });

        const links = document.querySelectorAll('a[href]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.href.includes('#') || this.target === '_blank' || e.ctrlKey || e.metaKey || this.href.startsWith('javascript:')) return;

                e.preventDefault();
                const destination = this.href;

                // Tambahkan efek fade out
                pageContent.classList.remove('page-transition-enter-active');
                pageContent.classList.add('page-transition-leave-active');


                setTimeout(() => {
                    window.location.href = destination;
                }, 400);
            });
        });
    });
</script>
@endpush

</x-user>