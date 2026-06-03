<x-superadmin>
        <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-[1.5rem] shadow-sm border border-gray-100/50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-400 mb-1">Total User</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">{{ $user }}</h3>
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
                            <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalOrder }}</h3>
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
                            <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalSelesai }}</h3>
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
                            <p class="text-sm font-medium text-gray-400 mb-1">Total Kendaraan Free</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">{{ $freeKendaraan }}/{{ $totalKendaraan }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-red-400 text-xl">
                            <img src="{{ asset('img/pending.png') }}" alt="">
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-emerald-500 font-semibold flex items-center gap-1">
                            <i class="fas fa-arrow-trend-up"></i> {{ $totalKendaraan > 0 ? round(($freeKendaraan / $totalKendaraan) * 100, 1) : 0 }}%
                        </span>
                        <span class="text-gray-400 ml-2">Kendaraan tersedia</span>
                    </div>
                </div>

            </div>

            <div class="bg-white p-8 rounded-[1.5rem] shadow-sm border border-gray-100/50 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Grafik Penjualan</h3>
                </div>
                
                {{-- Container untuk Chart.js/ApexCharts --}}
                <div id="mainChart" class="w-full h-[300px]"></div>
            </div>

            {{-- 3. Table Area --}}
            <div class="bg-white p-8 rounded-[1.5rem] shadow-sm border border-gray-100/50">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Detail Booking</h3>
                
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
    @forelse ($bookingTerbaru as $item)
        <tr class="hover:bg-gray-50/50 transition-colors">
            <td class="py-4 pl-2 flex items-center gap-4">
                @if ($item->kendaraan?->dir)
                    <div class="w-16 h-10 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('storage/' . $item->kendaraan->dir) }}" class="w-full h-full object-contain">
                    </div>
                @else
                    <div class="w-16 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-car text-gray-400 text-xl"></i>
                    </div>
                @endif
                <span class="font-bold text-gray-800">{{ $item->kendaraan?->nama_kendaraan ?? '-' }}</span>
            </td>
            <td class="py-4 text-gray-600 font-medium">{{ $item->pelanggan?->nama_pelanggan ?? '-' }}</td>
            <td class="py-4 text-gray-500">{{ $item->jenis_sewa === 'sopir' ? 'Dengan Sopir' : 'Tanpa Sopir' }}</td>
            <td class="py-4 text-gray-500">{{ \Carbon\Carbon::parse($item->jadwal_kembali)->format('d.m.Y') }}</td>
            <td class="py-4 text-gray-500">{{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d.m.Y') : '-' }}</td>
            <td class="py-4 font-bold text-gray-800">Rp.{{ number_format($item->harga_total, 0, ',', '.') }}</td>
            <td class="py-4">
                @php
                    $status = strtolower(trim($item->status));
                    $badge = match($status) {
                        'selesai' => ['bg-teal-500', 'Selesai'],
                        'lunas'   => ['bg-blue-500', 'Lunas'],
                        'dp'      => ['bg-yellow-500', 'DP'],
                        'batal'   => ['bg-red-500', 'Batal'],
                        default   => ['bg-primary', ucfirst($status)],
                    };
                @endphp
                <span class="px-4 py-1.5 {{ $badge[0] }} text-white rounded-full text-xs font-bold tracking-wide shadow-sm">
                    {{ $badge[1] }}
                </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="py-8 text-center text-gray-400 font-medium">Belum ada data booking.</td>
        </tr>
    @endforelse
</tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- Script untuk Chart --}}
    <script>
        const labels = @json($labels);
        const selesaiData = @json($selesaiData);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const options = {
                series: [{
                    name: 'Selesai',
                    data: selesaiData
                }],
                chart: {
                    type: 'area',
                    height: 300,
                    toolbar: { show: false },
                    fontFamily: 'Inter, sans-serif'
                },
                colors: ['#10B981'],
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                    fontSize: '13px',
                    labels: { colors: '#6B7280' },
                    markers: { width: 10, height: 10, radius: 12 }
                }, 
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.35,
                        opacityTo: 0.05,
                        stops: [0, 100]
                    }
                },
                dataLabels: { 
                    enabled: false 
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 4,
                    colors: ['#10B981'],
                    strokeColors: '#fff',
                    strokeWidth: 2,
                    hover: { size: 6 }
                },
                xaxis: {
                    categories: labels,
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: { colors: '#9CA3AF', fontSize: '12px' }
                    }
                },
                yaxis: {
                    min : 0,
                    max: 20,
                    tickAmount: 4,
                    forceNiceScale: true,
                    labels: {
                        formatter: function (value) { 
                            return Math.round(value);
                        },
                        style: { colors: '#9CA3AF', fontSize: '12px' }
                    }
                },
                grid: {
                    borderColor: '#F3F4F6',
                    strokeDashArray: 4,
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: function (value) { return value + 'transaksi'; }
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#mainChart"), options);
            chart.render();
        });
    </script>
    {{-- <script>
        setInterval(() => {
            location.reload();
        }, 30000);
    </script> --}}
</x-superadmin>