<?php

namespace App\core;

use App\App;

/**
 * Class Controller
 * @package App\core
 */
abstract class Controller
{
    /**
     * @var string
     */
    private $templateDir = 'views/';
    /**
     * @var string
     */
    private $templateExt = '.php';

    /**
     * @return mixed
     */
    public abstract function index();

    /**
     * @param $template
     * @param array $params
     * @return string
     */
    public function render($template, $params = [])
    {
        extract($params);
        $templateFile = App::getAppRootDir() . $this->templateDir . $template . $this->templateExt;

        if (file_exists($templateFile)) {
            ob_start();
            include $templateFile;
            $content = ob_get_clean();

            return $content;
        } else {
            var_dump($templateFile);
            echo "Pages do not exist!";
        }
    }

    /**
     * @param $url
     */
    public function redirect($url) {
        header('Location:' . $url);
        exit();
    }
}