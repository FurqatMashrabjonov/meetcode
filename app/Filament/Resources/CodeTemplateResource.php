<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CodeTemplateResource\Pages;
use App\Filament\Resources\CodeTemplateResource\RelationManagers;
use App\Models\CodeTemplate;
use App\Models\ProgrammingLanguage;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CodeTemplateResource extends Resource
{
    protected static ?string $model = CodeTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Code Template')
                            ->schema([
                                Textarea::make('code')->required()->default('')
                                    ->rows(20)
                                    ->autosize()
                            ]),
                        Tabs\Tab::make('Settings')
                            ->schema([
                                TextInput::make('name')->required()->autofocus(),
                                Select::make('programming_language_id')->required()
                                    ->options(ProgrammingLanguage::query()->pluck('name', 'id')->toArray())
                            ]),
                    ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups(['programmingLanguage.name'])
            ->columns([
                TextColumn::make('id')->label('ID')->searchable()->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('programmingLanguage.name')->label('Programming Language')->searchable()->sortable()
                    ->badge()->color('primary'),
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
            'index' => Pages\ListCodeTemplates::route('/'),
            'create' => Pages\CreateCodeTemplate::route('/create'),
            'edit' => Pages\EditCodeTemplate::route('/{record}/edit'),
        ];
    }
}
