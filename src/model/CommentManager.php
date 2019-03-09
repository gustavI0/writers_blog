<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php"); 

class CommentManager extends Manager {

    public function getPostComments($postId) {

        $db = $this->dbConnect();
        $comments = $db->prepare('
            SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, moderation 
            FROM comments 
            WHERE post_id = ? 
            ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function insertComment($postId, $author, $comment) {

        $db = $this->dbConnect();
        $comments = $db->prepare('
            INSERT INTO comments(post_id, author, comment, comment_date) 
            VALUES(:id, :author, :comment, NOW())');
        $affectedLines = $comments->execute(array(
            'id' => $postId,
            'author' => $author,
            'comment' => $comment));

        return $affectedLines;
    }
    
    public function getComment($commentId) {

        $db = $this->dbConnect();
        $req = $db->prepare('
            SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr 
            FROM comments 
            WHERE id = ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
    }

    public function adminComments() {

        $db = $this->dbConnect();
        $comments = $db->prepare('
            SELECT c.id, c.post_id, c.author, c.comment, c.moderation, DATE_FORMAT(c.comment_date, \'%d/%m/%Y à %Hh%imin\') comment_date_fr, p.title title
            FROM comments c 
            LEFT JOIN posts p
            ON c.post_id = p.id
            ORDER BY c.moderation DESC, c.comment_date DESC');
        $comments->execute(array());

        return $comments;
    }
    
    public function moderateComment($commentId) {

        $db = $this->dbConnect();
        $newComment = $db->prepare('UPDATE comments 
            SET moderation = true 
            WHERE id = ?');
        $affectedComment = $newComment->execute(array($commentId));
        
        return $affectedComment;
    }

    public function okComment($commentId) {

        $db = $this->dbConnect();
        $newComment = $db->prepare('
            UPDATE comments 
            SET moderation = false 
            WHERE id = ?');
        $affectedComment = $newComment->execute(array($commentId));
        
        return $affectedComment;
    }

    public function eraseComment($commentId) {

        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($commentId));

        return $req;
    }
}