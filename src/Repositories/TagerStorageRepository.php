<?php

namespace OZiTAG\Tager\Backend\Storage\Repositories;

use Illuminate\Database\Eloquent\Builder;
use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Storage\Models\TagerStorageModel;

class TagerStorageRepository extends EloquentRepository
{
    public function __construct(TagerStorageModel $model)
    {
        parent::__construct($model);
    }

    public function queryByKey(string $key): Builder
    {
        return $this->builder()->where('key', $key);
    }
}
