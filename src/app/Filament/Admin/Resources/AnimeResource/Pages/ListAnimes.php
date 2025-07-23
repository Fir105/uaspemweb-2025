<?php

namespace App\Filament\Admin\Resources\AnimeResource\Pages;

use App\Filament\Admin\Resources\AnimeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnimes extends ListRecords
{
    protected static string $resource = AnimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
