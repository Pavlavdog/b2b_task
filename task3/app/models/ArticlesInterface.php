<?php

namespace app\models;


/**
 * Interface ArticlesInterface
 * @package app\models
 */
interface ArticlesInterface
{
    /**
     *  Create Article
     *  Example: $data = [
     *      'user_id' => 3,
     *       'title' = 'test',
     *      'description' ='Lorem...'
     * ];
     * @param array $data
     * @return mixed
     */
    public function createArticle(array $data = []);

    /**
     * Get all articles by author
     *
     * @param int|null $user_id
     * @return mixed
     */
    public function getArticlesByAuther(int $user_id = null);

    /**
     * Get the author of the article
     *
     * @param int|null $id
     * @return mixed
     */
    public function  getAutherByArticle(int $id = null);

    /**
     * Change article's author
     *
     * @param int|null $id
     * @param int|null $user_id
     * @return mixed
     */
    public function  changeAutherByArticle(int $id = null, int $user_id = null);
}