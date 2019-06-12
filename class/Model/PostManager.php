<?php
namespace Blog\Model; 

use \PDO;

class PostManager extends Manager {

    const TABLE_NAME = 'posts';

    /**
     * Récupère les billets depuis la base de données
     * @return Array Tableau de billets
     */
    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $sql = $this->findAll();
        $req = $db->prepare($sql);
        $req->execute();
        while($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $post = new Post();
            $post->setId($row['id']);
            $post->setTitle($row['title']);
            $post->setContent($row['content']);
            $post->setCreationDate($row['creation_date']);

            $posts[] = $post;
        }

        return $posts;
    }

    /**
     * Récupère un billet par ID
     * @param  Int $postId ID du billet
     * @return Array         Billet
     */
    public function getSinglePost($postId)
    {

        $db = $this->dbConnect();
        $sql = $this->find('id', $postId);
        $req = $db->prepare($sql);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);

        $post = new Post();
        $post->setId($row['id']);
        $post->setTitle($row['title']);
        $post->setContent($row['content']);
        $post->setCreationDate($row['creation_date']);

        return $post;
    }

    /**
     * Ajoute un billet à la base deonnées
     * @param  String $postTitle   Titre du billet
     * @param  String $postContent Contenu du billet
     * @return Array              Billet
     */
    public function insertPost($values) 
    {   
        $columns = 'title, content, creation_date';
        $binded = ':title, :content, NOW()';
        $db = $this->dbConnect();
        $sql = $this->create($columns, $binded);
        $req = $db->prepare($sql);

        $req->bindValue(':title', $values['title'], PDO::PARAM_STR);
        $req->bindValue(':content', $values['content'], PDO::PARAM_STR);
        $post = $req->execute();
    }

    /**
     * Update un billet
     * @param  Int $postId      ID du billet
     * @param  String $postTitle   Titre du billet
     * @param  String $postContent Contenu du billet
     */
    public function updatePost($values) 
    {        
        $binded = 'title = :title, content = :content';
        $column = 'id = :id';
        $db = $this->dbConnect();
        $sql = $this->update($binded, $column);
        $req = $db->prepare($sql);

        $req->bindValue(':title', $values['title'], PDO::PARAM_STR);
        $req->bindValue(':content', $values['content'], PDO::PARAM_STR);
        $req->bindValue(':id', $values['id'], PDO::PARAM_INT);
        $post = $req->execute();
    }

    /**
     * Efface le billet
     * @param  Int $postId ID du billet
     * @return Array         Billet supprimé
     */
    public function deletePost($postId) 
    {
        $db = $this->dbConnect();
        $sql = $this->delete($postId);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }

    
}