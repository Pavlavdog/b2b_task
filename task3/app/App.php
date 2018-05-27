<?php
namespace App;

use App\core\Database;
use App\core\traits\SingletonTrait;
use App\core\Request;

/**
 * Class App
 * @package App
 */
class App
{
    use SingletonTrait;

    /**
     * @var null
     */
    public $request = null;

    /**
     *
     */
    public function init()
    {
        $this->request = new Request();
        $this->request->init();
    }

    /**
     * @return string
     */
    public static function getAppRootDir()
    {
        return __DIR__ . '/../app/';
    }

}