<?php

namespace App\Classes;

use App\Jobs\SendMails;
use App\Models\Campaign;

class EmailAction
{

    /**
     * @param mixed $campaign
     * @return void
     */
    public static function stackMails(Campaign $campaign): void
    {
        // get a campaign group
        $group = $campaign->group;

        // get group customers
        $members = $group->customer;

        // get campaign template
        $template = $campaign->template;

        // enqueue job
        foreach ($members as $customer) {
            SendMails::dispatch($campaign, $template, $group,  $customer);
        }
    }
}
