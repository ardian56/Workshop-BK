<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Jadwal Periksa') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.jadwalperiksa.create') }}" class="btn btn-primary w-full sm:w-auto bg-blue-600 hover:bg-blue-700 rounded-full text-white px-4 py-2">Tambah Jadwal</a>

                            @if (session('status') === 'jadwalperiksa-created' || session('status') === 'jadwalperiksa-updated' || session('status') === 'jadwalperiksa-deleted')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >
                                    {{ __('Berhasil diperbarui.') }}
                                </p>
                            @endif
                        </div>
                    </header>

                    <div class="overflow-x-auto w-full rounded mt-4">
                        <table class="table table-hover min-w-full">
                            <thead class="bg-gray-300">
                                <tr>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">No</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">Hari</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">Jam Mulai</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">Jam Selesai</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">Status</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap">Aksi</th>
                                    <th scope="col" class="text-center font-bold text-gray-700 whitespace-nowrap"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalPeriksas as $jadwalPeriksa)
                                    <tr class="align-middle hover:bg-blue-50 transition border-b border-blue-100">
                                        <th scope="row" class="text-center text-gray-700 whitespace-nowrap">{{ $loop->iteration }}</th>
                                        <td class="text-center font-semibold text-black whitespace-nowrap">{{ $jadwalPeriksa->hari }}</td>
                                        <td class="text-center whitespace-nowrap">{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H:i') }}</td>
                                        <td class="text-center whitespace-nowrap">{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H:i') }}</td>
                                        <td class="text-center whitespace-nowrap">
                                            <span class="inline-block min-w-[80px] px-3 py-1.5 rounded-full text-xs font-bold shadow-md border-2
                                                {{ $jadwalPeriksa->status ? 'btn border-success' : 'btn border-danger' }}">
                                                {{ $jadwalPeriksa->status ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td class="text-center whitespace-nowrap">
                                            <div class="flex flex-row items-center justify-center gap-2">
                                                {{-- Tombol Aktif/Nonaktif --}}
                                                <form action="{{ route('dokter.jadwalperiksa.toggleStatus', $jadwalPeriksa->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="border border-gray-300 text-sm font-semibold rounded-full px-4 py-1.5 shadow-md transition-all duration-300 hover:scale-105
                                                            {{ $jadwalPeriksa->status ? 'btn btn-danger' : 'btn btn-success' }}">
                                                        {{ $jadwalPeriksa->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-center whitespace-nowrap">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('dokter.jadwalperiksa.edit', $jadwalPeriksa->id) }}"
                                                    class="btn btn-warning">
                                                    Edit
                                                </a>

                                                {{-- Tombol Delete --}}
                                                <form action="{{ route('dokter.jadwalperiksa.destroy', $jadwalPeriksa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($jadwalPeriksas->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">
                                            Belum ada jadwal periksa.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
