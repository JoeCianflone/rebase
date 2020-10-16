<?php

namespace App\Mail;

use App\Domain\Models\Member;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCustomer extends Mailable implements ShouldQueue
{
    use SerializesModels;

    public $queue = 'system-email';

    public $member;

    /**
     * Create a new message instance.
     *
     * @param mixed $payload
     */
    public function __construct($payload)
    {
        // $this->member = $member->getMemberFromEmail($payload->email)
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to Rebase')
            ->markdown('email.welcome.new_customer');
    }
}
