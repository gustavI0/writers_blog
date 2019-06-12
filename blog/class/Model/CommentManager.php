<?php
namespace Blog\Model;

use \PDO;

class CommentManager extends Manager {

    const TABLE_NAME = 'comments';

    /**
     * Récupère les commentaires d'un billet spécifique
     * @param  int $postId ID du billet
     * @return array         Auteur et contenu du commentaire
     */
    public function getPostComments($postId) 
    {
        $db = $this->dbConnect();
        $sql = $this->find('post_id', $postId);
        $req = $db->prepare($sql);
        $req->execute();
        while($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $comment = new Comment();
            $comment->setId($row['id']);
            $comment->setPostId($row['post_id']);
            $comment->setAuthor($row['author']);
            $comment->setContent($row['content']);
            $comment->setDate($row['creation_date']);
            $comment->setModeration($row['moderation']);

            $comments[] = $comment;
        }
        if(!empty($comments)) return $comments;
    }

    /**
     * Récupère tous les commentaires pour administration
     * @return array Tous les commentaires
     */
    public function getAllComments() 
    {
        $db = $this->dbConnect();
        $sql = $this->adminComments();
        $req = $db->prepare($sql);
        $req->execute();
        while($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $comment = new Comment();
            $comment->setId($row['id']);
            $comment->setPostId($row['post_id']);
            $comment->setAuthor($row['author']);
            $comment->setContent($row['content']);
            $comment->setDate($row['creation_date']);
            $comment->setModeration($row['moderation']);
            $comment->setPostTitle($row['title']);

            $comments[] = $comment;
        }
        if(!empty($comments)) return $comments;
        return $comments;
    }

    /**
     * Récupère un commentaire  spécifique
     * @param  int $commentId ID du commentaire
     * @return array             Titre et contenu du commentaire
     */
    public function getSingleComment($commentId) 
    {
        $db = $this->dbConnect();
        $sql = $this->find('id', $commentId);
        $req = $db->prepare($sql);
        $req->execute();
        $comment = $req->fetch();

        return $comment;
    }

    /**
     * Ajoute un commentaire à la base de données
     * @param  int $postId  ID du billet
     * @param  string $author  Auteur
     * @param  string $comment Contenu du commentaire
     * @return array          Titre et contenu du commentaire
     */
    public function insertComment($values) 
    {
        $db = $this->dbConnect();
        $sql = $this->createComment();
        $req = $db->prepare($sql);

        $req->bindValue(':postId', $values['postId'], PDO::PARAM_STR);
        $req->bindValue(':author', $values['author'], PDO::PARAM_STR);
        $req->bindValue(':content', $values['content'], PDO::PARAM_STR);
        $newComment = $req->execute();

    }
    
    /**
     * Change le statut de moderation d'un commentaire
     * @param  int $commentId ID du commentaire
     * @return Boolean            Statut de modération du commenaire
     */
    public function moderate($commentId, $bool) 
    {
        $db = $this->dbConnect();
        $signaledComment = $db->prepare('
            UPDATE comments 
            SET moderation = :bool 
            WHERE id = :id');
        $affectedComment = $signaledComment->execute(array(
            'id' => $commentId,
            'bool' => $bool));
        
        return $affectedComment;
    }

    /**
     * Efface un commentaire
     * @param  int $commentId ID du commentaire
     * @return Bool            Effacé ou non
     */
    public function deleteComment($commentId) 
    {
        $db = $this->dbConnect();
        $sql = $this->delete($commentId);
        $req = $db->prepare($sql);
        $req->execute();

        return $req;
    }
}