<?php

namespace App\Filament\Resources\CustomersGroupsResource\Pages;

use App\Filament\Resources\CustomersGroupsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomersGroups extends EditRecord
{
    protected static string $resource = CustomersGroupsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
