<x-filament-panels::page class="fi-dashboard-page">
    <x-filament-widgets::widgets :widgets="[\App\Filament\Widgets\StatistikWidget::class]" />

    <style>
        /* Pastikan semua widget tabel di dashboard punya tinggi yang sama dan scroll */
        .fi-dashboard-page .fi-widget {
            height: 450px !important;
            display: flex;
            flex-direction: column;
        }

        .fi-dashboard-page .fi-widget .fi-table {
            flex: 1;
            overflow-y: auto;
        }
    </style>

    {{-- Baris 2: Tabel Peminjaman dan Pengecekan (2 kolom) --}}
    <x-filament-widgets::widgets :columns="2" :widgets="[
        \App\Filament\Widgets\TabelPeminjamanDisetujui::class,
        \App\Filament\Widgets\TabelPeminjamanBelumDicek::class,
    ]" />

    {{-- Baris 3: Jadwal Jaga Hari Ini --}}
    <x-filament-widgets::widgets
        :columns="1"
        :widgets="[
            \App\Filament\Widgets\TabelJadwalJagaHariIni::class,
        ]"
    />
</x-filament-panels::page>
