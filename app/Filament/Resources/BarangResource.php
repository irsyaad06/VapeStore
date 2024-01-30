<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Barang;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\BarangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BarangResource\Pages\EditBarang;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Filament\Resources\BarangResource\Pages\ListBarangs;
use App\Filament\Resources\BarangResource\Pages\CreateBarang;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?string $pluralModelLabel = 'Device';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Barang')
                    ->description('')
                    ->schema([
                        TextInput::make('nama')->required(),
                        TextInput::make('harga')->required(),
                        Select::make('tipe')
                            ->options([
                                'Vape' => 'Vape',
                                'Mod' => 'Mod',
                                'Pod' => 'Pod',
                            ])

                            ->native(false)
                            ->required(),
                        TextInput::make('stok')->default(0)->numeric()->required(),
                        FileUpload::make('gambar')->image()->preserveFilenames()->disk('public')->openable()->previewable()->required()->columnSpan('full'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')->disk('public')->width(100)->height(100)->square()->visibility('private'),
                TextColumn::make('nama'),
                TextColumn::make('harga')->numeric(
                    decimalPlaces: 0,
                    decimalSeparator: '.',
                    thousandsSeparator: ',',
                )
                ->prefix('Rp. '),
                TextColumn::make('tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Vape' => 'warning',
                        'Mod' => 'success',
                        'Pod' => 'danger',
                    }),
                TextColumn::make('stok'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
