<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-s-tag';

    protected static bool $hasTitleCaseModelLabel = false;

    public static ?string $label = 'პაკეტები';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('სახელი')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('აღწერა')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->label('ფასი')
                    ->required()
                    ->numeric()
                    ->prefix('₾'),
                Forms\Components\Toggle::make('is_active')
                    ->label('აქტიურია')
                    ->required(),
                Forms\Components\Textarea::make('comment')
                    ->label('კომენტარი')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('valid_from')
                    ->label('ვალიდურობის საწყისი')
                    ->required(),
                Forms\Components\DatePicker::make('valid_to')
                    ->label('ვალიდურობის დასასრული')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('სახელი')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('ფასი')
                    ->money("GEL"),
                Tables\Columns\TextColumn::make('description')
                    ->label('აღწერა')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label('კომენტარი')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('აქტიურია')
                    ->boolean(),
                Tables\Columns\TextColumn::make('valid_from')
                    ->label('ვალიდურობის საწყისი')
                    ->date(),
                Tables\Columns\TextColumn::make('valid_to')
                    ->label('ვალიდურობის დასასრული')
                    ->date(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('შეიქმნა')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('განახლდა')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('წაიშალა')
                    ->dateTime()
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
