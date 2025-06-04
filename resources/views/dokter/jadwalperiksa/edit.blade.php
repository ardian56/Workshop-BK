<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-lg rounded-lg">
                <form action="{{ route('dokter.jadwalperiksa.update', $jadwalPeriksa->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH') {{-- Menggunakan PATCH untuk update --}}

                    <div>
                        <label for="hari" class="block mb-1 font-semibold text-gray-700">Hari</label>
                        <select name="hari" id="hari" class="form-select w-full @error('hari') is-invalid @enderror" required>
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin" {{ old('hari', $jadwalPeriksa->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari', $jadwalPeriksa->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari', $jadwalPeriksa->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari', $jadwalPeriksa->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari', $jadwalPeriksa->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('hari', $jadwalPeriksa->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ old('hari', $jadwalPeriksa->hari) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                        @error('hari')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jam_mulai" class="block mb-1 font-semibold text-gray-700">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control w-full @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai', \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H:i')) }}" required>
                            @error('jam_mulai')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="jam_selesai" class="block mb-1 font-semibold text-gray-700">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control w-full @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai', \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H:i')) }}" required>
                            @error('jam_selesai')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block mb-1 font-semibold text-gray-700">Status</label>
                        <select name="status" id="status" class="form-select w-full @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status', $jadwalPeriksa->status) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $jadwalPeriksa->status) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex gap-2 justify-end">
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded shadow bg-blue-600 text-white hover:bg-blue-700">Simpan Perubahan</button>
                        <a href="{{ route('dokter.jadwalperiksa.index') }}" class="btn btn-secondary px-5 py-2 rounded bg-gray-200 text-gray-800 hover:bg-gray-300">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
