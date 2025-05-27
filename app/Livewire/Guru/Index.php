<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Guru;

class Index extends Component
{
    // apa public-public ini?
    // karena ini adalah Livewire component, dan agar property bisa di-bind ke form di Blade (dengan wire:model), properti harus public
    // public $search = ''; // ini nama property, yang akan dipanggil di blade dengan wire:model.live
    // public $selected_gender = [];
    // public $selected_abjad = [];

    public function render()
    {
        // sekadar menerjemahkan enum field gender dengan variable genders
        $genders = [
            'Laki-Laki' => 'Laki-Laki',
            'Perempuan' => 'Perempuan',
        ];

        $gurus = Guru::all(); // ambil semua data guru

        return view('livewire.guru.index', [
            'gurus' => $gurus,
            'genders' => $genders,
        ]);
    }
}
