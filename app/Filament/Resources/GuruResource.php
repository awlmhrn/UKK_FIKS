<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Filament\Resources\GuruResource\RelationManagers;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2) //form dibagi menjadi 2 kolom per baris
                    ->schema([
                        //nama
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama')              //ada di atas form
                            ->placeholder('Nama Guru')  //ada di dalam form
                            ->required(),
                        
                        //nip
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->placeholder('NIP Guru')
                            ->required(),
                        
                        //gender
                        Forms\Components\Select::make('gender') //menghasilkan dropdown untuk memilih data berdasarkan field gender
                            ->label('Jenis Kelamin')
                            ->options([     //pilihan untuk dropdown
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                        
                            ])
                            ->native(false) //menonaktifkan tampilan dropdown bawaan browser
                            ->required(),

                        //email
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->placeholder('Email Guru')
                            ->email() //mengatur input type="email" dan validasi email otomatis
                            ->required(),

                        //kontak
                        Forms\Components\TextInput::make('kontak')
                            ->label('Kontak')
                            ->placeholder('Kontak Guru')
                            ->required(),
                        
                        //alamat
                        Forms\Components\TextInput::make('alamat')
                            ->label('Alamat')
                            ->placeholder('Alamat Guru')
                            ->required(),

                    ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //id menjadi nomor urut berdasarkan id terkecil hingga terbesar
                //ini sekedar di table filamentnya, pada database tetap sesuai dengan id yang tersimpan dan terhapus
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->getStateUsing(fn ($record) => guru::orderBy('id')->pluck('id')
                    ->search($record->id) + 1),

                //nama
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                //gender
                Tables\Columns\TextColumn::make('gender')
                    ->label('Gender')
                    ->formatStateUsing(fn ($state) => [
                    // secara default, tabelnya akan menampilkan L/P, bukan Cash on Laki-laki/Perempuan
                    // ini sekedar merapikan, jadi jika tabelnya memiliki data L (misalnya), maka di tabel ini akan menampilkan Laki-laki
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ][$state] ?? $state)
                    // [$state] mencoba mengambil nilai dari array mapping (Cash on Delivery/Stripe)
                    // ?? $state) digunakan sebagai fallback (jika $state tidak ada dalam array, gunakan nilai aslinya (cod/stripe))
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'view' => Pages\ViewGuru::route('/{record}'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
