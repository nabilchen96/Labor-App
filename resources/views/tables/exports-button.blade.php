<div class="flex items-center justify-between w-full">
    <div>
        {{-- Tombol Export Excel --}}
        <x-filament::button
            color="success"
            icon="heroicon-o-document-arrow-down"
            wire:click="$emit('exportExcel')"
        >
            Export Excel
        </x-filament::button>
    </div>

    <div class="flex-1 ml-4">
        {{-- Ini akan otomatis menampilkan search bar bawaan Filament --}}
        {{ $this->table->getFiltersForm() }}
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('exportExcel', function () {
            window.Livewire.emit('exportTable');
        });
    });
</script>
@endpush
