<?php
namespace Blog\Controller;

use Blog\Model\{
    PostManager,
    CommentManager
};

use Blog\View\View;

class FrontController extends Controller {

    private $emPost;
    private $emComment;

    public function __construct() 
    {
        $this->emPost = new PostManager();
        $this->emComment = new CommentManager();
    }

    /**
     * Récupère la liste des billets
     * @return Array Liste de billets
     */
    public function home($params)
    {
        $posts = $this->emPost->getAllPosts();

        $view = new View('home');
        $view->renderFront(array('posts' => $posts));
    }

    /**
     * Affiche un billet spécifique
     * @param  Int $id ID du billet à afficher
     * @return Array     Billet à afficher
     */
    public function showPost($params)
    {
        extract($params);
        
        if (!isset($id)) {
            throw new Exception('Aucun identifiant de billet envoyé');    
        } 
            
        $post = $this->emPost->getSinglePost($id);
        $comments = $this->emComment->getPostComments($id);

        $view = new View('singlePost');
        $view->renderFront(array('post' => $post, 'comments' => $comments));
    }

    /**
     * Ajoute un commentaire
     * @param Int $postId  ID du billet
     * @param String $author  Auteur du billet
     * @param String $comment Contenu du commentaire
     */
    public function addComment()
    {
        $values = $_POST['values'];
        if (!empty($values['author']) && !empty($values['content'])) {
            $newComment = $this->emComment->insertComment($values);
        
            $view = new View('singlePost');
            $view->redirect('showPost-id-' . $values['postId']);
        }
    }

    /**
     * Signaler un commentaire
     * @param  Array $params Paramètres du commentaire ($postId, $author, $content)
     */
    public function signalComment($params) 
    {
        extract($params);

        if (!isset($id)) {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }

        $comment = $this->emComment->getSingleComment($id);
        $affectedComment = $this->emComment->moderate($id, 1);

        $view = new View('singlePost');
        $view->redirect('showPost-id-' . $postId);
        
    }
}