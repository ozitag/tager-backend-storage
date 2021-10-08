<?php

namespace OZiTAG\Tager\Backend\Storage\Providers;

use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Storage\Models\TagerStorageModel;
use OZiTAG\Tager\Backend\Storage\Repositories\TagerStorageRepository;

class DbStorage
{
    protected TagerStorageRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(TagerStorageRepository::class);
    }

    public function set(string $key, $value, int $expired = 0)
    {
        $expiredAt = $expired ? date('Y-m-d H:i:s', $expired + time()) : null;

        $existed = $this->repository->queryByKey($key)->first();
        if ($existed) {
            $this->repository->set($existed);
        }

        $this->repository->fillAndSave([
            'key' => $key,
            'value' => (string)$value,
            'expired_at' => $expiredAt
        ]);
    }

    public function get(string $key, mixed $default = null): ?string
    {
        /** @var TagerStorageModel $model */
        $model = $this->repository->queryByKey($key)->first();

        if (!$model) {
            return $default;
        }

        if ($model->expired_at && $model->expired_at <= time()) {
            $this->remove($model->key);
            return $default;
        }

        return $model->value;
    }

    public function remove(string $key)
    {
        $this->repository->queryByKey($key)->delete();
    }

    public function has(string $key): bool
    {
        return $this->repository->queryByKey($key)->exists();
    }
}
