<main class="pt-10">
    <div class="max-w-7xl mx-auto px-6 py-8 bg-[#f9fbf9] rounded-xl shadow-sm border">
        <h2 class="text-xl font-semibold text-gray-800 mb-6 border-b pb-2">Tambahkan Data PKL</h2>

        <form wire:submit.prevent="create" class="space-y-6">

            <!-- Nama Siswa (disabled, tampil otomatis, dengan gaya sama seperti input lain) -->
            <div class="flex flex-col">
                <label for="siswa_id" class="text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                <select wire:model="siswa_id" id="siswa_id" disabled
                    class="rounded-md border-gray-300 shadow-sm px-3 py-2 text-sm bg-gray-100 text-gray-700">
                    <option value="{{ $siswa_id }}">{{ $nama_siswa }}</option>
                </select>
            </div>

            <!-- Nama Guru & Industri -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col">
                    <label for="guru_id" class="text-sm font-medium text-gray-700 mb-1">Nama Guru</label>
                    <select wire:model="guru_id" id="guru_id"
                        class="rounded-md border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-green-600 focus:ring-green-200">
                        <option value="">Pilih Guru</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                        @endforeach
                    </select>
                    @error('guru_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col">
                    <label for="industri_id" class="text-sm font-medium text-gray-700 mb-1">Nama Industri</label>
                    <select wire:model="industri_id" id="industri_id"
                        class="rounded-md border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-green-600 focus:ring-green-200">
                        <option value="">Pilih Industri</option>
                        @foreach($industris as $industri)
                            <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                        @endforeach
                    </select>
                    @error('industri_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Mulai & Selesai -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col">
                    <label for="mulai" class="text-sm font-medium text-gray-700 mb-1">Mulai</label>
                    <input type="date" wire:model="mulai" id="mulai"
                        class="rounded-md border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-green-600 focus:ring-green-200">
                    @error('mulai') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex flex-col">
                    <label for="selesai" class="text-sm font-medium text-gray-700 mb-1">Selesai</label>
                    <input type="date" wire:model="selesai" id="selesai"
                        class="rounded-md border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-green-600 focus:ring-green-200">
                    @error('selesai') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-green-700 hover:bg-green-800 text-white font-semibold py-2 px-6 rounded-md shadow-sm transition">
                    Tambahkan
                </button>
            </div>
        </form>
    </div>
</main>