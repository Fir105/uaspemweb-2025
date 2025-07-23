<?php

namespace App\Filament\Admin\Resources\AnimeResource\Pages;

use App\Filament\Admin\Resources\AnimeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnime extends EditRecord
{
    protected static string $resource = AnimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
