<?php
namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DBHelper
{
    /** @var string */
    private $name;


    public function __construct(?string $id = null)
    {
        $this->name = config('database.name_prefix') . str_replace("-", "_", $id);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return '';
    }

    /**
     * @return boolean
     */
    public function exists() : bool
    {
        $result = DB::select("SHOW DATABASES LIKE '{$this->name}'");
        return ! empty($result);
    }

    /**
     * @return boolean
     */
    public function create(): bool
    {
        return DB::statement("CREATE DATABASE {$this->name};");
    }

    /**
     * @return boolean
     */
    public function drop(): bool
    {
        return DB::statement("DROP DATABASE {$this->name};");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllKeys(): Collection
    {
        $workspaces = collect(DB::select("SHOW DATABASES LIKE '{$this->prefix}%'"));

        return $workspaces->flatMap(function($item) {
            return collect($item)->flatten();
        })->map(function($item) {
            return str_replace($this->prefix, '', $item);
        });
    }

    /**
     * @return void
     */
    public function connect(): void
    {
        $this->purgeConnection();
        $this->setDbConfig();
    }

    /**
     * @return void
     */
    public function purgeConnection(): void
    {
        DB::disconnect('workspace');
        DB::purge('workspace');
    }

    /**
     * @return void
     */
    protected function setDbConfig(): void
    {
        config()->set('database.connections.workspace.database', $this->name);
        // config()->set('database.connections.workspace.host', $this->name());
        // config()->set('database.connections.workspace.username', $this->name());
        // config()->set('database.connections.workspace.password', $this->name());
    }
}
