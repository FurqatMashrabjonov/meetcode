<?php

namespace App\Filament\Resources\CodeTemplateResource\Pages;

use App\Filament\Resources\CodeTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCodeTemplates extends ListRecords
{
    protected static string $resource = CodeTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
