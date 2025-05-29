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
    $query = Industri::query();

    if (!empty($this->search)) {
        $query->where(function ($q) {
            $q->where('nama', 'like', '%' . $this->search . '%')
              ->orWhere('bidang_usaha', 'like', '%' . $this->search . '%')
              ->orWhere('website', 'like', '%' . $this->search . '%')
              ->orWhere('alamat', 'like', '%' . $this->search . '%')
              ->orWhere('kontak', 'like', '%' . $this->search . '%')
              ->orWhere('email', 'like', '%' . $this->search . '%');
        });
    }

    return view('livewire.industri.index', [
        'industris' => $query->orderBy('created_at', 'desc')->paginate(10),
    ]);
}

}