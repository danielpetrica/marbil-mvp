<?php

namespace App\Console\Commands;

use App\Classes\EmailAction;
use App\Models\Campaign;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;

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
    private EmailAction $emailAction;

    public function __construct()
    {
        parent::__construct();
        $this->emailAction = new EmailAction();
    }

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


        $this->info('I have ' . count($campaigns) . ' campaigns for this minute.');

        foreach ($campaigns as $campaign) {
            // Send the campaign
            $this->stackMails($campaign);

            $campaign->is_sent = true;
            $campaign->save();
            // Mark the campaign as sent
            // $campaign->update(['is_sent' => true]);
        }
    }

    /**
     * @param mixed $campaign
     * @return void
     */
    private function stackMails (Campaign $campaign): void
    {
        $this->emailAction->stackMails($campaign);
    }
}
