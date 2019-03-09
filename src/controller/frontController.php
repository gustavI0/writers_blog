<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function listPosts() {

    $postManager = new \OpenClassrooms\Blog\Model\PostManager(); 
    $posts = $postManager->getPosts();

    require('view/frontend/home.php');
}

function showPost() {

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();


    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getPostComments($_GET['id']);

    require('view/frontend/singlePost.php');
}

function addComment($postId, $author, $comment) {

    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $affectedLines = $commentManager->insertComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?p=showPost&id=' . $postId);
    }
}

function signalComment($commentId, $postId) {

    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $comment = $commentManager->getComment($commentId);
    $affectedComment = $commentManager->moderateComment($commentId);
    
    if ($affectedComment === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        header('Location: index.php?p=showPost&id=' . $postId);
    }
}

