<?php
namespace App\Domain\Traits\Rebase\ModelTransformers;

trait MemberTransformers  {

    public function isVerified(string $memberID, string $emailToken): bool
    {
        return $this->id === $memberID && $this->email_token === $emailToken;
    }
}
