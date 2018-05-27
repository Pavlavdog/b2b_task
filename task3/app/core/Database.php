<?php

namespace App\core;

use App\core\traits\SingletonTrait;

/**
 * Class Database
 * @package App\core
 */
class Database
{
    use SingletonTrait;

    /**
     * @var null
     */
    private $pdo = null;

    /**
     * @var string
     */
    private $dbHost = DB_HOST;
    /**
     * @var string
     */
    private $dbName = DB_NAME;
    /**
     * @var string
     */
    private $dbUser = DB_USER;
    /**
     * @var string
     */
    private $dbPass = DB_PASS;
    /**
     * @var string
     */
    private $dbCharset = DB_CHARTSET;
    /**
     * @var array
     */
    private $dbOptions = DB_OPTIONS;

    /**
     *
     */
    public function init() {
        $this->getPDO();
    }

    /**
     * @return null|\PDO
     */
    public function getPDO() {
        if (empty($this->pdo)) {
            $this->pdo = new \PDO("mysql:host={$this->dbHost};dbname={$this->dbName};charset={$this->dbCharset}",
                $this->dbUser,
                $this->dbPass,
                $this->dbOptions
                );
        }
        return $this->pdo;
    }



}