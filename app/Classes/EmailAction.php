<?php

namespace App\Classes;

class EmailAction
{

    /**
     * @param mixed $campaign
     * @return void
     */
    public function stackMails(mixed $campaign): void
    {
        // get a campaign group
        $group = $campaign->group;

        // get group customers
        $members = $group->customers;

        // get campaign template
        $template = $campaign->template;

        // enqueue job
        foreach ($members as $member) {

        }
    }
}
