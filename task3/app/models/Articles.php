<?php

namespace App\models;

use App\core\Model;

/**
 * Class Articles
 * @package App\models
 */
class Articles extends Model implements ArticlesInterface
{
    /**
     *  Table name in database
     * @var string
     */
    protected $table = 'articles';

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
    public function createArticle(array $data = [])
    {
        if (empty($data)) {
            return false;
        }

        $query = 'insert into ' . $this->table . ' (';
        $query .= implode(', ', array_keys($data)) . ') values (:';
        $query .= implode(', :', array_keys($data)) . ');';

        $statement = $this->pdo->prepare($query);

        return $statement->execute($data);
    }

    /**
     * Get all articles by author
     *
     * @param int|null $user_id
     * @return mixed
     */
    public function getArticlesByAuther(int $user_id = null)
    {
        if(empty($user_id)) {
            return false;
        }

        $query = 'select * from ' . $this->table . ' where user_id = :id';

        $statement = $this->pdo->prepare($query);

        $statement->execute([ 'id' => $user_id ]);

        return $statement->fetchAll();

    }

    /**
     * Get the author of the article
     *
     * @param int|null $id
     * @return mixed
     */
    public function getAutherByArticle(int $id = null)
    {
        $table = 'users';

        if(empty($id)) {
            return false;
        }

        $query = 'select t2.name from ' . $this->table . ' AS t1 LEFT JOIN '. $table .' AS t2 
            ON (t1.user_id=t2.id) where t1.id = :id';

        $statement = $this->pdo->prepare($query);

        $statement->execute([ 'id' => $id ]);

        return $statement->fetch();
    }

    /**
     * Change article's author
     *
     * @param int|null $id
     * @param int|null $user_id
     * @return mixed
     */
    public function changeAutherByArticle(int $id = null, int $user_id = null)
    {
        if(empty($id) || empty($user_id)) {
            return false;
        }

        $query = 'update ' . $this->table . ' set ';

        $query .= 'user_id = :user_id';

        $query .= ' where id = :id';

        $statement = $this->pdo->prepare($query);
        return $statement->execute(['id' => $id, 'user_id' => $user_id]);
    }
}