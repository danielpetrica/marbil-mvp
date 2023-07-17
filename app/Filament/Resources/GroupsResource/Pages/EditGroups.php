<?php

namespace App\Filament\Resources\GroupsResource\Pages;

use App\Filament\Resources\GroupsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGroups extends EditRecord
{
    protected static string $resource = GroupsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
