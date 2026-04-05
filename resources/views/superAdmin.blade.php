<x-superadmin>
   
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 1. Stats Cards (4 Kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-gray-100/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-1">Total User</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">40,689</h3>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500 text-xl">
                            <img src="{{ asset('img/User.png') }}" alt="">
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-emerald-500 font-semibold flex items-center gap-1">
                            <i class="fas fa-arrow-trend-up"></i> 8.5%
                        </span>
                        <span class="text-gray-400 ml-2">Up from yesterday</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-gray-100/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-1">Total Order</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">10,293</h3>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center text-primary text-xl">
                            <img src="{{ asset('img/order.png') }}" alt="">
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-emerald-500 font-semibold flex items-center gap-1">
                            <i class="fas fa-arrow-trend-up"></i> 1.3%
                        </span>
                        <span class="text-gray-400 ml-2">Up from past week</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-gray-100/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-1">Total Selesai</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">100</h3>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500 text-xl">
                            <img src="{{ asset('img/selesai.png') }}" alt="">
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-red-500 font-semibold flex items-center gap-1">
                            <i class="fas fa-arrow-trend-down"></i> 4.3%
                        </span>
                        <span class="text-gray-400 ml-2">Down from yesterday</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-gray-100/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-1">Total Pending</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">2040</h3>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-400 text-xl">
                            <img src="{{ asset('img/pending.png') }}" alt="">
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-emerald-500 font-semibold flex items-center gap-1">
                            <i class="fas fa-arrow-trend-up"></i> 1.8%
                        </span>
                        <span class="text-gray-400 ml-2">Up from yesterday</span>
                    </div>
                </div>

            </div>

            {{-- 2. Chart Area --}}
            <div class="bg-white p-8 rounded-[1.5rem] shadow-sm border border-gray-100/50 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Detail Selesai</h3>
                    <div class="relative">
                        <select class="appearance-none bg-white border border-gray-200 text-gray-600 py-2 pl-4 pr-10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option>October</option>
                            <option>November</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
                
                {{-- Container untuk Chart.js/ApexCharts --}}
                <div id="mainChart" class="w-full h-[300px]"></div>
            </div>

            {{-- 3. Table Area --}}
            <div class="bg-white p-8 rounded-[1.5rem] shadow-sm border border-gray-100/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Detail Booking</h3>
                    <div class="relative">
                        <select class="appearance-none bg-white border border-gray-200 text-gray-600 py-2 pl-4 pr-10 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option>October</option>
                            <option>November</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-gray-400 text-sm font-semibold border-b border-gray-100">
                                <th class="pb-4 pl-2">Mobil</th>
                                <th class="pb-4">Pelanggan</th>
                                <th class="pb-4">Jenis sewa</th>
                                <th class="pb-4">Jadwal Kembali</th>
                                <th class="pb-4">Tanggal Kembali</th>
                                <th class="pb-4">Harga Total</th>
                                <th class="pb-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 pl-2 flex items-center gap-4">
                                    <div class="w-16 h-10 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                                        {{-- Ganti src dengan gambar mobilmu nanti --}}
                                        <i class="fas fa-car-side text-gray-400 text-xl"></i>
                                    </div>
                                    <span class="font-bold text-gray-800">Innova Zenix</span>
                                </td>
                                <td class="py-4 text-gray-600 font-medium">Awaudin</td>
                                <td class="py-4 text-gray-500">Tanpa Sopir</td>
                                <td class="py-4 text-gray-500">12.09.2026</td>
                                <td class="py-4 text-gray-500">12.09.2026</td>
                                <td class="py-4 font-bold text-gray-800">Rp.100.000</td>
                                <td class="py-4">
                                    <span class="px-4 py-1.5 bg-teal-500 text-white rounded-full text-xs font-bold tracking-wide shadow-sm">
                                        Selesai
                                    </span>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 pl-2 flex items-center gap-4">
                                    <div class="w-16 h-10 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                                        <i class="fas fa-car text-gray-400 text-xl"></i>
                                    </div>
                                    <span class="font-bold text-gray-800">Honda Brio</span>
                                </td>
                                <td class="py-4 text-gray-600 font-medium">Siti Aminah</td>
                                <td class="py-4 text-gray-500">Dengan Sopir</td>
                                <td class="py-4 text-gray-500">15.09.2026</td>
                                <td class="py-4 text-gray-500">-</td>
                                <td class="py-4 font-bold text-gray-800">Rp.350.000</td>
                                <td class="py-4">
                                    <span class="px-4 py-1.5 bg-primary text-white rounded-full text-xs font-bold tracking-wide shadow-sm">
                                        Pending
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- Script untuk Chart --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                series: [{
                    name: 'Selesai',
                    data: [20, 25, 45, 30, 48, 32, 45, 85, 35, 50, 42, 55, 25, 30, 28, 45, 70, 55, 62, 50, 48, 55, 42, 53, 48]
                }],
                chart: {
                    type: 'area',
                    height: 300,
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif'
                },
                colors: ['#FF9E0C'], // Warna Orange (Tailwind orange-500)
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.5,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: ['5k', '', '10k', '', '15k', '', '20k', '', '25k', '', '30k', '', '35k', '', '40k', '', '45k', '', '50k', '', '55k', '', '60k', '', ''],
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: { colors: '#9CA3AF', fontSize: '12px' }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function (value) { return value + "%"; },
                        style: { colors: '#9CA3AF', fontSize: '12px' }
                    }
                },
                grid: {
                    borderColor: '#F3F4F6',
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } }
                },
                markers: {
                    size: 4,
                    colors: ['#F97316'],
                    strokeColors: '#fff',
                    strokeWidth: 2,
                    hover: { size: 6 }
                },
                tooltip: {
                    theme: 'light'
                }
            };

            var chart = new ApexCharts(document.querySelector("#mainChart"), options);
            chart.render();
        });
    </script>
</x-superadmin>