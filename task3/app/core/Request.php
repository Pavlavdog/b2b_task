<?php

namespace App\core;


use Exception;

/**
 * Class Request
 * @package App\core
 */
class Request
{
    /**
     * @var string
     */
    protected $controller = 'index';

    /**
     * @var string
     */
    protected  $action = 'index';

    /**
     * @var string
     */
    protected $controllerNamespace = 'App\controllers';
    /**
     * @var array
     */
    public $getParams = [];
    /**
     * @var array
     */
    public $postParams = [];
    /**
     * @var array
     */
    public $files = [];

    /**
     *
     */
    public function init() {
        $routes = $_SERVER['REQUEST_URI'];

        $this->getParams = $_GET;
        $this->postParams = $_POST;
        $this->files = $_FILES;

        if( $cleanUrl = stristr($routes, '?', true) ) {
            $routes = explode('/',$cleanUrl);
        } else {
            $routes = explode('/',$routes);
        }

        if (!empty($routes[1])) {
            $this->controller = $routes[1];
        }

        if (!empty($routes[2])) {
            $this->action = strtolower($routes[2]);
        }

        $classController = $this->controllerNamespace . '\\' . ucfirst(strtolower($this->controller)) . 'Controller';

        try {
            if (class_exists($classController)) {
                $instanceController = new $classController;
                if (method_exists($instanceController, $this->action)) {
                    call_user_func_array([$instanceController, $this->action], [$this]) ;
                } else {
                    throw new Exception('The method does not exist!');
                }

            } else {
                throw new Exception('File not found: '. $classController);

            }

        } catch (Exception $e) {
           require_once '../app/views/errors/404.php';
        }

   }
}