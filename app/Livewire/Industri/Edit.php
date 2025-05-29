<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Industri;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $industriId;
    public $foto;       // path foto lama
    public $newFoto;    // file upload baru
    public $nama, $bidang_usaha, $website, $email, $kontak, $alamat;

    public function mount($id)
    {
        $this->industriId = $id;
        $industri = Industri::findOrFail($id);

        $this->foto = $industri->foto;
        $this->nama = $industri->nama;
        $this->bidang_usaha = $industri->bidang_usaha;
        $this->website = $industri->website;
        $this->email = $industri->email;
        $this->kontak = $industri->kontak;
        $this->alamat = $industri->alamat;
    }

    public function update()
    {
        $industri = Industri::findOrFail($this->industriId);

        $this->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'website' => 'required|url|max:255',
            'email' => 'required|email|max:255|unique:industris,email,' . $industri->id,
            'kontak' => 'required|numeric',
            'alamat' => 'required|string|max:500',
            'newFoto' => 'nullable|image|max:2048', // max 2MB
        ]);

        if ($this->newFoto) {
            // Hapus file lama jika ada
            if ($this->foto && Storage::disk('public')->exists($this->foto)) {
                Storage::disk('public')->delete($this->foto);
            }

            // Simpan file baru ke folder storage/app/public/industri
            $fotoPath = $this->newFoto->store('industri', 'public');
        } else {
            $fotoPath = $this->foto;
        }

        $industri->update([
            'foto' => $fotoPath,
            'nama' => $this->nama,
            'bidang_usaha' => $this->bidang_usaha,
            'website' => $this->website,
            'email' => $this->email,
            'kontak' => $this->kontak,
            'alamat' => $this->alamat,
        ]);

        session()->flash('message', 'Data Industri Berhasil Diupdate.');
        return redirect('/industri');
    }

    public function render()
    {
        return view('livewire.industri.edit');
    }
}