<?php

namespace App\controllers;

use App\core\Controller;

/**
 * Class IndexController
 * @package App\controllers
 */
class IndexController extends Controller
{
    public function index()
    {
        echo $this->render('index');
    }
}