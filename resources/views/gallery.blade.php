<x-user>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <div class="relative min-h-screen bg-white flex flex-col items-center justify-center overflow-hidden py-20 [font-family:'Poppins',sans-serif]">

        <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none z-0">
            <span class="text-[18vw] font-black uppercase tracking-tighter text-[#F0820A]/[0.05]">ADEEVA</span>
        </div>

        <div class="relative z-10 w-full max-w-[1400px] mx-auto px-6">

            <div class="text-center mb-14">
                <div class="inline-flex items-center gap-3 mb-3">
                    <span class="w-8 h-px bg-[#F0820A]"></span>
                    <span class="w-8 h-px bg-[#F0820A]"></span>
                </div>
                <h1 class="text-6xl md:text-7xl font-black uppercase tracking-tight text-gray-900 leading-none">
                    Gallery
                </h1>
            </div>

            <div class="swiper mySwiper overflow-visible">
                <div class="swiper-wrapper items-center">

                    <div class="swiper-slide">
                        <div class="slide-inner rounded-2xl overflow-hidden bg-white shadow-md border border-gray-100 transition-all duration-500">
                            <div class="relative w-full overflow-hidden" style="padding-top:66%">
                                <img src="{{ asset('img/galery1.jpeg') }}" alt="Gallery 1"
                                    class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-700">
                                <div class="slide-label-wrap absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/60 to-transparent translate-y-full transition-transform duration-300">
                                    <span class="text-[11px] font-semibold tracking-widest uppercase text-white/90">PT Adeevaindo Trans Utama</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">
                                <span class="slide-num text-3xl font-black text-gray-200 transition-colors duration-300 leading-none">01</span>
                                <div class="flex gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="slide-inner rounded-2xl overflow-hidden bg-white shadow-md border border-gray-100 transition-all duration-500">
                            <div class="relative w-full overflow-hidden" style="padding-top:66%">
                                <img src="{{ asset('img/galery2.png') }}" alt="Gallery 2"
                                    class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-700">
                                <div class="slide-label-wrap absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/60 to-transparent translate-y-full transition-transform duration-300">
                                    <span class="text-[11px] font-semibold tracking-widest uppercase text-white/90">Kantor Operasional</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">
                                <span class="slide-num text-3xl font-black text-gray-200 transition-colors duration-300 leading-none">02</span>
                                <div class="flex gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="slide-inner rounded-2xl overflow-hidden bg-white shadow-md border border-gray-100 transition-all duration-500">
                            <div class="relative w-full overflow-hidden" style="padding-top:66%">
                                <img src="{{ asset('img/galery3.png') }}" alt="Gallery 3"
                                    class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-700">
                                <div class="slide-label-wrap absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/60 to-transparent translate-y-full transition-transform duration-300">
                                    <span class="text-[11px] font-semibold tracking-widest uppercase text-white/90">Sertifikasi</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">
                                <span class="slide-num text-3xl font-black text-gray-200 transition-colors duration-300 leading-none">03</span>
                                <div class="flex gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-200"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-12 flex items-center justify-center gap-5">
                <button class="swiper-prev w-12 h-12 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-700 shadow-sm hover:border-[#F0820A] hover:text-[#F0820A] hover:shadow-md transition-all duration-300 active:scale-90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <div class="w-36 h-0.5 bg-gray-200 rounded-full overflow-hidden">
                    <div id="progressBar" class="h-full bg-[#F0820A] rounded-full transition-all duration-500" style="width:33%"></div>
                </div>
                
                <button class="swiper-next w-12 h-12 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-700 shadow-sm hover:border-[#F0820A] hover:text-[#F0820A] hover:shadow-md transition-all duration-300 active:scale-90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <div class="text-sm font-semibold text-gray-400 tracking-wide">
                    <span id="curSlide" class="text-[#F0820A] text-base font-bold">1</span> / 3
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: false,
            coverflowEffect: { rotate: 6, stretch: 0, depth: 180, modifier: 1, slideShadows: false },
            navigation: { nextEl: ".swiper-next", prevEl: ".swiper-prev" },
            on: {
                slideChange() {
                    const idx = this.realIndex;
                    document.getElementById('progressBar').style.width = `${((idx + 1) / this.slides.length) * 100}%`;
                    document.getElementById('curSlide').textContent = idx + 1;
                }
            }
        });
    </script>

    <style>
        .swiper-slide { width: 300px; transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        @media (min-width: 768px) { .swiper-slide { width: 500px; } }

        .swiper-slide-active .slide-inner { @apply border-[#F0820A] shadow-[0_20px_60px_rgba(240,130,10,0.15),0_8px_24px_rgba(0,0,0,0.08)]; }
        .swiper-slide-active .slide-inner img { @apply scale-105; }
        .swiper-slide-active .slide-label-wrap { @apply translate-y-0; }
        .swiper-slide-active .slide-num { @apply text-[#F0820A]; }
        .swiper-slide:not(.swiper-slide-active) { @apply opacity-40 scale-95; }
        .swiper-button-disabled { @apply opacity-25 pointer-events-none; }
    </style>
</x-user>