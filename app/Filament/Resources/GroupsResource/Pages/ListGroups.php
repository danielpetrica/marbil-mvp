<?php

namespace App\Filament\Resources\GroupsResource\Pages;

use App\Filament\Resources\GroupsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroups extends ListRecords
{
    protected static string $resource = GroupsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
