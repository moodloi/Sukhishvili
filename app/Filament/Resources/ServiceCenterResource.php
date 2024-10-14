<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceCenterResource\Pages;
use App\Filament\Resources\ServiceCenterResource\RelationManagers;
use App\Models\ServiceCenter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;

class ServiceCenterResource extends Resource
{
    protected static ?string $model = ServiceCenter::class;

    protected static ?string $navigationIcon = 'heroicon-s-home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('business')
                    ->required()
                    ->options([
                        'ცეკვის აკადემია სუხიშვილები - 1' => 'ცეკვის აკადემია სუხიშვილები - 1',
                        'სუხიშვილების აკადემია' => 'სუხიშვილების აკადემია',
                    ]),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->tel(),
                Forms\Components\Textarea::make('comment')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('business')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListServiceCenters::route('/'),
            'create' => Pages\CreateServiceCenter::route('/create'),
            'edit' => Pages\EditServiceCenter::route('/{record}/edit'),
        ];
    }
}
