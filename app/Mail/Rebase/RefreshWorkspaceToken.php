<?php

namespace App\Mail\Rebase;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Domain\Models\Rebase\Workspace\Member;
use App\Domain\Models\Rebase\Workspace\Workspace;

class RefreshWorkspaceToken extends Mailable implements ShouldQueue
{
    use SerializesModels;

    public $queue = 'system-email';

    public $member;
    public $link;

    public function __construct(Member $owner, Workspace $workspace)
    {
        $this->member = $owner->email;
        $this->link = "https://{$workspace->slug}.".
            config('app.domain').
            route('validate.workspace', ['token' => $workspace->activation_token], false);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Sorry your token exipred!')->markdown('email.validation.token_refresh');
    }
}
