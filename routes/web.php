<?php

use Illuminate\Support\Facades\Route;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Halaman jika belum dapat akses (menunggu verifikasi role)
Route::get('/menungguAksesAdmin', App\Livewire\MenungguAkses::class)
    ->middleware('auth')
    ->name('menungguAdmin');

// Middleware: auth + verifikasi + role
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'CheckUserRoles:super_admin,siswa', // <- dinamis: bisa ditambah admin,guru,dll
])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // PKL
    Route::get('/dataPkl', App\Livewire\Pkl\Index::class)->name('pkl');
    Route::get('/dataPkl/tambah', App\Livewire\Pkl\Create::class)->name('pklCreate');
    Route::get('/dataPkl/{id}', App\Livewire\Pkl\View::class)->name('pklView');
    Route::get('/dataPkl/{id}/edit', App\Livewire\Pkl\Edit::class)->name('pklEdit');

    // Guru
    Route::get('/guru', App\Livewire\Guru\Index::class)->name('guru');

    // Siswa
    Route::get('/siswa', App\Livewire\Siswa\Index::class)->name('siswa');

    // Industri
    Route::get('/industri', App\Livewire\Industri\Index::class)->name('industri');
    Route::get('/industri/tambah', App\Livewire\Industri\Create::class)->name('industriCreate');
    Route::get('/industri/{id}/edit', App\Livewire\Industri\Edit::class)->name('industriEdit');
});