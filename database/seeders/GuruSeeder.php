<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gurus = Guru::insert([
            [
                'nama' => 'Sugiarto, ST', 
                'nip' => '197203172005011012',
                'gender' => 'Laki-Laki',
                'alamat' => 'Klaten',
                'kontak' => '085643188811',
                'email' => 'mrantazy68@gmail.com'
            ],
            [
                'nama' => 'Yunianto Hermawan, S.Kom', 
                'nip' => '197306202006041005',
                'gender' => 'Laki-Laki',
                'alamat' => 'Klaten',
                'kontak' => '081548734649',
                'email' => 'yuniantohermawan@gmail.com'
            ],
            [
                'nama' => 'Eka Nur Ahmad Romadhoni, S.Pd.', 
                'nip' => '199303012019031011',
                'gender' => 'Laki-Laki',
                'alamat' => 'Klaten',
                'kontak' => '085895780078',
                'email' => 'eka.html@gmail.com'
            ],
            [
                'nama' => 'M. Endah Titisari, ST', 
                'nip' => '197403022006042008',
                'gender' => 'Perempuan',
                'alamat' => 'Pokoh, Maguwo',
                'kontak' => '085608990027',
                'email' => 'mareta.susend@gmail.com'
            ],
            [
                'nama' => 'Rr. Retna Trimantaraningsih, ST', 
                'nip' => '197006272021212002',
                'gender' => 'Perempuan',
                'alamat' => 'Denggung',
                'kontak' => '0856436402427',
                'email' => 'rereningsihlarose@gmail.com'
            ],
            [
                'nama' => 'Ratna Yunita Sari, ST', 
                'nip' => '197107082022211003',
                'gender' => 'Perempuan',
                'alamat' => 'Gendeng Kidul',
                'kontak' => '085228771506',
                'email' => 'ratnayu2014@gmail.com'
            ],
        ]);
    }
}