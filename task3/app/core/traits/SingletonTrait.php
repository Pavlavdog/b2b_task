<?php

namespace App\core\traits;

/**
 * Trait SingletonTrait
 * @package App\core\traits
 */
trait SingletonTrait
{
    /**
     * @var null
     */
    private static $instance = null;

    private function __clone(){}

    private function __wakeup(){}

    protected function init(){}

    /**
     * SingletonTrait constructor.
     */
    final private function __construct(){}

    /**
     * @return SingletonTrait|null
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
            self::$instance->init();
        }

        return self::$instance;
    }
}