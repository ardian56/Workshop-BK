<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat Terhapus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <a href="{{ route('dokter.obat.index') }}" class="btn btn-secondary mb-4 bg-gray-400 rounded-full">Kembali ke Daftar Obat</a>
                    <h3 class="text-md font-semibold text-gray-700 mb-2">Obat Terhapus (Soft Delete)</h3>
                    <div class="overflow-x-auto w-full rounded mt-4">
                        <table class="table table-hover min-w-full">
                            <thead class="bg-red-200">
                                <tr>
                                    <th class="text-center font-bold text-gray-700 whitespace-nowrap">No</th>
                                    <th class="text-center font-bold text-gray-700 whitespace-nowrap">Nama Obat</th>
                                    <th class="text-center font-bold text-gray-700 whitespace-nowrap">Kemasan</th>
                                    <th class="text-center font-bold text-gray-700 whitespace-nowrap">Harga</th>
                                    <th class="text-center font-bold text-gray-700 whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($obatsTrashed as $obat)
                                    <tr class="align-middle bg-red-50 border-b border-red-100">
                                        <th class="text-center text-gray-700 whitespace-nowrap">{{ $loop->iteration }}</th>
                                        <td class="text-center font-semibold text-black whitespace-nowrap">{{ $obat->nama_obat }}</td>
                                        <td class="text-center whitespace-nowrap">{{ $obat->kemasan }}</td>
                                        <td class="text-center whitespace-nowrap">{{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}</td>
                                        <td class="text-center whitespace-nowrap">
                                            <form action="{{ route('dokter.obat.restore', $obat->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm rounded-pill px-4 py-1 shadow-sm bg-green-500 rounded-full">
                                                    Restore
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500">Tidak ada obat yang dihapus.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>