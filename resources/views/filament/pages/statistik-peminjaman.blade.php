<x-filament-panels::page>
    {{-- Filter Tanggal --}}
    <div>
        <form id="filterForm" class="flex flex-wrap gap-4 items-end">
            <div>
                <label for="from" class="block text-sm font-medium text-gray-700">Start <sup style="color:  red;">*</sup></label>
                <input type="date" name="from" id="from" value="{{ request('from') }}"
                    class="rounded text-sm w-48" style="border: #8080804a solid 1px;">
            </div>
            <div>
                <label for="to" class="block text-sm font-medium text-gray-700">End <sup style="color:  red;">*</sup></label>
                <input type="date" name="to" id="to" value="{{ request('to') }}"
                    class="rounded text-sm w-48"  style="border: #8080804a solid 1px;">
            </div>
            <div>
                <button type="button" id="applyFilter"
                    style="background-color: rgb(217 119 6);" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 text-sm">
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Chart Laboratorium (full width) --}}
    <div id="chart-laboratorium" class="w-full border rounded-lg bg-white p-4"></div>

    {{-- Chart Alat (full width) --}}
    <div id="penggunaan-alat" class="w-full border rounded-lg bg-white p-4"></div>

    {{-- Chart Harian --}}
    <div id="chart-harian" class="w-full border rounded-lg bg-white p-4"></div>

    {{-- Chart --}}
    <div id="chart-instruktur" class="w-full border rounded-lg bg-white p-4"></div>

    {{-- Chart --}}
    <div id="chart-status" class="w-full border rounded-lg bg-white p-4"></div>

    {{-- Chart Kondisi Alat --}}
    <div id="chart-kondisi" class="w-full border rounded-lg bg-white p-4"></div>

    {{-- Highcharts --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        async function loadStatusChart(from = '', to = '') {
            const params = new URLSearchParams();
            if (from) params.append('from', from);
            if (to) params.append('to', to);

            const res = await fetch("{{ route('statistik.status') }}?" + params.toString());
            const data = await res.json();

            Highcharts.chart('chart-status', {
                chart: { type: 'column', height: 400 },
                title: { text: 'Status Peminjaman' },
                xAxis: { categories: data.labels, title: { text: 'Status' } },
                yAxis: { min: 0, title: { text: 'Jumlah' } },
                series: [{
                    name: 'Jumlah',
                    data: data.series,
                    // colorByPoint: true
                }],
                legend: { enabled: false },
                credits: { enabled: false }
            });
        }

        async function loadLabChart(from = '', to = '') {
            const params = new URLSearchParams();
            if (from) params.append('from', from);
            if (to) params.append('to', to);

            const res = await fetch("{{ route('statistik.laboratorium') }}?" + params.toString());
            const data = await res.json();

            Highcharts.chart('chart-laboratorium', {
                chart: { type: 'column', height: 400 },
                title: { text: 'Distribusi Peminjaman per Laboratorium' },
                xAxis: { categories: data.labels, title: { text: 'Laboratorium' } },
                yAxis: { min: 0, title: { text: 'Jumlah Peminjaman' } },
                series: [{
                    name: 'Jumlah',
                    data: data.series,
                    // colorByPoint: true
                }],
                legend: { enabled: false },
                credits: { enabled: false }
            });
        }

        async function loadHarian(from = '', to = '') {
            const params = new URLSearchParams();
            if (from) params.append('from', from);
            if (to) params.append('to', to);

            const res = await fetch("{{ route('statistik.harian') }}?" + params.toString());
            const data = await res.json();

            Highcharts.chart('chart-harian', {
                chart: { type: 'line', height: 400 },
                title: { text: 'Jumlah Peminjaman Harian' },
                xAxis: { categories: data.labels, title: { text: 'Tanggal' } },
                yAxis: { min: 0, title: { text: 'Jumlah' } },
                series: [{ name: 'Jumlah', data: data.series }],
                legend: { enabled: false },
                credits: { enabled: false }
            });
        }

        async function loadInstruktur(from = '', to = '') {
            const params = new URLSearchParams();
            if (from) params.append('from', from);
            if (to) params.append('to', to);

            const res = await fetch("{{ route('statistik.instruktur') }}?" + params.toString());
            const data = await res.json();

            Highcharts.chart('chart-instruktur', {
                chart: { type: 'bar', height: 400 },
                title: { text: 'Jumlah Peminjaman per Instruktur' },
                xAxis: { categories: data.labels, title: { text: 'Instruktur' } },
                yAxis: { min: 0, title: { text: 'Jumlah' } },
                series: [{ name: 'Jumlah', data: data.series, colorByPoint: true }],
                legend: { enabled: false },
                credits: { enabled: false }
            });
        }

        async function loadPenggunaanAlatChart(from = '', to = '') {
            const params = new URLSearchParams();
            if (from) params.append('from', from);
            if (to) params.append('to', to);

            const res = await fetch("{{ route('statistik.penggunaan.alat') }}?" + params.toString());
            const data = await res.json();

            Highcharts.chart('penggunaan-alat', {
                chart: {
                    type: 'column',
                    height: 400
                },
                title: {
                    text: 'Alat Paling Sering Digunakan'
                },
                xAxis: {
                    categories: data.labels,
                    title: {
                        text: 'Status'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah'
                    }
                },
                series: [{
                    name: 'Jumlah',
                    data: data.series,
                    // colorByPoint: true
                }],
                legend: {
                    enabled: false
                },
                credits: {
                    enabled: false
                }
            });
        }

        async function loadKondisiChart(from = '', to = '') {
            const params = new URLSearchParams();
            if (from) params.append('from', from);
            if (to) params.append('to', to);

            const res = await fetch("{{ route('statistik.kondisi.alat') }}?" + params.toString());
            const data = await res.json();

            Highcharts.chart('chart-kondisi', {
                chart: {
                    type: 'column',
                    height: 400
                },
                title: {
                    text: 'Kondisi Alat Setelah Digunakan'
                },
                xAxis: {
                    categories: data.labels,
                    title: {
                        text: 'Kondisi'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah'
                    }
                },
                series: [{
                    name: 'Jumlah',
                    data: data.series,
                    colorByPoint: true
                }],
                legend: {
                    enabled: false
                },
                credits: {
                    enabled: false
                }
            });
        }


        // Load awal
        loadPenggunaanAlatChart();
        loadKondisiChart();
        loadStatusChart();
        loadLabChart();
        loadHarian();
        loadInstruktur();

        // Klik tombol filter
        document.getElementById('applyFilter').addEventListener('click', () => {
            const from = document.getElementById('from').value;
            const to = document.getElementById('to').value;
            loadStatusChart(from, to);
            loadLabChart(from, to);
            loadHarian(from, to);
            loadInstruktur(from, to);
            loadPenggunaanAlatChart(from, to);
            loadKondisiChartChart(from, to);
        });
    </script>
</x-filament-panels::page>
