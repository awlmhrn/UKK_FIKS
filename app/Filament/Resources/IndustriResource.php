<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndustriResource\Pages;
use App\Filament\Resources\IndustriResource\RelationManagers;
use App\Models\Industri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndustriResource extends Resource
{
    protected static ?string $model = Industri::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2) //form dibagi jadi 2 kolom per baris
                ->schema([
                    //gambar
                    Forms\Components\FileUpload::make('gambar')
                        ->label('Logo Industri')
                        ->image() //menjadikan file yang diupload sebagai gambar
                        ->directory('industri') //folder penyimpanan di storage/app/public/[industri]
                        ->columnspan(2)
                        ->required(), //wajib
                    
                    //nama
                    Forms\Components\TextInput::make('nama')
                        ->label('Nama')                     //ada di atas form
                        ->placeholder('Nama Industri')      //ada di dalam form
                        ->required(),

                    //bidang usaha
                    Forms\Components\TextInput::make('bidang_usaha')
                        ->label('Bidang Usaha')                    
                        ->placeholder('Bidang Usaha')      
                        ->required(),

                    //email
                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->placeholder('Email Industri')
                        ->required(),
                    
                    //kontak
                    Forms\Components\TextInput::make('kontak')
                        ->label('Kontak')
                        ->placeholder('Kontak Industri')
                        ->required(),
                    
                    //alamat
                    Forms\Components\TextInput::make('alamat')
                        ->label('Alamat')
                        ->placeholder('Alamat Industri')
                        ->columnspan(2)
                        ->required(),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // id menjadi nomor urut berdasarkan id terkecil hingga terbesar
                // ini sekedar di table filamentnya, pada database tetap sesuai dengan id yang tersimpan dan terhapus
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->getstateUsing(fn ($record) => industri::orderBy('id')->pluck('id')
                    ->search($record->id) + 1),

                //gambar
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Logo'),
                
                //nama
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                //bidang usaha
                Tables\Columns\TextColumn::make('bidang_usaha')
                    ->label('Bidang Usaha')
                    ->searchable()
                    ->sortable(),

                //email
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                //kontak
                Tables\Columns\TextColumn::make('kontak')
                    ->label('Kontak')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),

                ]),
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndustris::route('/'),
            'create' => Pages\CreateIndustri::route('/create'),
            'view' => Pages\ViewIndustri::route('/{record}'),
            'edit' => Pages\EditIndustri::route('/{record}/edit'),
        ];
    }
}
