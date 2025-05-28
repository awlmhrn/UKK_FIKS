<div>
    <tbody>
        @forelse ($gurus as $key => $guru)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $key + 1 }}
                </th>
                <td class="px-6 py-4">
                    {{ $guru->id }}
                </td>
                <td class="px-6 py-4">
                    {{ $guru->nama }}
                </td>
                <td class="px-6 py-4">
                    {{ $guru->nip }}
                </td>
                <td class="px-6 py-4">
                    {{ $guru->gender }}
                </td>
                <td class="px-6 py-4">
                    {{ $guru->alamat }}
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

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="px-6 py-4 text-center text-gray-500">Siswa tidak terdaftar.</td>
            </tr>
        @endforelse
    </tbody>
</div>