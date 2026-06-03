<x-app-layout>
    <div class="p-6">

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-5">

            {{-- Pendapatan Bulan Ini --}}
            <div class="md:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pendapatan Bulan Ini</p>
                    <div class="flex items-center gap-2">
                        <h3 class="text-3xl font-black text-emerald-600 tracking-tight">
                            Rp.{{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                        </h3>
                        <div class="p-1 bg-emerald-100 rounded-full">
                            <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                      d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-emerald-50 rounded-2xl text-emerald-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>

            {{-- Total Transaksi --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Transaksi</p>
                    <h3 class="text-3xl font-black text-gray-900 tracking-tight">{{ $totalTransaksi }}</h3>
                </div>
                <div class="p-4 bg-blue-50 rounded-2xl text-blue-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>

            {{-- Ketersediaan Mobil --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex justify-between items-center">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Ketersediaan Mobil</p>
                    <h3 class="text-3xl font-black text-gray-900 tracking-tight">
                        {{ $mobilTersedia }} / {{ $totalMobil }}
                    </h3>
                </div>
                <div class="p-4 bg-indigo-50 rounded-2xl text-indigo-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Data Laporan</h1>

          <a href="{{ route('laporan.export', [
    'bulan' => request('bulan'),
    'tahun' => request('tahun'),
    'search' => request('search')
]) }}"
class="bg-primary hover:bg-accent text-white font-semibold py-2 px-6 rounded-full text-sm transition shadow-sm">
    Export Excel
</a>
        </div>

        {{-- CONTENT CARD --}}
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-4">

            {{-- FILTER AREA --}}
            <div class="flex justify-between items-center mb-6 gap-4">

                <form method="GET"
                      action="{{ route('laporan.index') }}"
                      class="w-full flex flex-col lg:flex-row items-center justify-between gap-4">

                    <div class="relative flex-1 min-w-0 flex items-center gap-2">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>

                        <input 
                            type="text"
                            name="search"
                            placeholder="Cari Invoice, No.Pol atau Pelanggan..."
                            value="{{ $search ?? '' }}"
                            class="w-full sm:w-80 bg-gray-50 border border-gray-200 text-gray-700 rounded-full focus:ring-orange-500 focus:border-orange-500 pl-10 pr-4 py-2.5 outline-none text-sm"/>

                        <button type="submit"
                                class="px-5 py-2.5 bg-primary hover:bg-accent text-white rounded-full text-sm font-semibold transition whitespace-nowrap">
                            Cari
                        </button>

                        @if($search)
                            <a href="{{ route('laporan.index') }}"
                               class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 rounded-full text-sm font-semibold text-gray-700 whitespace-nowrap">
                                Reset
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-full sm:w-44">
                            <select name="bulan" onchange="this.form.submit()"
                                    class="w-full bg-white border border-gray-200 text-gray-700 rounded-full py-2 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                                <option value="">Bulan</option>
                                @php $selectedBulan = request('bulan', $bulan); @endphp
                                @foreach(range(1, 12) as $i)
                                    <option value="{{ $i }}" {{ (string)$selectedBulan === (string)$i ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full sm:w-32">
                            <select name="tahun" onchange="this.form.submit()"
                                    class="w-full bg-white border border-gray-200 text-gray-700 rounded-full py-2 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-300">
                                <option value="">Tahun</option>
                                @php $selectedTahun = request('tahun', $tahun); @endphp
                                @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                                    <option value="{{ $y }}" {{ (string)$selectedTahun === (string)$y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-max text-sm text-center text-gray-600 whitespace-nowrap">
                    <thead class="bg-gray-50 text-gray-700 font-bold">
                        <tr>
                            <th class="px-4 py-4 rounded-l-xl text-center whitespace-nowrap font-bold">No Pol</th>
                            <th class="px-6 py-3 font-medium text-center whitespace-nowrap font-bold">Pelanggan</th>
                            <th class="px-6 py-3 font-medium text-center whitespace-nowrap font-bold">Jenis</th>
                            <th class="px-15 py-3 font-medium text-center whitespace-nowrap font-bold">Tanggal Sewa</th>
                            <th class="px-20 py-3 font-medium text-center whitespace-nowrap font-bold">Tanggal Kembali</th>
                            <th class="px-6 py-3 font-medium text-center whitespace-nowrap font-bold">Durasi</th>
                            <th class="px-6 py-3 font-medium text-center whitespace-nowrap font-bold">Harga</th>
                            <th class="px-15 py-3 font-medium text-center whitespace-nowrap font-bold">Sub Total</th>
                            <th class="px-6 py-3 font-medium text-center whitespace-nowrap font-bold">Denda</th>
                            <th class="px-15 py-3 font-medium text-center whitespace-nowrap font-bold">Harga Total</th>
                            <th class="px-6 py-3 font-medium text-center whitespace-nowrap rounded-r-xl font-bold">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($laporan as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-5 whitespace-nowrap">{{ $item->nopol }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">{{ $item->pelanggan->nama_pelanggan }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">{{ $item->jenis_sewa }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">{{ $item->tanggal_sewa }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">{{ $item->tanggal_kembali }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">{{ $item->durasi }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">Rp. {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">Rp. {{ number_format($item->denda, 0, ',', '.') }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">Rp. {{ number_format($item->harga_total, 0, ',', '.') }}</td>
                                <td class="px-4 py-5 whitespace-nowrap">
                                    @if($item->status === 'selesai')
                                        <span class="bg-orange-500 text-white px-5 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @else
                                        <span class="bg-gray-500 text-white px-5 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-10 text-gray-500 italic">
                                    Belum ada data laporan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        const selectBulan = document.getElementById('filterBulan');
        const selectTahun = document.getElementById('filterTahun');
        const btnExport = document.getElementById('btnExport');

        function updatePage() {
            const bulan = selectBulan.value;
            const tahun = selectTahun.value;
            const search = new URLSearchParams(window.location.search).get('search');

            let url = `{{ route('laporan.index') }}?bulan=${bulan}&tahun=${tahun}`;

            if (search) {
                url += `&search=${encodeURIComponent(search)}`;
            }

            window.location.href = url;
        }

        function updateExport() {
            const bulan = selectBulan.value;
            const tahun = selectTahun.value;
            btnExport.href =
                `{{ route('laporan.export') }}?bulan=${bulan}&tahun=${tahun}`;
        }

        updateExport();

        selectBulan.addEventListener('change', () => {
            updateExport();
            updatePage();
        });

        selectTahun.addEventListener('change', () => {
            updateExport();
            updatePage();
        });
    </script>
</x-app-layout>