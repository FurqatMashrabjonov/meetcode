<?php

namespace App\Filament\Resources;

use App\Enums\ProblemCategoryStatus;
use App\Filament\Resources\ProblemCategoryResource\Pages;
use App\Filament\Resources\ProblemCategoryResource\RelationManagers;
use App\Models\ProblemCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProblemCategoryResource extends Resource
{
    protected static ?string $model = ProblemCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->autofocus()
                    ->required()
                    ->unique(ProblemCategory::class, 'name')
                    ->placeholder(__('Name')),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ProblemCategory::class, 'slug')
                    ->placeholder(__('Slug')),

                Forms\Components\Textarea::make('description')
                    ->placeholder(__('Description')),

                Forms\Components\Select::make('status')
                    ->options([
                        ProblemCategoryStatus::ACTIVE => __('Active'),
                        ProblemCategoryStatus::INACTIVE => __('Inactive'),
                    ])
                    ->required()
                    ->placeholder(__('Status')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()->color(function (ProblemCategory $record) {
                    return match ($record->status) {
                        ProblemCategoryStatus::ACTIVE => 'success',
                        ProblemCategoryStatus::INACTIVE => 'danger',
                    };
                })->sortable(),
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
            'index' => Pages\ListProblemCategories::route('/'),
            'create' => Pages\CreateProblemCategory::route('/create'),
            'edit' => Pages\EditProblemCategory::route('/{record}/edit'),
        ];
    }
}
