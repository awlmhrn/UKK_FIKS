<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2) //form dibagi jadi 2 kolom per baris
                ->schema([
                    //nama
                    Forms\Components\TextInput::make('nama')
                        ->label('Nama')                 // ada di atas form
                        ->placeholder('Nama Siswa')     // ada di dalam form
                        ->required(),

                    //nis
                    Forms\Components\TextInput::make('nis')
                        ->label('NIS') 
                        ->placeholder('NIS Siswa')     
                        ->required(),
                    
                    //gender
                    Forms\Components\Select::make('gender') //menghasilkan dropdown untuk memilih data berdasarkan field gender
                    ->label('Jenis Kelamin')
                    ->options([     //pilihan untuk dropdownnya
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                        ])
                    ->native(false) //menonaktifkan tampilan dropdown bawaan browser
                    ->required(),

                    //rombel
                    Forms\Components\Select::make('rombel')
                    ->label('Rombongan Belajar')
                    ->options([     //pilihan untuk dropdownnya
                        'SIJA A' => 'SIJA A',
                        'SIJA B' => 'SIJA B',
                        ])
                    ->native(false) //menonaktifkan tampilan dropdown bawaan browser
                    ->required(),

                    //email
                    Forms\Components\TextInput::make('email')
                        ->label('Email') 
                        ->placeholder('Email Siswa')
                        ->email() // mengatur input type="email" dan validasi email otomatis
                        ->required(),

                    //kontak
                    Forms\Components\TextInput::make('kontak')
                        ->label('Kontak') 
                        ->placeholder('Kontak Siswa')     
                        ->required(),
                    
                    //alamat
                    Forms\Components\TextInput::make('alamat')
                        ->label('Alamat') 
                        ->placeholder('Alamat Siswa')
                        ->columnSpan(2) //membuat field tersebut melebar ke 2 kolom dalam grid layout     
                        ->required(),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // id menjadi nomor urut berdasarkan id terkecil hingga terbesar
                // ini sekedar di tabel filamentnya, pada database tetap sesuai dengan id yang tersimpan dan terhapus
                
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->getStateUsing(fn ($record) => siswa::orderBy('id')->pluck('id')
                    ->search($record->id) + 1),

                //nama
                Tables\Columns\TextColumn::make('nama')
                    ->label('nama')
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

                //rombel
                Tables\Columns\TextColumn::make('rombel')
                    ->label('Rombel')
                    ->formatStateUsing(fn ($state) => [
                        'SIJA A' => 'SIJA A',
                        'SIJA B' => 'SIJA B',
                    ][$state] ?? $state)
                    ->searchable()
                    ->sortable(),

                //email
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                
                //status pkl
                Tables\Columns\BadgeColumn::make('status_pkl')
                    ->label('Status PKL')
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Tidak Aktif') //untuk mengubah nilai boolean jadi teks 'Aktif' atau 'Tidak Aktif'
                    ->color(fn ($state) => $state ? 'success' : 'danger'), //untuk memberi warna badge : success jika active, danger jika inactive


            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rombel') //membuat dropdown filter
                    ->label('Rombongan Belajar')
                    ->options([  //pilihannya
                        'SIJA A' => 'SIJA A',
                        'SIJA B' => 'SIJA B',
                    ]),
                Tables\Filters\TernaryFilter::make('status_pkl') //menyaring status_pkl berdasarkan status:
                    ->trueLabel('Aktif') //menampilkan hanya yang aktif
                    ->falseLabel('Nonaktif'), //menampilkan hanya yang tidak aktif
            ])
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                ])
                
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'view' => Pages\ViewSiswa::route('/{record}'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
