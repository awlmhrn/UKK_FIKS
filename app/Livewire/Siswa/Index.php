<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Siswa;

class Index extends Component
{
    use WithPagination; // untuk pagination

    public $search = '';
    public $selected_gender = [];
    public $selected_rombel = [];
    public $selected_abjad = [];

    public function render()
    {
         $genders = [
            'Laki-Laki' => 'Laki-Laki',
            'Perempuan' => 'Perempuan',
        ];

        $rombels = [
            'SIJA A' => 'SIJA A',
            'SIJA B' => 'SIJA B',
        ];

        $siswas = Siswa::query();

        if (!empty($this->search)) {
            $siswas->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('nis', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%')
                    ->orWhere('kontak', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // gender
        if ($this->selected_gender) {
            $siswas->where('gender', $this->selected_gender);
        }

        // rombel
        if ($this->selected_rombel) {
            $siswas->where('rombel', $this->selected_rombel);
        }

        // abjad
        if ($this->selected_abjad) {
            if ($this->selected_abjad === 'Abjad:A - Z') { 
                $siswas->orderBy('nama', 'asc'); // ascending, dari kecil ke besar → A ke Z, 1 ke 100
            } elseif ($this->selected_abjad === 'Abjad:Z - A') {
                $siswas->orderBy('nama', 'desc'); // descending,	dari besar ke kecil → Z ke A, 100 ke 1
            }
        }

        return view('livewire.siswa.index', [
            'siswas' => $siswas->paginate(5), // paginate(5) artinya tampilkan 5 data per halaman
            'genders' => $genders,
            'rombels' => $rombels,
        ]);
    }
}