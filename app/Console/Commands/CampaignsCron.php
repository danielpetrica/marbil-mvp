<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Blade;
class CampaignsCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:campaigns-cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * It will be executed every minute and will check if there are any scheduled campaigns to be sent.
     */
    public function handle()
    {
        $campaigns = Campaign::query()
            ->where('is_scheduled', true)
            // I have this to make sure that a campaign is always sent even
            // if a error occurred in the past and it was not sent at the correct time.
            ->where('scheduled_at', '<=', now())
            ->where('is_sent', false)
            ->with('group')
            ->get();

        foreach ($campaigns as $campaign) {
            // Send the campaign
            $this->stackMails($campaign);
            // Mark the campaign as sent
            // $campaign->update(['is_sent' => true]);
        }
    }

    private function stackMails (mixed $campaign) {
        // get a campaign group
        $group = $campaign->group;

        // get group customers
        $members = $group->customers;

        // get campaign template
        $template = $campaign->template;

        // enqueue job
        foreach ($members as $member) {
//            $job
        }
    }
}
