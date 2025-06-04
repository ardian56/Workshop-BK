<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-lg rounded-lg">
                <form action="{{ route('dokter.jadwalperiksa.store') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Input untuk Dokter (id_dokter) - DIHAPUS karena otomatis dari user login --}}
                    {{-- <div>
                        <label for="id_dokter" class="block mb-1 font-semibold text-gray-700">Dokter</label>
                        <select name="id_dokter" id="id_dokter" class="form-select w-full @error('id_dokter') is-invalid @enderror" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}" {{ old('id_dokter') == $dokter->id ? 'selected' : '' }}>{{ $dokter->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_dokter')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div>
                        <label for="hari" class="block mb-1 font-semibold text-gray-700">Hari</label>
                        <select name="hari" id="hari" class="form-select w-full @error('hari') is-invalid @enderror" required>
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                        @error('hari')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jam_mulai" class="block mb-1 font-semibold text-gray-700">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control w-full @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}" required>
                            @error('jam_mulai')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="jam_selesai" class="block mb-1 font-semibold text-gray-700">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control w-full @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}" required>
                            @error('jam_selesai')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block mb-1 font-semibold text-gray-700">Status</label>
                        <select name="status" id="status" class="form-select w-full @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex gap-2 justify-end">
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded shadow bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                        <a href="{{ route('dokter.jadwalperiksa.index') }}" class="btn btn-secondary px-5 py-2 rounded bg-gray-200 text-gray-800 hover:bg-gray-300">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
