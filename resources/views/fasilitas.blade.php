<x-user>
    <div class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        
            <div class="order-2 lg:order-1">
              <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-snug mb-6">
                    Solusi Berkendara Premium untuk Pengalaman yang Tak Terlupakan
                </h1>
                <p class="text-gray-500 mb-8 leading-relaxed text-lg text-justify">
                    Adeeva Rent menyediakan berbagai fasilitas untuk memastikan pengalaman sewa mobil yang mudah, aman, dan nyaman. Mulai dari armada kendaraan yang terawat, sistem pemesanan daring, hingga layanan pembayaran yang praktis.
                </p>
            </div>
            <div class="order-1 lg:order-2">
                <img src="{{ asset('img/fasilitas1.png') }}" alt="Fasilitas Adeva Rent" 
                     class="w-full h-[400px] md:h-[500px] object-cover rounded-[2.5rem] shadow-xl">
            </div>
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Kenapa Harus Pilih Adeva?</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Kami memberikan layanan terbaik dengan berbagai keunggulan untuk pengalaman rental yang sempurna</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition text-center group cursor-default">
                    <div class="w-16 h-16 bg-primary text-white flex items-center justify-center rounded-2xl mx-auto mb-6 text-2xl group-hover:scale-110 transition-transform">
                        <img src="{{ asset('img/IconMoney.png') }}" alt="Money">
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Harga Sewa Bersahabat</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Harga kompetitif dengan berbagai pilihan paket sesuai budget Anda.</p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition text-center group cursor-default">
                    <div class="w-16 h-16 bg-primary text-white flex items-center justify-center rounded-2xl mx-auto mb-6 text-2xl group-hover:scale-110 transition-transform">
                        <img src="{{ asset('img/IconUser.png') }}" alt="User">
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Layanan Siap Sedia 24/7</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Tim customer service siap membantu Anda kapan saja dan di mana saja.</p>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition text-center group cursor-default">
                    <div class="w-16 h-16 bg-primary text-white flex items-center justify-center rounded-2xl mx-auto mb-6 text-2xl group-hover:scale-110 transition-transform">
                        <img src="{{ asset('img/IconAlarm.png') }}" alt="Alarm">
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Ambil Unit Tanpa Antre</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Booking mudah dan cepat, siap digunakan dalam hitungan menit.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Our Premium Rental Features</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 flex flex-col overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="{{ asset('img/fasilitas2.png') }}" alt="Armada Terawat" class="w-full h-56 object-cover">
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Kualitas Armada Terawat</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">Seluruh kendaraan dirawat secara berkala untuk memastikan keamanan dan kenyamanan selama perjalanan.</p>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 flex flex-col overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="{{ asset('img/fasilitas3.png') }}" alt="Booking Online" class="w-full h-56 object-cover">
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Pesan Online dalam Sekejap</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">Pemesanan kendaraan dapat dilakukan secara daring melalui website kapan saja tanpa perlu datang langsung.</p>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 flex flex-col overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="{{ asset('img/fasilitas4.png') }}" alt="Layanan Pelanggan" class="w-full h-56 object-cover">
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Dukungan Sewa Menyeluruh</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">Tim kami siap membantu Anda dalam proses pemesanan hingga penyelesaian penyewaan kendaraan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user>