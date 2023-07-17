<?php

namespace App\Filament\Resources\CustomersGroupsResource\Pages;

use App\Filament\Resources\CustomersGroupsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomersGroups extends ListRecords
{
    protected static string $resource = CustomersGroupsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
