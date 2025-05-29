<div class="pt-16">
    <div class="m-4">
        <div class="bg-white py-4 px-8 rounded-xl shadow-md">
            <div class="text-xl border-b pb-4 mb-2 border-[#FCD34D] font-medium text-black/70">
                Edit Industri
            </div>

            <div class="w-full flex flex-col gap-y-4">
                <!-- Tampilkan gambar lama -->
                @if ($foto && !is_object($foto))
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $foto) }}" alt="Logo Industri" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif

                <!-- Upload foto baru -->
                <label for="foto" class="block mb-2 text-lg font-medium text-black/70">Logo Industri</label>
                <input type="file" wire:model="newFoto" id="foto"
                    class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                    focus:ring-[#FCD34D] focus:border-[#FCD34D]
                    @error('newFoto') border-red-600 @enderror"
                    accept="image/*">
                @error('newFoto')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror

                <!-- Nama -->
                <label for="nama" class="block mb-2 text-lg font-medium text-black/70">Nama Industri</label>
                <input type="text" wire:model='nama' id="nama"
                    class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                    focus:ring-[#FCD34D] focus:border-[#FCD34D]
                    @error('nama') border-red-600 @enderror"
                    required>
                @error('nama')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 w-full">
                    <!-- bidang usaha -->
                    <div>
                        <label for="bidang_usaha" class="block mb-2 text-lg font-medium text-black/70">Bidang Usaha</label>
                        <input type="text" wire:model='bidang_usaha' id="bidang_usaha"
                            class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                            focus:ring-[#FCD34D] focus:border-[#FCD34D]
                            @error('bidang_usaha') border-red-600 @enderror"
                            required>
                        @error('bidang_usaha')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- website -->
                    <div>
                        <label for="website" class="block mb-2 text-lg font-medium text-black/70">Website</label>
                        <input type="url" wire:model='website' id="website"
                            class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                            focus:ring-[#FCD34D] focus:border-[#FCD34D]
                            @error('website') border-red-600 @enderror"
                            required>
                        @error('website')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- email -->
                    <div>
                        <label for="email" class="block mb-2 text-lg font-medium text-black/70">Email</label>
                        <input type="email" wire:model='email' id="email"
                            class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                            focus:ring-[#FCD34D] focus:border-[#FCD34D]
                            @error('email') border-red-600 @enderror"
                            required>
                        @error('email')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- kontak -->
                    <div>
                        <label for="kontak" class="block mb-2 text-lg font-medium text-black/70">Kontak</label>
                        <input type="tel" wire:model='kontak' id="kontak"
                            class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                            focus:ring-[#FCD34D] focus:border-[#FCD34D]
                            @error('kontak') border-red-600 @enderror"
                            required>
                        @error('kontak')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- alamat -->
                <label for="alamat" class="block mb-2 text-lg font-medium text-black/70">Alamat</label>
                <input type="text" wire:model='alamat' id="alamat"
                    class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                    focus:ring-[#FCD34D] focus:border-[#FCD34D]
                    @error('alamat') border-red-600 @enderror"
                    required>
                @error('alamat')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror

                <div class="flex justify-end gap-4 mt-4">
                    <a href="{{ route('industri') }}"
                        class="text-center text-white bg-[#FCD34D] hover:bg-yellow-500 font-medium rounded-lg text-sm py-2.5 px-6">
                        Kembali
                    </a>

                    <button wire:click="update" type="button"
                        class="text-center text-white bg-[#FCD34D] hover:bg-yellow-500 font-medium rounded-lg text-sm py-2.5 px-6">
                        Update Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
