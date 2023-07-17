<?php

namespace App\Jobs;

use App\Models\Groups;
use App\Models\Template;
use App\Models\Campaign;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Blade;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly Campaign $campaign,
        private readonly Template $template,
        private readonly Groups   $group,
        private readonly Customer $customer,
    ) {}

    /**
     * Send mail to customer.
     */
    public function handle(): void
    {
        Mail::html(Blade::render($this->template->body, $this->customer->toArray()),function ($message) {
            $message->to($this->customer->email)
                ->subject(Blade::render($this->template->subject, $this->customer->toArray()))
                ->from(config('mail.from.address'), config('mail.from.name'));
        });
    }
}
