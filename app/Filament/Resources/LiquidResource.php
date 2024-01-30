<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiquidResource\Pages;
use App\Filament\Resources\LiquidResource\RelationManagers;
use App\Models\Liquid;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LiquidResource extends Resource
{
    protected static ?string $model = Liquid::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye-dropper';

    protected static ?string $pluralModelLabel = 'Liquid';

    public static function form(Form $form): Form
    {
        
        return $form
            ->schema([
                Section::make('Barang')
                    ->description('')
                    ->schema([
                        TextInput::make('nama')->required()->label('Nama Merk'),
                        TextInput::make('harga')->required(),
                        Select::make('tipe')
                            ->options([
                                'Freebase' => 'Freebase',
                                'SaltNic' => 'SaltNic',
                            ])
                            ->native(false)
                            ->required(),
                        TextInput::make('ukuran')
                            ->label('Jumlah Satuan(mg)')
                            ->suffix('mg')
                            ->numeric()
                            ->default(0)
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
                ->color(fn (string $state): string => match ($state) {
                    'Freebase' => 'warning',
                    'SaltNic' => 'success',
                })
                ->searchable(),
            TextColumn::make('ukuran')->suffix(' mg')->sortable(),
            TextColumn::make('stok')->suffix(' pcs')->sortable(),
        ])
            ->filters([
                SelectFilter::make('tipe')
                ->options([
                    'Vape' => 'Vape',
                    'Mod' => 'Mod',
                    'Pod' => 'Pod',
                ])
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
            'index' => Pages\ListLiquids::route('/'),
            'create' => Pages\CreateLiquid::route('/create'),
            'edit' => Pages\EditLiquid::route('/{record}/edit'),
        ];
    }
}
