<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Imports\ProductImporter;
use Filament\Forms\Components\Select;
use Filament\Actions\ImportAction;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    protected static bool $hasTitleCaseModelLabel = false;

    public static ?string $label = 'მოსწავლეები';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->label('სახელი')
                    ->required(),
                Forms\Components\TextInput::make('last_name')
                    ->label('გვარი')
                    ->required(),
                Forms\Components\TextInput::make('pid')
                    ->label('პირადი ნომერი')
                    ->required(),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->label('დაბადების თარიღი')
                    ->required(),
                Select::make('gender')
                    ->label('სქესი')
                    ->options([
                        'male' => 'ბიჭი',
                        'female' => 'გოგო',

                    ]),
                Forms\Components\Textarea::make('comment')
                    ->label('კომენტარი')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated([5, 10, 25, 50, 100])
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('სახელი')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('გვარი')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pid')
                    ->label('პირადი ნომერი')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('დაბადების თარიღი')
                    ->date(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('სქესი')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
