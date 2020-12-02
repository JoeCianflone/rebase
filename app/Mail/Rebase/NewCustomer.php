<?php

namespace App\Mail\Rebase;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCustomer extends Mailable implements ShouldQueue
{
    use SerializesModels;

    public $queue = 'system-email';

    public $payload;
    public $link;

    /**
     * Create a new message instance.
     *
     * @param mixed $payload
     */
    public function __construct($payload)
    {
        $this->payload = collect($payload);

        $this->link = route('member.validate', [
            'customerID' => $payload['customer']->id,
            'memberID' => $payload['member']->id,
            'token' => $payload['member']->email_token,
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to Rebase')->markdown('email.welcome.new_customer');
    }
}
