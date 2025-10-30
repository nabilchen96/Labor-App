<x-filament-panels::page>
    @if (auth()->user()?->role === 'Admin')
        <div class="flex items-center justify-between mb-4">
            <x-filament::button color="warning" tag="a" href="{{ url('/admin/jadwal-labs/create') }}">
                New Schedule
            </x-filament::button>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm border border-gray-300 bg-white">
            <thead class="bg-white text-black">
                <tr>
                    <th class="border px-4 py-2 text-left font-bold w-1/6">Laboratorium</th>
                    @foreach ($hariList as $hari)
                        <th class="border px-4 py-2 text-left font-bold uppercase">{{ $hari }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($labs as $lab)
                    {{-- @php dd($labs); @endphp --}}
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 font-semibold whitespace-nowrap align-top">{{ $lab['nama'] }}</td>
                        @foreach ($hariList as $hari)
                            <td class=" px-2 py-2 align-top">
                                @forelse($lab['jadwal'][$hari] as $item)
                                    <div class="bg-white rounded-lg shadow-lg p-3 mb-3 mt-3 relative">
                                        <div class="text-xs text-gray-700 mb-1 text-left">
                                            <i class="fas fa-clock mr-1 text-blue-500"></i> {{ $item['jam'] }}
                                        </div>

                                        <hr class="my-2">

                                        @foreach ($item['petugas'] as $nama)
                                            <div class="mt-1 text-xs text-gray-600">
                                                <i class="fas fa-user mr-1 text-green-500"></i> {{ $nama }}
                                            </div>
                                        @endforeach

                                        <hr class="my-2">

                                        <div class="mt-1 text-xs text-gray-600">
                                            <button>
                                                <i class="fas fa-pencil mr-1 text-green-500"></i>
                                                <a
                                                    href="{{ route('filament.admin.resources.jadwal-labs.edit', $item['id']) }}">
                                                    Edit
                                                </a>

                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <span class="text-xs text-gray-400">-</span>
                                @endforelse
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-filament-panels::page>
