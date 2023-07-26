<?php

namespace App\Classes;

use App\Jobs\SendMails;
use App\Models\Campaign;
use Illuminate\Support\Facades\Log;

class EmailAction
{

    /**
     * @param mixed $campaign
     * @return void
     */
    public static function stackMails(Campaign $campaign): void
    {
        $campaign->refresh()->load(['group', 'template']);
        // get a campaign group
        $group = $campaign->group;

        $group->load(['customers']);
        // get group customers
        $members = $group->customers;

        // get campaign template
        $template = $campaign->template;

//        Log::debug('EmailAction::stackMails', ['campaign' => $campaign, 'members' => $members]);
        // enqueue job
        foreach ($members as $customer) {
//            Log::debug('EmailAction::stackMails - foreach', ['customer' => $customer]);
            SendMails::dispatch($campaign, $template, $group,  $customer);
        }
    }
}
