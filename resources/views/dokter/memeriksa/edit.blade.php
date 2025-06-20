<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ __('Edit Pemeriksaan Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray overflow-hidden shadow-xl sm:rounded-lg p-8">
                {{-- Ganti action ke update --}}
                <form action="{{ route('dokter.memeriksa.store') }}" method="POST">
                    @csrf
                    {{-- <input type="hidden" name="_method" value="PUT"> --}}
                    {{-- ATAU, jika Anda menggunakan updateOrCreate di method store(), tidak perlu @method('PUT') --}}

                    <input type="hidden" name="id_janji_periksa" value="{{ $janji->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="nama_pasien" class="block text-gray-700 text-sm font-bold mb-2">Nama Pasien</label>
                            <input type="text" id="nama_pasien" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" value="{{ $janji->pasien->nama ?? '-' }}" readonly>
                        </div>
                        <div>
                            <label for="no_rm" class="block text-gray-700 text-sm font-bold mb-2">No RM</label>
                            <input type="text" id="no_rm" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" value="{{ $janji->pasien->no_rm ?? '-' }}" readonly>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="keluhan" class="block text-gray-700 text-sm font-bold mb-2">Keluhan</label>
                        <textarea id="keluhan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 h-24" readonly>{{ $janji->keluhan }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="tgl_periksa" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Periksa</label>
                        {{-- ISI DENGAN DATA YANG SUDAH ADA DARI $janji->periksa --}}
                        <input type="date" name="tgl_periksa" id="tgl_periksa" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tgl_periksa', \Carbon\Carbon::parse($janji->periksa->tgl_periksa ?? now())->format('Y-m-d')) }}" required>
                        @error('tgl_periksa')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="catatan" class="block text-gray-700 text-sm font-bold mb-2">Catatan Pemeriksaan</label>
                        {{-- ISI DENGAN DATA YANG SUDAH ADA DARI $janji->periksa --}}
                        <textarea name="catatan" id="catatan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-32" required>{{ old('catatan', $janji->periksa->catatan ?? '') }}</textarea>
                        @error('catatan')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Obat</label>
                        <div id="obat-list" class="space-y-3">
                            {{-- Loop untuk mengisi obat yang sudah dipilih sebelumnya --}}
                            @if($janji->periksa && $janji->periksa->detailPeriksa->isNotEmpty())
                                @foreach($janji->periksa->detailPeriksa as $detailPeriksa)
                                    <div class="flex items-center gap-3">
                                        <select name="obat_ids[]" class="obat-dropdown block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                            <option value="">-- Pilih Obat --</option>
                                            @foreach($obats as $obat)
                                                <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}" {{ ($detailPeriksa->id_obat == $obat->id) ? 'selected' : '' }}>
                                                    {{ $obat->nama_obat }} ({{ $obat->kemasan }}) - Rp{{ number_format($obat->harga,0,',','.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="remove-obat bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex-shrink-0">
                                            -
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                {{-- Default satu dropdown jika belum ada obat --}}
                                <div class="flex items-center gap-3">
                                    <select name="obat_ids[]" class="obat-dropdown block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                        <option value="">-- Pilih Obat --</option>
                                        @foreach($obats as $obat)
                                            <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">{{ $obat->nama_obat }} ({{ $obat->kemasan }}) - Rp{{ number_format($obat->harga,0,',','.') }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="add-obat bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex-shrink-0">
                                        +
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="add-obat-initial bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-3">
                            Tambah Obat Baru
                        </button>
                        @error('obat_ids')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="totalBiaya" class="block text-gray-700 text-sm font-bold mb-2">Estimasi Total Biaya</label>
                        <input type="text" id="totalBiaya" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100 font-bold text-lg" value="Rp{{ number_format(100000,0,',','.') }}" readonly>
                        <small class="text-gray-500 text-xs mt-1 block">Biaya pemeriksaan: Rp100.000 + total harga obat yang dipilih.</small>
                    </div>

                    {{-- Script JavaScript --}}
                    <script>
                        function updateTotalBiaya() {
                            let total = 100000;
                            document.querySelectorAll('.obat-dropdown').forEach(function(select) {
                                const harga = select.options[select.selectedIndex]?.getAttribute('data-harga');
                                if (harga) total += parseInt(harga);
                            });
                            document.getElementById('totalBiaya').value = 'Rp' + total.toLocaleString('id-ID');
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            updateTotalBiaya(); // Initial calculation

                            const obatList = document.getElementById('obat-list');

                            // Handle change on existing/new dropdowns
                            obatList.addEventListener('change', function(e) {
                                if (e.target.classList.contains('obat-dropdown')) {
                                    updateTotalBiaya();
                                }
                            });

                            // Event listener for adding/removing rows
                            document.querySelector('.add-obat-initial').addEventListener('click', function() {
                                const newRow = obatList.firstElementChild.cloneNode(true);
                                newRow.querySelector('select').value = ''; // Clear selected value for the new dropdown
                                let btn = newRow.querySelector('button');
                                btn.classList.remove('bg-green-500', 'hover:bg-green-700', 'add-obat'); // Old add-obat if cloned from first element
                                btn.classList.add('bg-red-500', 'hover:bg-red-700', 'remove-obat');
                                btn.textContent = '-';
                                obatList.appendChild(newRow);
                                updateTotalBiaya(); // Recalculate after adding
                            });

                            obatList.addEventListener('click', function(e) {
                                if (e.target.classList.contains('remove-obat')) {
                                    if (obatList.children.length > 1) { // Prevent removing the last dropdown
                                        e.target.parentElement.remove();
                                        updateTotalBiaya(); // Recalculate after removing
                                    }
                                }
                            });
                        });
                    </script>

                    <div class="flex justify-end gap-3 mt-8">
                        <a href="{{ route('dokter.memeriksa.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                            Simpan Pemeriksaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>