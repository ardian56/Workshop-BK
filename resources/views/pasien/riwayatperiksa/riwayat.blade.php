<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Riwayat Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h3 class="text-2xl font-bold mb-4">Detail Pemeriksaan</h3>

                @if($janjiPeriksa->periksa)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-gray-700 font-bold">Tanggal Periksa:</p>
                            <p class="text-gray-900">
                                {{ \Carbon\Carbon::parse($janjiPeriksa->periksa->tgl_periksa)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-700 font-bold">Catatan:</p>
                            <p class="text-gray-900">{{ $janjiPeriksa->periksa->catatan ?: 'Tidak ada catatan' }}</p>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold mt-6 mb-4">Obat yang Diresepkan</h3>

                    @if($janjiPeriksa->periksa->detailPeriksas && $janjiPeriksa->periksa->detailPeriksas->isNotEmpty())
                        <ul class="list-disc list-inside space-y-2">
                            @foreach($janjiPeriksa->periksa->detailPeriksas as $detailPeriksa)
                                <li>
                                    <span class="font-medium">{{ $detailPeriksa->obat->nama_obat ?? 'Unknown' }}</span>
                                    ({{ $detailPeriksa->obat->kemasan ?? 'Unknown' }})
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600">Tidak ada obat yang diresepkan.</p>
                    @endif

                    <div class="mt-6">
                        <p class="text-xl font-bold">Biaya Periksa: Rp{{ number_format($janjiPeriksa->periksa->biaya_periksa, 0, ',', '.') }}</p>
                    </div>
                @else
                    <p class="text-red-500">Tidak ada informasi pemeriksaan yang tersedia.</p>
                @endif

                <div class="mt-8">
                    <a href="{{ route('pasien.riwayatperiksa.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
