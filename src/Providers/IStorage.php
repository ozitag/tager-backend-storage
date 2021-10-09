<?php

namespace OZiTAG\Tager\Backend\Storage\Providers;

interface IStorage
{
    public function set(string $key, $value, int $expired = 0);

    public function get(string $key, mixed $default = null): ?string;

    public function remove(string $key);

    public function has(string $key): bool;
}
