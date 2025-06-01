<?php

namespace App\Filament\Resources\GuruResource\Pages;

use App\Filament\Resources\GuruResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuru extends EditRecord
{
    protected static string $resource = GuruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make()
            ->before(function ($record, \Filament\Actions\DeleteAction $action) { // Menambahkan pemeriksaan sebelum menghapus
                // Memeriksa apakah guru ini masih digunakan dalam PKL
                // Jika masih digunakan, tampilkan notifikasi dan hentikan aksi penghapusan
                if ($record->pkl()->exists()) {
                    \Filament\Notifications\Notification::make()
                        ->title('Gagal menghapus guru!')
                        ->body('Guru ini masih digunakan dalam PKL. Hapus PKL terkait terlebih dahulu.')
                        ->danger()
                        ->send();

                    $action->halt(); // Menghentikan aksi penghapusan
                }
            }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
