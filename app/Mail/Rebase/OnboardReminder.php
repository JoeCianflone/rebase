<?php

namespace App\Mail\Rebase;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OnboardReminder extends Mailable implements ShouldQueue
{
    use SerializesModels;

    public $queue = 'system-email';

    public $workspace;
    public $link;
    public $email;

    /**
     * Create a new message instance.
     *
     * @param mixed $payload
     * @param mixed $workspace
     * @param mixed $email
     */
    public function __construct($email, $workspace)
    {
        $this->email = $email;
        $this->link = route('login', false);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Quick Reminder: Finish Onboarding')->markdown('email.welcome.onboard_reminder');
    }
}
