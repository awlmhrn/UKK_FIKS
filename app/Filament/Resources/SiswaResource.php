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
use Filament\Tables\Columns\ImageColumn;
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
                Forms\Components\Card::make()
                ->schema([

                    Forms\Components\Grid::make(2) // form dibagi jadi 2 kolom per baris
                        ->schema([
                            // foto
                            Forms\Components\FileUpload::make('foto')
                                ->label('Foto Siswa')
                                ->image() // Menjadikan file yang di-upload sebagai foto
                                ->directory('siswa') // Folder penyimpanan di storage/app/public/[siswa]
                                ->columnspan(2), // Wajib

                            // nama
                            Forms\Components\TextInput::make('nama')
                                ->label('Nama')             // ada di atas form
                                ->placeholder('Nama Siswa')  // ada di dalam form
                                ->required(),

                            // nis
                            Forms\Components\TextInput::make('nis')
                                ->label('NIS')           
                                ->placeholder('NIS Siswa') 
                                ->validationMessages([ // ini pesan error yang akan tampil jika user memasukkan nis yang sudah digunakan, agar lebih user friednly
                                    'unique' => 'NIS ini sudah dimiliki pengguna lain',
                                ])
                                ->required(),

                            // gender
                            Forms\Components\Select::make('gender') // menghasilkan dorpdown untuk memilih data berdasarkan field gender
                                ->label('Jenis Kelamin')
                                ->options([  // pilihan untuk dropdownnya
                                    'Laki-Laki' => 'Laki-Laki',
                                    'Perempuan' => 'Perempuan',
                                ])
                                ->native(false) // menonaktifkan tampilan dropdown bawaan browser
                                ->required(),

                            // rombel
                            Forms\Components\Select::make('rombel') 
                                ->label('Rombongan Belajar')
                                ->options([  // pilihan untuk dropdownnya
                                    'SIJA A' => 'SIJA A',
                                    'SIJA B' => 'SIJA B',
                                ])
                                ->native(false) // menonaktifkan tampilan dropdown bawaan browser
                                ->required(),

                            // email
                            Forms\Components\TextInput::make('email')
                                ->label('Email') 
                                ->placeholder('Email Siswa') 
                                ->email() // mengatur input type="email" dan validasi email otomatis
                                ->unique(ignoreRecord: true)
                                ->validationMessages([ // ini pesan error yang akan tampil jika user memasukkan email yang sudah digunakan, agar lebih user friendly
                                    'unique' => 'Email ini sudah dimiliki pengguna lain',
                                ])
                                ->required(),
        
                            // kontak
                            Forms\Components\TextInput::make('kontak')
                                ->label('Kontak') 
                                ->placeholder('Kontak Siswa') 
                                ->required(),

                            // alamat
                            Forms\Components\TextInput::make('alamat')
                                ->label('Alamat') 
                                ->placeholder('Alamat Siswa ') 
                                ->columnSpan(2) // membuat field tersebut melebar ke 2 kolom dalam grid layout
                                ->required(),
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // id
                // id menjadi nomor urut berdasarkan id terkecil hingga terbesar
                // ini sekadar di table filamentnya, pada database tetap sesuai dengan id yang tersimpan dan terhapus
                Tables\Columns\TextColumn::make('id')
                    ->label('ID') 
                    ->getStateUsing(fn ($record) => siswa::orderBy('id')->pluck('id') 
                    ->search($record->id) + 1), 

                // foto
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public') // atau 
                    ->circular(), // opsional, biar foto bulat

                // nama
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                // gender
                Tables\Columns\TextColumn::make('gender')
                    ->label('Gender')
                    ->searchable()
                    ->sortable(),

                // rombel
                Tables\Columns\TextColumn::make('rombel')
                    ->label('Rombel')
                    ->searchable()
                    ->sortable(),
                
                // email
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                
                // kontak
                Tables\Columns\TextColumn::make('kontak')
                    ->label('Kontak')
                    ->searchable()
                    ->sortable(),

                // status pkl
                Tables\Columns\BadgeColumn::make('status_pkl')
                    ->label('Status PKL')
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Tidak Aktif') // untuk mengubah nilai boolean jadi teks 'Aktif' atau 'Tidak Aktif'
                    ->color(fn ($state) => $state ? 'success' : 'danger'), // untuk memberi warna badge: success jika active, danger jika inactive

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gender') // membuat dropdown filter
                    ->label('Gender')
                    ->options([ // pilihannya
                        'Laki-Laki' => 'Laki-Laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                Tables\Filters\SelectFilter::make('rombel') // membuat dropdown filter
                    ->label('Rombongan Belajar')
                    ->options([ // pilihannya
                        'SIJA A' => 'SIJA A',
                        'SIJA B' => 'SIJA B',
                    ]),
                Tables\Filters\TernaryFilter::make('status_pkl') // Menyaring status_pkl berdasarkan status:
                    ->trueLabel('Aktif') // Menampilkan hanya yang aktif
                    ->falseLabel('Nonaktif'), // Menampilkan hanya yang tidak aktif
            ])
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    // collection $records: daftar semua baris (record) yang dipilih oleh user
                    // Filament mengirim data yang DIPILIH dalam bentuk Collection, bukan array biasa
                    ->action(function (\Illuminate\Support\Collection $records) {

                        // kan ini bulkAction ya, aksi massal, ini tu yang checkbox itu, jadi bisa multiple select
                        // makannya kita menggunakan Collection seperti di atas, kita bisa milih banyak
                        // $records: sebuah koleksi data (biasanya array atau Collection), misalnya semua siswa yang dipilih user di tabel
                        // as $record: setiap item tunggal dari koleksi tersebut akan ditampung ke variabel $record
                        foreach ($records as $record) {
                            // memanggil method deleteSiswa() untuk tiap data siswa yang dipilih
                            static::deleteSiswa($record);
                        }
                    }),
            ]);
    }

    // fungsi inilah yang dijalankan ketika tombol hapus diklik
    protected static function deleteSiswa($record) 
    {
        if ($record->pkl()->exists()) {
            \Filament\Notifications\Notification::make()
            // $record->pkl() = mengambil relasi pkl yang terkait dengan siswa tersebut (berdasarkan hasMany di model siswa)
            // ->exists() = Mengecek apakah ada data pkls yang masih menggunakan merk ini.
            // jika ada, pkl yang menggunakan siswa ini, penghapusan dibatalkan, dan muncul notifikasi error.
                ->title('Gagal menghapus!')
                ->body('Siswa ini masih digunakan dalam PKL. Hapus PKL terkait terlebih dahulu.')
                ->danger() // merah
                ->send();
            return;
        }

        // jika siswa tidak digunakan dalam PKL, maka datanya     akan dihapus
        $record->delete();

        \Filament\Notifications\Notification::make()
            ->title('Siswa dihapus!')
            ->body('Siswa berhasil dihapus.')
            ->success() // hijau
            ->send();
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