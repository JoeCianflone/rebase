<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeAccount extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public array $workspace;
    public array $user;

    public function __construct(array $workspace, array $user)
    {
        $this->subject = 'Welcome to Rebase';

        $this->workspace = $workspace;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('email.welcome_text');
    }

    public function tags(): array
    {
        return ['welcome', 'new account', 'workspace_id:'.$this->workspace['id'], 'account_id:'.$this->workspace['account_id']];
    }
}
