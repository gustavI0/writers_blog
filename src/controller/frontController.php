<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function listPosts() {

    $postManager = new \OpenClassrooms\Blog\Model\PostManager(); 
    $posts = $postManager->getPosts();

    require('view/frontend/home.php');
}

function post() {

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();


    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/singlePost.php');
}

function addComment($postId, $author, $comment) {

    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?p=post&id=' . $postId);
    }
}

function updateComment($commentId, $comment, $postId) {

    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $affectedComment = $commentManager->modifyComment($commentId, $comment);
    
    if ($affectedComment === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?p=post&id=' . $postId);
    }
}

function moderateComment($commentId, $comment, $postId) {

    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $affectedComment = $commentManager->modifyComment($commentId, $comment);
    
    if ($affectedComment === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php?p=post&id=' . $postId);
    }
}

function signup() {

    $userManager = new \OpenClassrooms\Blog\Model\UserManager();

    require('view/frontend/signup.php');
}

function register($pseudo, $pwd, $email) {

    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $pass_hache = password_hash($pwd, PASSWORD_DEFAULT);
    $newUser = $userManager->inscription($pseudo, $pass_hache, $email);
    
    if ($newUser === false) {
        throw new Exception('Impossible d\'inscrire le nouvel utilisateur !');
    }
    else {
        header('Location: index.php?=signedup');
    }
}

function signin() {

    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    // récupérer cookie

    require('view/frontend/signin.php');
}

function login($pseudo, $pwd) {

    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $result = $userManager->admin($pseudo, $pwd);

    $isPasswordCorrect = password_verify($_POST['pwd'], $result['pwd']);
    
    if (!$result)
    {
        echo 'Mauvais identifiant ou mot de passe !';
    }
    else
    {
        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['id'] = $result['id'];
            $_SESSION['pseudo'] = $pseudo;
            header('Location: index.php?p=admin');
        }
        else {
            echo 'Mauvais identifiant ou mot de passe !';
        }
    }

}
