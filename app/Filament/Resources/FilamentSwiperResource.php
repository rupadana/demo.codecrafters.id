<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FilamentSwiperResource\Pages;
use App\Filament\Resources\FilamentSwiperResource\RelationManagers;
use App\Models\FilamentSwiper;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Rupadana\FilamentSwiper\Infolists\Components\SwiperImageEntry;

class FilamentSwiperResource extends Resource
{
    protected static ?string $model = FilamentSwiper::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Plugins';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                FileUpload::make('images')
                    ->multiple()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ViewAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFilamentSwipers::route('/'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->state([
            'custom_images' => [
                'https://res.cloudinary.com/rupadana/image/upload/v1705144717/Screenshot_2024-01-13_at_19.18.11_llse31.png',
                'https://res.cloudinary.com/rupadana/image/upload/v1705144717/Screenshot_2024-01-13_at_19.18.11_llse31.png'
                
            ]
        ])
            ->schema([
                TextEntry::make('name'),
                SwiperImageEntry::make('custom_images')
                    ->columnSpanFull()
                    ->height('500px')
                    ->pagination()
                    ->paginationClickable()
            ]);
    }
}
