<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AksesorisResource\Pages;
use App\Filament\Resources\AksesorisResource\RelationManagers;
use App\Models\Aksesoris;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AksesorisResource extends Resource
{
    protected static ?string $model = Aksesoris::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?int $navigationSort = 2;

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
                                'Lanyard' => 'Lanyard',
                                'Panel' => 'Panel',
                                'Garskin' => 'Garskin',
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
                TextColumn::make('nama')->searchable(),
                TextColumn::make('harga')->numeric(
                    decimalPlaces: 0,
                    decimalSeparator: '.',
                    thousandsSeparator: ',',
                )
                ->searchable()
                ->prefix('Rp. '),
                TextColumn::make('tipe')
                    ->badge()
                    ->searchable()
                    ->color(fn (string $state): string => match ($state) {
                        'Lanyard' => 'warning',
                        'Panel' => 'primary',
                        'Garskin' => 'success',
                    }),
                TextColumn::make('stok')->searchable()->suffix(' pcs'),
            ])
            ->filters([

            ])
            ->actions([
                ViewAction::make(),
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
            'index' => Pages\ListAksesoris::route('/'),
            'create' => Pages\CreateAksesoris::route('/create'),
            'edit' => Pages\EditAksesoris::route('/{record}/edit'),
        ];
    }
}
