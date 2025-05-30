<!-- Knowing others is intelligence; knowing yourself is true wisdom.  -->
<div class="pt-16">

    <div class="m-4">
        <div class="bg-white py-4 px-8 rounded-xl shadow-md">
            <div class="text-xl border-b pb-4 mb-2 border-[#FCD34D] font-medium text-black/70">
                Edit Industri
            </div>
    
            <div class="w-full flex flex-col gap-y-4">

                <!-- foto -->
                <form action="">
                    <label for="nama" class="block mb-2 text-lg font-medium text-black/70">Logo Industri</label>
                    <input type="file" wire:model="foto" id="foto"
                        class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                        focus:ring-[#FCD34D] focus:border-[#FCD34D]
                        @error('foto') border-red-600 @enderror"
                        accept="image/*">
                    @error('foto')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </form>
    
                <!-- nama -->
                <form class="">
                    <label for="nama" class="block mb-2 text-lg font-medium text-black/70">Nama Industri</label>
                    <input type="text" wire:model='nama' id="nama"
                    class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                    focus:ring-[#FCD34D] focus:border-[#FCD34D]
                            @error('nama') border-red-600 @enderror" 
                    required>
                    @error('nama') 
                        <span class="text-red-600">{{ $message }}</span> 
                    @enderror
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 w-full">
                    <!-- bidang usaha -->
                    <form class="">
                        <label for="bidang_usaha" class="block mb-2 text-lg font-medium text-black/70">Bidang Usaha</label>
                        <input type="text" wire:model='bidang_usaha' id="bidang_usaha"
                        class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                        focus:ring-[#FCD34D] focus:border-[#FCD34D]
                                @error('bidang_usaha') border-red-600 @enderror" 
                        required>
                        @error('bidang_usaha') 
                            <span class="text-red-600">{{ $message }}</span> 
                        @enderror
                    </form>

                    <!-- website -->
                    <form class="">
                        <label for="website" class="block mb-2 text-lg font-medium text-black/70">Website</label>
                        <input type="url" wire:model='website' id="website"
                        class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                        focus:ring-[#FCD34D] focus:border-[#FCD34D]
                                @error('website') border-red-600 @enderror" 
                        required>
                        @error('website') 
                            <span class="text-red-600">{{ $message }}</span> 
                        @enderror
                    </form>

                    <!-- email -->
                    <form class="">
                        <label for="email" class="block mb-2 text-lg font-medium text-black/70">Email</label>
                        <input type="email" wire:model='email' id="email"
                        class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                        focus:ring-[#FCD34D] focus:border-[#FCD34D]
                                @error('email') border-red-600 @enderror" 
                        required>
                        @error('email') 
                            <span class="text-red-600">{{ $message }}</span> 
                        @enderror
                    </form>

                    <!-- kontak -->
                    <form class="">
                        <label for="email" class="block mb-2 text-lg font-medium text-black/70">Kontak</label>
                        <input type="tal" wire:model='kontak' id="kontak"
                        class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                        focus:ring-[#FCD34D] focus:border-[#FCD34D]
                                @error('kontak') border-red-600 @enderror" 
                        required>
                        @error('kontak') 
                            <span class="text-red-600">{{ $message }}</span> 
                        @enderror
                    </form>
                </div>
                
                <!-- alamat -->
                <form class="">
                    <label for="alamat" class="block mb-2 text-lg font-medium text-black/70">Alamat</label>
                    <input type="text" wire:model='alamat' id="alamat"
                    class="text-sm rounded-lg block w-full p-2.5 bg-[#E7EBE8] text-black-700 border border-[#FCD34D]
                    focus:ring-[#FCD34D] focus:border-[#FCD34D]
                            @error('alamat') border-red-600 @enderror" 
                    required>
                    @error('alamat') 
                        <span class="text-red-600">{{ $message }}</span> 
                    @enderror
                </form>
    
                <div class="flex justify-end gap-4">
                    <a  href="{{ route('industri') }}" type="button"
                            class="text-center text-white bg-[#FCD34D] hover:bg-yellow-500 font-medium rounded-lg text-sm py-2.5 px-6 mt-4">
                        Kembali
                    </a>
    
                    <a wire:click="update" type="button" class="text-center text-white bg-[#FCD34D] hover:bg-yellow-500 font-medium rounded-lg text-sm py-2.5 px-6 mt-4">
                        Update Data
                    </a>
                </div>
                
            </div>
        </div>
    </div>

</div>