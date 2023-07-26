<?php

namespace App\Jobs;

use App\Classes\EmailSendingException;
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

class SendMails implements ShouldQueue, ShouldBeUnique
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
     * @throws EmailSendingException
     */
    public function handle(): void
    {

        $this->sendEmail(
            Blade::render($this->template->subject, $this->customer->toArray()),
            Blade::render($this->template->body, $this->customer->toArray()),
            $this->customer->email
        );
    }

    /**
     * @throws EmailSendingException
     */
    function sendEmail(string $subject, string $body, string $email): float {
        try {
            Mail::html($body, function ($message) use ($subject, $email) {
                $message->to($email)
                    ->subject($subject)
                    ->from(config('mail.from.address'), config('mail.from.name'));
            });
        } catch (\Exception $e) {
            throw new EmailSendingException( $e->getMessage(), $e->getCode());
        }

        return 0;
    }

    /**
     * The unique ID of the job.
     */
    public function uniqueId(): string
    {
        return $this->campaign->id  . '-' . $this->customer->id;
    }
}
