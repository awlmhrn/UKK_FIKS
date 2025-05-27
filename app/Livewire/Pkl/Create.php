<?php

namespace App\Livewire\Pkl;

use Livewire\Component;
use App\Models\Pkl;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\Industri;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $siswa_id, $guru_id, $industri_id, $mulai, $selesai;

    // menyimpan nama siswa yang sedang login
    public $nama_siswa;

    // otomatis dijalankan saat komponen Livewire dibuat, mount ini yang pertama
    public function mount()
    {

        // ambil email user yang sedang login
        // ini mengambil data dari tabel users
        // sistem autentikasi Laravel secara default menggunakan model App\Models\User yang terkait langsung dengan tabel users
        $userEmail = Auth::user()->email;

        // cari data siswa berdasarkan email
        // Siswa::where('email', $userEmail) : berarti, pada model Siswa, pada database siswas, cari email berdasarkan $userEmail (mengambil email user yang sedang login)
        // nilainya akan disimpan di $siswa
        $siswa = Siswa::where('email', $userEmail)->first();

        // email cocok (di $siwa tadi)
        if ($siswa) {
            // maka :
            // simpan ID siswa ($siswa->id) ke $siswa_id (dipakai untuk input form tersembunyi)
            $this->siswa_id = $siswa->id;
            // simpan nama ($siswa->nama) ke $nama_siswa (dipakai untuk ditampilkan)
            $this->nama_siswa = $siswa->nama;
        }
    }

    // fungsi yang akan dipanggil ketika user menekan button Tambahkan, kan di button view ada wire:click="create", nah itu ini
    public function create() {
        $this->validate([  // ini semua validasi input
            // nah, nama validasi ini juga disesuaikan dari wire:model di blade
            'siswa_id' => 'required|exists:siswas,id',
                // 'siswa_id' => Nama field/input yang sedang divalidasi
                // exists:gurus,id (format: exists:table,column)
            'guru_id' => 'required|exists:gurus,id',
            'industri_id' => 'required|exists:industris,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after_or_equal:mulai', // tanggal selesai harus setelah atau sama dengan tanggal mulai
        ]);
        
        // mulai transaksi database - supaya semua query berikutnya dijalankan bersama, dan bisa di-rollback kalau terjadi error
        DB::beginTransaction();

        try {
            // ambil data siswa berdasarkan siswa_id. jika tidak ditemukan, akan otomatis gagal dengan error (404)
            $siswa = Siswa::findOrFail($this->siswa_id);

            // cek apakah siswa sudah pernah melaporkan PKL sebelumnya (status_lapor_pkl == 1)
            $existingPkl = Pkl::where('siswa_id', $this->siswa_id)->exists();

            if ($existingPkl) {
                DB::rollBack(); // jika ada data, data akan di rollback (membatalkan semua perubahan database) dengan memunculkan pesan dibawah ini (harus dipanggil dulu)
                                // kan tadi udah dilakukan DB:beginTransaction();, maka rollBack() ini akan mengembalikan database ke kondisi sebelum transaksi dimulai
                session()->flash('error', 'Transaksi dibatalkan: Siswa sudah memiliki data PKL.'); // nah ini pesan error yang akan muncul
                return redirect('/dataPkl'); //mengarahkan user kembali ke /dataPkl
            }

            // lanjut simpan data PKL yang baru ke database
            Pkl::create([
                'siswa_id' => $this->siswa_id,
                'guru_id' => $this->guru_id,
                'industri_id' => $this->industri_id,
                'mulai' => $this->mulai,
                'selesai' => $this->selesai,
            ]);

            // $siswa->status_lapor_pkl = true;
            $siswa->save(); // tanpa status_lapor_pkl

            //simpan transaksi secara permanen ke databse (commit semua perubahan)
            DB::commit(); // menyimpan semua perubahan ke database jika tidak ada error

            session()->flash('success', 'Data PKL berhasil ditambahkan!'); // pesan sukses
            return redirect('/dataPkl'); // kembali ke halaman data PKL

        } catch (\Exception $e) { // tangkap semua error yang mungkin teradi selama proses penyimpanan
            DB::rollBack(); // kalau ada error, semua perubahan dibatalkan
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage()); // tampilkan pesan asli error
            return;
        }
    }

    public function render()
    {
        // Ambil semua data siswa, guru, industri untuk dropdown (tanpa filter pencarian)
        $pkls = Pkl::all();
        // $siswas = Siswa::all();
        $gurus = Guru::all();
        $industris = Industri::all();

        return view('livewire.pkl.create', [
            'pkls' => $pkls,
            // 'siswas' => $siswas,
            'gurus' => $gurus,
            'industris' => $industris,
        ]);

        // $siswas = Siswa::all(); 
        // 'siswas' => $siswas,
        // di komenkan, karena kemarin digunakan untuk dropwodn, nampilin SEMUA namanya, namun sekarang SATU nama berdasarkan login        
    }
}
