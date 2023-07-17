<?php

namespace App\Filament\Resources\CampaignsResource\Pages;

use App\Filament\Resources\CampaignsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCampaigns extends EditRecord
{
    protected static string $resource = CampaignsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
