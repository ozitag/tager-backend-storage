<?php

namespace OZiTAG\Tager\Backend\Storage;

use OZiTAG\Tager\Backend\Storage\Providers\DbStorage;

class TagerStorage
{
    protected ?DbStorage $dbStorage = null;

    public function db()
    {
        if (!$this->dbStorage) {
            $this->dbStorage = new DbStorage();
        }

        return $this->dbStorage;
    }
}
