<?php

namespace App\Filament\Resources\CampaignsResource\Pages;

use App\Classes\EmailAction;
use App\Filament\Resources\CampaignsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditCampaigns extends EditRecord
{
    protected static string $resource = CampaignsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('SendCampaignNow')
                ->label('Send campaign now')
                ->color('secondary')
                ->requiresConfirmation()
                ->action('sendCampaignNow')
        ];
    }

    public function sendCampaignNow (): void {

//        Log::debug("EditCampaigns->sendCampaignNow", ["record" => $this->record]);
        EmailAction::stackMails($this->record);
    }
}
