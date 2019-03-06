<?php

namespace OpenClassrooms\Blog\Model; 

require_once("model/Manager.php");

class PostManager extends Manager {

    public function getPosts() {

        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function addingPost($postTitle, $postContent) {
        
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(:title, :content, NOW())');
        $affectedPost = $req->execute(array(
            'title' => $postTitle,
            'content' => $postContent));

        return $affectedPost;
    }

    public function modifyPost($postId, $postTitle, $postContent) {
        
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
        $affectedPost = $req->execute(array(
            'title' => $postTitle,
            'content' => $postContent,
            'id' => $postId));
        
        return $affectedPost;
    }

    public function newPost() {

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $newPost = $req->execute(array(
            'title' => $title,
            'content' => $content));

        return $newPost;
    }

    public function erasePost($postId) {

        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = :id');
        $req->execute(array(
            'id' => $postId));

        return $req;
    }

    
}