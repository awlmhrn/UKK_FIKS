<?php

namespace App\Filament\Resources\IndustriResource\Pages;

use App\Filament\Resources\IndustriResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ViewAction;
use Filament\Pages\Actions\DeleteAction;

class EditIndustri extends EditRecord
{
    protected static string $resource = IndustriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
                ->action(function () {
                    $record = $this->record;

                    // panggil fungsi pengecekan sebelum hapus
                    IndustriResource::deleteIndustri($record);
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
