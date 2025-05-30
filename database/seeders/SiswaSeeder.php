<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = Siswa::insert([
            [
                'nama' => 'ABU BAKAR TSABIT GHUFRON', 
                'nis' => '20388',
                'gender' => 'Laki-Laki',
                'rombel' => 'SIJA A',
                'alamat' => 'Sleman',
                'kontak' => '085839328609',
                'email' => 'makinamikayumi@gmail.com',
                'status_pkl'=> false,
            ],
            [
                'nama' => 'MUTIARA SEKAR KINASIH', 
                'nis' => '20431',
                'gender' => 'Perempuan',
                'rombel' => 'SIJA B',
                'alamat' => 'Bantul',
                'kontak' => '085198553807',
                'email' => 'mtiaraskinasih@gmail.com',
                'status_pkl'=> false,
            ],
            [
                'nama' => 'ADE ZAIDAN ALTHAF', 
                'nis' => '20390',
                'gender' => 'Laki-Laki',
                'rombel' => 'SIJA A',
                'alamat' => 'Gunungkidul',
                'kontak' => '087786760589',
                'email' => 'adezaidan24@gmail.com',
                'status_pkl'=> false,
            ],
            [
                'nama' => 'ANGELINA THITHIS SEKAR LANGIT', 
                'nis' => '20396',
                'gender' => 'Perempuan',
                'rombel' => 'SIJA A',
                'alamat' => 'Kulonprogo',
                'kontak' => '081272353535',
                'email' => 'arrowofdarkness2@gmail.com',
                'status_pkl'=> false,
            ],
            [
                'nama' => 'MARCELLINUS CHRISTO PRADIPTA', 
                'nis' => '20422',
                'gender' => 'Laki-Laki',
                'rombel' => 'SIJA A',
                'alamat' => 'Sleman',
                'kontak' => '089688361696',
                'email' => 'marchllinuschristo11@gmail.com',
                'status_pkl'=> false,
            ],
            [
                'nama' => 'NAUFELIRNA SUBKHI RAMADHANI', 
                'nis' => '20454',
                'gender' => 'Perempuan',
                'rombel' => 'SIJA B',
                'alamat' => 'Klaten',
                'kontak' => '089671421234',
                'email' => 'adzanaufel705@gmail.com',
                'status_pkl'=> false,
            ],
            [
                'nama' => 'ROSYIDAH MUTHMAINNAH', 
                'nis' => '20448',
                'gender' => 'Perempuan',
                'rombel' => 'SIJA B',
                'alamat' => 'Sleman',
                'kontak' => '087883538770',
                'email' => 'rosyi.html@gmail.com',
                'status_pkl'=> false,
            ],
            [
                'nama' => 'GABRIEL POSSENTI GENTA BAHANA NAGARI', 
                'nis' => '20410',
                'gender' => 'Laki-Laki',
                'rombel' => 'SIJA A',
                'alamat' => 'Sleman',
                'kontak' => '089634085990',
                'email' => 'gentapossenti@gmail.com',
                'status_pkl'=> false,
            ],
            [
                'nama' => 'NAFISYA RHEA PRAYASTI', 
                'nis' => '20433',
                'gender' => 'Perempuan',
                'rombel' => 'SIJA B',
                'alamat' => 'Bantul',
                'kontak' => '08816752848',
                'email' => 'nafisyarhea29@gmail.com',
                'status_pkl'=> false,
            ],
            [
                'nama' => 'FARCHA AMALIA NUGRAHAINI', 
                'nis' => '20408',
                'gender' => 'Perempuan',
                'rombel' => 'SIJA A',
                'alamat' => 'Sleman',
                'kontak' => '0895380761274',
                'email' => 'farchaamalia@gmail.com',
                'status_pkl'=> false,
            ],
        ]);
    }
}