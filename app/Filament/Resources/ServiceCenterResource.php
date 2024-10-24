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

    protected static bool $hasTitleCaseModelLabel = false;

    public static ?string $label = 'ფილიალები';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('business')
                    ->label('ბიზნესი')
                    ->required()
                    ->options([
                        'ცეკვის აკადემია სუხიშვილები - 1' => 'ცეკვის აკადემია სუხიშვილები - 1',
                        'სუხიშვილების აკადემია' => 'სუხიშვილების აკადემია',
                    ]),
                Forms\Components\TextInput::make('name')
                    ->label('დასახელება')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('მისამართი')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('ტელეფონი')
                    ->tel(),
                Forms\Components\Textarea::make('comment')
                    ->label('კომენტარი')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('business')
                    ->label('ბიზნესი')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('დასახელება')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('მისამართი')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('ტელეფონი')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('წაიშალა')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('შეიქმნა')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('განახლდა')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
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
