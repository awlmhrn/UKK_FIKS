<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Mengimpor facade Auth yang digunakan untuk mengakses informasi pengguna yang sedang login
use Symfony\Component\HttpFoundation\Response;

class CheckUserRoles
{
    public function handle(Request $request, Closure $next): Response
    {
        // ini bukan komen kang.. lebih dari itu
        // ini namanya dockblock, biasanya untuk dokumentasi otomatis
        // biasanya untuk memberitahu IDE (Integrated Development Environment) mengenai tipe data yang digunakan
        // IDE ini software untuk ngembangin software, jadi kayak VS Code ini sendiri, lalu Arduino IDE
        // dockblock dalam konteks ini adalah:
        /**
         * @var \App\Models\User $user
         * $user : ini nama variabelnya, jadi bebas
         */

        // mengambil data pengguna yang sedang login melalui Auth::user() dan menyimpannya dalam variabel $user
        // ::user() ini memang sintaksnya, jadi jangan diganti
        $user = Auth::user();

        // bahas satu-satu
        // !Auth::check()
        // --> kan di kode atas sudah dibuatkan variabel $user untuk menyimpan kondisi pengecekan user sudah login atau belum
        // --> jika user sudah login, hasilnya true
        // --> jika user belum login, hasilnya false
        // --> dalam konteks ini kita menggunakan ! di depan, yang berarti NOT
        // --> maka: Jika user belum login ...

        // mengapa menggunakan operator || (atau)
        // --> kan diketahui satu true, maka true
        // --> maka, jika salah satu kondisi bernilai true, if ini akan dijalankan
        // --> maka: ... atau ...

        // !$user->hasAnyRole(['super_admin', 'siswa'])
        // --> apakah user yang login memiliki salah satu dari atau keduanya dari role tersebut
        // --> jika ingin hanya 1 role, bisa tetap hasAnyRole atau seadar hasRole
        // --> jika memiliki satu atau keduanya role maka true
        // --> jika tidak memiliki salah satu keduanya role maka false
        // --> dan penting juga kan, maka NOT
        // --> maka: ... Jika user tidak memiliki salah satu atau kedua role

        // jika user belum login ATAU jika user tidak memiliki salah satu role atau kedua role
        if (!Auth::check() || !$user->hasAnyRole(['super_admin', 'siswa'])) {
            // maka jalankan perintah ini
            // abort(403, 'Anda belum punya akses. Silakan hubungi admin :)');
            return redirect()->route('menungguAdmin');
        }

        return $next($request);
    }
}