<?php
namespace Blog\Controller;

use Blog\Model\{
    PostManager,
    CommentManager,
    Post
};

use Blog\View\View;

class AdminController extends Controller {

    private $emPost;
    private $emComment;

    public function __construct() 
    {
        $this->emPost = new PostManager();
        $this->emComment = new CommentManager();
    }

    /**
     * Récupère les infos d'administration et les affiche
     * @return Arrays Tableaux de billets et commentaires
     */
    public function admin($params)
    {
        $posts = $this->emPost->getAllPosts();
        $comments = $this->emComment->getAllComments();

        $view = new View('admin');
        $view->renderBack(array('posts' => $posts, 'comments' => $comments));
    }

    /**
     * Affiche la page d'ajout de billet
     * @param [type] $params [description]
     */
    public function addPost($params) 
    {
        $post = new Post();

        $view = new View('addPost');
        $view->renderBack(array('post' => $post));
    }

    /**
     * Création d'un billet
     * @param  String $postTitle   Ttitre du billet
     * @param  String $postContent Contenu du billet
     * @return Array              Titre et contenu du billet
     */
    public function createPost($params) 
    {
        $values  = $_POST['values'];

        if (!empty($values['content'])) {
            $post = $this->emPost->insertPost($values);

            $view = new View('admin');
            $view->redirect('admin');
        } 
        else {
            $view = new View('addPost');
            $view->redirect('addPost&status=empty');
        }
    }

    /**
     * Affichage de la page d'un billet à éditer
     * @param  Int $postId ID du billet
     * @return Array         Billet à éditer
     */
    public function editPost($params) 
    {
        extract($params);
        if (isset($id)) {
            $post = $this->emPost->getSinglePost($id);
        }
        
        $view = new View('editPost');
        $view->renderBack(array('post' => $post));
    }

    /**
     * Mise à jour d'un billet
     * @param  Int $postId      ID du billet
     * @param  String $postTitle   Titre du billet
     * @param  String $postContent Contenu du billet
     * @return Array              Billet édité
     */
    public function modifyPost($params) 
    {
        extract($params);
        $values  = $_POST['values'];
        if (isset($id)) {
            if (!empty($values['content'])) {
                $affectedPost = $this->emPost->updatePost($values);

                $view = new View('editPost');
                $view->redirect('editPost-id-' . $id . '&status=success');
            }
            else {
                $view = new View('editPost');
                $view->redirect('editPost-id-' . $id . '&status=empty');
            }
        }
        else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }

    /**
     * Effacer un billet
     * @param  Int $postId ID du billet
     * @return Array         Billet supprimé
     */
    public function erasePost($params)
    {
        extract($params);
        if (isset($id)) {
    	   $deletedPost = $this->emPost->deletePost($id);
        }
        else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

    	if (!$deletedPost) {
            throw new Exception('Impossible de supprimer le billet !');
        }
        else {
            $view = new View('admin');
            $view->redirect('admin');
        }
    }

    /**
     * Approuver un commentaire signalé
     * @param  Int $commentId ID du commentaire
     * @return Boolean            0 pour commentaire approuvé
     */
    public function approveComment($params) 
    {   
        extract($params);
        if (isset($id)) {
            $approvedComment = $this->emComment->moderate($id, 0);
        }
        else {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }

        if (!$approvedComment) {
            throw new Exception('Impossible d\'approuver le commentaire !');
        }
        else {
            $view = new View('admin');
            $view->redirect('admin');
        }
    }

    /**
     * Effacer commentaire
     * @param  Int $commentId ID du commentaire
     * @return Array            Commentaire supprimé
     */
    public function eraseComment($params) 
    {
    	extract($params);
        if (isset($id)) {
            $deletedComment = $this->emComment->deleteComment($id);
        } 
        else {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }

    	if (!$deletedComment) {
            throw new Exception('Impossible de supprimer le commentaire !');
        }
        else {
            $view = new View('admin');
            $view->redirect('admin');
        }
    }
}