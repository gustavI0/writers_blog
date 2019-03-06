<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function adminPosts() {

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $posts = $postManager->getPosts();
    $comments = $commentManager->adminComments();

    require('view/admin/admin.php');
}

function addPost() {

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    
    require('view/admin/addPost.php');
}

function newPost($postTitle, $postContent) {

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $newPost = $postManager->addingPost($postTitle, $postContent);
    
    if ($newPost === false) {
        throw new Exception('Impossible d\'ajouter le billet !');
    }
    else {
        header('Location: index.php?p=admin');
    }
}

function editPost() {

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $post = $postManager->getPost($_GET['id']);
    
    require('view/admin/editPost.php');
}

function updatePost($postId, $postTitle, $postContent) {

	$postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $affectedPost = $postManager->modifyPost($postId, $postTitle, $postContent);
    
    if ($affectedPost === false) {
        throw new Exception('Impossible de modifier le billet !');
    }
    else {
        header('Location: index.php?p=admin');
    }
}

function deletePost($postId) {

	$postManager = new \OpenClassrooms\Blog\Model\PostManager();
	$deletedPost = $postManager->erasePost($postId);

	if ($deletedPost === false) {
        throw new Exception('Impossible de supprimer le billet !');
    }
    else {
        header('Location: index.php?p=admin');
    }
}

function approveComment($commentId) {

    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $comment = $commentManager->getComment($_GET['id']);
    

}

function deleteComment($commentId) {

	$postManager = new \OpenClassrooms\Blog\Model\PostManager();
	$deletedPost = $postManager->erasePost($postId);

	if ($deletedPost === false) {
        throw new Exception('Impossible de supprimer le billet !');
    }
    else {
        header('Location: index.php?p=admin');
    }
}