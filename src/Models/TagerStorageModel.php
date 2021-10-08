<?php

namespace OZiTAG\Tager\Backend\Storage\Models;

use OZiTAG\Tager\Backend\Core\Models\TModel;

/**
 * Class TagerStorageModel
 * @package OZiTAG\Tager\Backend\Storage\Models
 *
 * @property string $key
 * @property string $value
 * @property string $expired_at
 */
class TagerStorageModel extends TModel
{
    protected $table = 'tager_storage';

    protected $fillable = [
        'key', 'value', 'expired_at',
    ];
}
