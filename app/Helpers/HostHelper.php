<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;

class HostHelper
{
    private string $host;
    private array $hostParts;

    public function __construct(string $host)
    {
        $this->host = $host;
        $this->hostParts = explode('.', $host);
    }

    public function isOnOurDomain(): bool
    {
        return $this->isCustomDomain() && Str::endsWith($this->host, config('app.domain'));
    }

    public function isCustomDomain(): bool
    {
        return count($this->hostParts) <= 2 || Str::startsWith('www', $this->host);
    }

    public function getURL(): string
    {
        if ($this->isCustomDomain()) {
            return 'https://'.$this->getDomain();
        }

        return 'https://'.$this->getSlug().'.'.config('app.domain');
    }

    public function getSlug(): string
    {
        return $this->hostParts[0];
    }

    public function getDomain(): string
    {
        if (count($this->hostParts) <= 2) {
            return $this->host;
        }

        // shift off www if they have it because we don't need it
        $hostArr = $this->hostParts;
        if ('www' === Str::lower($this->hostParts[0])) {
            array_shift($hostArr);
        }

        return implode('.', $hostArr);
    }
}
