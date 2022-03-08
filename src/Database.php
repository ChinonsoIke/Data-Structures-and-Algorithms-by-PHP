<?php

namespace Src;

class Database
{
    private $dsn= 'mysql:host=localhost;dbname=php_dsa';
    private $username= 'root';
    private $password= '123456';

    public \PDO $pdo;

    public function __construct()
    {
        $this->pdo= new \PDO($this->dsn, $this->username, $this->password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function createCategoriesTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `categories` (
            `id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            `categoryName` varchar(100) NOT NULL,
            `parentCategory` int(11) DEFAULT 0,
            `sortInd` int(11) NOT NULL
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    }

    public function insertCategories(array $values)
    {
        $str= implode(',', $values);
        $statement= $this->pdo->prepare("INSERT INTO categories 
            (categoryName,
            parentCategory,
            sortInd) 
            VALUES
            $str"
        );
        $statement->execute();
        return 'values inserted';
    }

    public function createCommentsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `comments` (
            `id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            `comments` varchar(100) NOT NULL,
            `username` varchar(100) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            `parentId` int(11) DEFAULT 0,
            `postId` int(11) NOT NULL
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    }

    public function insertComments(array $values)
    {
        $str= implode(',', $values);
        $statement= $this->pdo->prepare("INSERT INTO comments 
            (comments,
            username,
            parentId,
            postId) 
            VALUES
            $str"
        );
        $statement->execute();
        return 'values inserted';
    }
}