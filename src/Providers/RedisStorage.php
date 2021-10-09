<?php

namespace OZiTAG\Tager\Backend\Storage\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redis;
use OZiTAG\Tager\Backend\Storage\Models\TagerStorageModel;
use OZiTAG\Tager\Backend\Storage\Repositories\TagerStorageRepository;

class RedisStorage implements IStorage
{
    private function key(string $key): string
    {
        return 'tager-storage:' . $key;
    }

    public function set(string $key, $value, int $expired = 0)
    {
        $expiredAt = $expired ? date('Y-m-d H:i:s', $expired + time()) : null;

        Redis::set($this->key($key), json_encode([
            'value' => (string)$value,
            'expired_at' => $expiredAt
        ]));
    }

    public function get(string $key, mixed $default = null): ?string
    {
        $value = Redis::get($this->key($key));
        if (!$value) {
            return $default;
        }

        $model = json_decode($value);

        if ($model->expired_at && strtotime($model->expired_at) <= time()) {
            $this->remove($key);
            return $default;
        }

        return $model->value;
    }

    public function remove(string $key)
    {
        Redis::del($this->key($key));
    }

    public function has(string $key): bool
    {
        return Redis::exists($this->key($key));
    }
}
