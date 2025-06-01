<?php

namespace App\Livewire\Industri;

use Livewire\Component;
use App\Models\Industri;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads; // Untuk mengupload file
    public $industriId;
    public $foto, $nama, $bidang_usaha, $website, $email, $kontak, $alamat;

    public function mount($id)
    {
        $this->industriId = $id;
        $industri = Industri::findOrFail($id); 
    
        // Isi value awal form
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

        $this->validate([ // ini semua validasi input
            'foto' => 'nullable|image|max:255',
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'website' => 'required|url|max:255',
                // abaikan record dengan id yang sedang diedit (supaya tidak dianggap duplikat dengan dirinya sendiri)
            'email' => 'required|email|max:255|unique:industris,email,' . $industri->id, 
            'kontak' => 'required|numeric',
            'alamat' => 'required|string|max:500',
        ]);

        // Handle upload jika user mengganti foto
        if (is_object($this->foto)) {
            $fotoPath = $this->foto->store('industri/foto', 'public');
        } else {
            $fotoPath = $this->foto; // pakai foto lama
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
        return view('livewire.industri.edit', [
            'industris' => Industri::all(),
        ]);
    }
}