<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri;

class Index extends Component
{
    // mendeklarasikan roperti publik
    public $search = ''; // ini untuk pencarian

    public function render()
    {
        $industris = Industri::query();

        if (!empty($this->search)) {
            $industris->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%')
                    ->orWhere('website', 'like', '%' . $this->search . '%')
                    ->orWhere('alamat', 'like', '%' . $this->search . '%')
                    ->orWhere('kontak', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.industri.index', [
            'industris' => $industris->get(),
        ]);
    }
}