<?php

namespace App\core;

use App\core\Database;

/**
 * Class Model
 * @package App\core
 */
abstract class Model
{
    /**
     * @var null
     */
    protected $pdo = null;
    /**
     * Table name in database
     * @var string
     */
    protected $table = '';

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->pdo  = Database::getInstance()->getPDO();
    }

}