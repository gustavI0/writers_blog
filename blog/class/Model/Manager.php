<?php
namespace Blog\Model;

use \PDO;

abstract class Manager {

    const USERNAME = 'root';
    const PASSWORD = 'root';
    const HOST = 'localhost';
    const DB = 'blog';
    const TABLE_NAME = 'undefined';
	
    protected function dbConnect() {

        $db_user = self::USERNAME;
        $db_pwd = self::PASSWORD;
        $db_host = self::HOST;
        $db_name = self::DB;

        $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }

    protected function findAll()
    {
        return 'SELECT * FROM ' . static::TABLE_NAME . ' ORDER BY creation_date DESC';
    }

    protected function find($column, $id)
    {
        return 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE ' . $column . ' = ' . $id . ' ORDER BY creation_date DESC';
    }

    protected function createComment()
    {
        return 'INSERT INTO ' . static::TABLE_NAME . '(post_id, author, content, creation_date) 
            VALUES(:postId, :author, :content, NOW())';
    }

    protected function createPost()
    {
        return 'INSERT INTO ' . static::TABLE_NAME . '(title, content, creation_date) 
            VALUES(:title, :content, NOW())';
    }

    protected function delete($id)
    {
        return 'DELETE FROM ' . static::TABLE_NAME . ' WHERE id = ' . $id . '';
    }

    protected function update()
    {
        return 'UPDATE posts SET title = :title, content = :content WHERE id = :id';
    }

    protected function adminComments() 
    {
        return 'SELECT c.id, c.post_id, c.author, c.content, c.moderation, c.creation_date, p.title title
            FROM ' . static::TABLE_NAME . ' c 
            LEFT JOIN posts p
            ON c.post_id = p.id
            ORDER BY c.moderation DESC, c.creation_date DESC';
    }

    protected function getCreds()
    {
        return 'SELECT * FROM users WHERE pseudo = :pseudo';
    }


}