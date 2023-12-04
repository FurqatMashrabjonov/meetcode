<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgrammingLanguageResource\Pages;
use App\Filament\Resources\ProgrammingLanguageResource\RelationManagers;
use App\Models\ProgrammingLanguage;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgrammingLanguageResource extends Resource
{
    protected static ?string $model = ProgrammingLanguage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->placeholder(__('Name')),
                TextInput::make('extension')
                ->required()
                ->placeholder(__('Extension')),
                TextInput::make('version')
                ->required()
                ->placeholder(__('Version')),
                TextInput::make('run_command')
                ->required()
                ->placeholder(__('Run Command')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('extension')
                    ->badge()->color('primary')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('version')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('run_command')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListProgrammingLanguages::route('/'),
            'create' => Pages\CreateProgrammingLanguage::route('/create'),
            'edit' => Pages\EditProgrammingLanguage::route('/{record}/edit'),
        ];
    }
}
