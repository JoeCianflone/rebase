<?php declare(strict_types=1);

namespace App\Helpers\Rebase;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HostHelper
{
    private string $host;
    private array $hostParts;
    private string $path;

    public function __construct (string $host, string $path) {
        $this->host = $host;
        $this->hostParts = explode('.', $host);
        $this->path = ltrim($path, '/');
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
            return 'https://' . $this->getDomain();
        }

        return 'https://' . $this->getSub() . '.' . config('app.domain');
    }

    public function getSub(): string
    {
        return $this->hostParts[0];
    }

    public function getPath(): array
    {
        return explode('/', $this->path);
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
