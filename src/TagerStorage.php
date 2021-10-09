<?php

namespace OZiTAG\Tager\Backend\Storage;

use OZiTAG\Tager\Backend\Storage\Providers\DbStorage;
use OZiTAG\Tager\Backend\Storage\Providers\RedisStorage;

class TagerStorage
{
    protected ?DbStorage $dbStorage = null;

    protected ?RedisStorage $redisStorage = null;

    public function db(): DbStorage
    {
        if (!$this->dbStorage) {
            $this->dbStorage = new DbStorage();
        }

        return $this->dbStorage;
    }

    public function redis(): RedisStorage
    {
        if (!$this->redisStorage) {
            $this->redisStorage = new RedisStorage();
        }

        return $this->redisStorage;
    }
}
