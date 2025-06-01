<div class="px-8">

    <!-- Notifikasi pesan sukses / error -->
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Header: Tombol Tambah + Form Search -->
    <div class="flex justify-between mb-4 mt-6">
    <!-- Tombol Tambah Data -->
    <a href="{{ route('pklCreate') }}" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-1.5">
        Tambahkan Data PKL
    </a>

    <!-- Form Search -->
    <form class="">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
        <div class="relative overflow-x-auto max-w-screen-xl mx-auto">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" >
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                   wire:model.live="search" placeholder="Search" required />
        </div>
    </form>
</div>


    <!-- Tabel Data PKL -->
    <div class="relative overflow-x-auto bg-white shadow rounded-xl">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">NIS</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Guru Pembimbing</th>
                    <th scope="col" class="px-6 py-3">Industri</th>
                    <th scope="col" class="px-6 py-3">Bidang Usaha</th>
                    <th scope="col" class="px-6 py-3">Mulai</th>
                    <th scope="col" class="px-6 py-3">Selesai</th>
                    <th scope="col" class="px-6 py-3">Durasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pkls as $key => $pkl)
                    <tr class="hover:bg-yellow-200 hover:text-yellow-700 hover:font-bold rounded cursor-pointer transition">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $pkl->siswa->nis }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pkl->siswa->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pkl->guru->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pkl->industri->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pkl->industri->bidang_usaha }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($pkl->mulai)->format('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($pkl->selesai)->format('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($pkl->mulai)->diffInDays(\Carbon\Carbon::parse($pkl->selesai)) }} hari
                        </td>
                        <td class="px-6 py-4 cursor-pointer text-white font-medium">
                            <!-- membuat tautan ke rute pklView (di web.php) dengan id dari data $pkl -->
                            <div class="flex space-x-2">
                            <a href="{{ route('pklView', ['id' => $pkl->id]) }}"
                            class="bg-[#10B981] hover:bg-[#059669] py-2 px-4 rounded-lg">View</a>

                            <!-- menyimpan data pengguna yang sedang login ke $user -->
                            @php
                                $user = Auth::user();
                            @endphp

                            <!-- $user -->
                                <!-- ini ni dari varibel yang kita buat di atas, data pengguna yang sedang login saat ini -->
                            <!-- operator && -->
                                <!-- jika 1 salah, maka salah -->
                                <!-- jika user belum login, maka ini tidak bisa dijalankan -->
                            <!-- $user->email -->
                                <!-- properti (nilai) email dari pengguna yang sedang login -->
                                <!-- misalnya pengguna login dengan karla@gmail.com, maka Auth::user()->email (alias $user->email) nilainya "karla@gmail.com" -->
                            <!-- $pkl->siswa->email -->
                                <!-- ->siswa adalah relasi Eloquent antara tabel pkl dan siswa -->
                                <!-- ambil email siswa dari relasi tadi -->
                            @if ($user && $user->email === $pkl->siswa->email)
                            <!-- Tombol Edit hanya muncul jika email user = email siswa -->
                                <a href="{{ route('pklEdit', ['id' => $pkl->id]) }}"
                                class="bg-[#FFBF24] hover:bg-[#F59E0B] py-2 px-4 rounded-lg">Edit</a>
                            @endif
                            </div> 
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">Siswa tidak terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $pkls->links('pagination::tailwind') }}
    </div>
</div>
</div>