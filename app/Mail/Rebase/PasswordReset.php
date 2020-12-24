<?php

namespace App\Mail\Rebase;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable implements ShouldQueue
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
     * @param mixed $token
     * @param mixed $customerID
     * @param mixed $sub
     */
    public function __construct(string $token, string $customerID)
    {
        $this->link = route('password.reset', [
            'token' => $token,
            'customer_id' => $customerID,
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password Notification')->markdown('email.validation.password_reset');
    }
}
