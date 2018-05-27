<?php

namespace app\controllers;
use App\core\Controller;
use App\core\Request;
use App\models\Articles;

/**
 * Class ArticlesController
 * @package app\controllers
 */
class ArticlesController extends Controller
{
    /**
     * @var Articles|null
     */
    protected $articleModel = null;

    /**
     * ArticlesController constructor.
     */
    public function __construct()
    {
        $this->articleModel = new Articles();
    }

    /**
     * ArticlesController  action Index.
     */
    public function index()
    {
        echo $this->render('index');
    }

    /**
     * Create Article
     * @param Request $request
     * @return bool
     */
    public function createArticle(Request $request) {
        if (!empty($request->postParams)) {
            echo json_encode($this->articleModel->createArticle($request->postParams));
        }
        return false;
    }

    /**
     * Get all articles by author
     *
     * @param Request $request
     * @return bool
     */
    public function getArticlesByAuther(Request $request) {
        if (!empty($request->postParams)) {
            echo json_encode($this->articleModel->getArticlesByAuther((integer) $request->postParams['user_id']));
        }
        return false;
    }

    /**
     * Get the author of the article
     *
     * @param Request $request
     * @return bool
     */
    public function getAutherByArticle(Request $request) {
        if (!empty($request->postParams)) {
            echo json_encode($this->articleModel->getAutherByArticle((integer) $request->postParams['id']));
        }
        return false;
    }

    /**
     * Change article's author
     *
     * @param Request $request
     * @return bool
     */
    public function changeAutherByArticle(Request $request) {
        if (!empty($request->postParams)) {
            echo json_encode($this->articleModel->changeAutherByArticle((integer) $request->postParams['id'], (integer) $request->postParams['user_id']));
        }
        return false;
    }

}