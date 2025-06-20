<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Pasien Menunggu Diperiksa') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <table class="table table-hover min-w-full">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Pasien</th>
                            <th class="text-center">Hari</th>
                            <th class="text-center">Jam</th>
                            <th class="text-center">Keluhan</th>
                            <th class="text-center">No Antrian</th>
                            <th class="text-center">Status</th> <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($janjis as $janji)
                            <tr class="align-middle hover:bg-blue-50 transition border-b border-blue-100">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $janji->pasien->nama ?? '-' }}</td>
                                <td class="text-center">{{ $janji->JadwalPeriksa->hari ?? '-' }}</td>
                                <td class="text-center">
                                    {{$janji->JadwalPeriksa->jam_mulai}} - {{$janji->JadwalPeriksa->jam_selesai}}
                                </td>
                                <td class="text-center">{{ $janji->keluhan }}</td>
                                <td class="text-center">{{ $janji->no_antrian }}</td>
                                <td class="text-center">
                                    {{-- Cek status pemeriksaan --}}
                                    @if ($janji->periksa) <span class="badge badge-pill badge-success">Sudah Diperiksa</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">Belum Diperiksa</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{-- Tombol aksi sesuai status --}}
                                    @if ($janji->periksa) <a href="{{ route('dokter.memeriksa.edit', $janji->id) }}" class="btn btn-info btn-sm rounded-pill">Edit Pemeriksaan</a>
                                    @else <a href="{{ route('dokter.memeriksa.create', $janji->id) }}" class="btn btn-primary btn-sm rounded-pill">Periksa</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-3">Belum ada janji periksa.</td> </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>