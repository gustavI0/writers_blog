<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function admin() {

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

function createPost($postTitle, $postContent) {

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
        header('Location: index.php?p=editPost&id=' . $postId . '&result=failed');
    }
    else {
        header('Location: index.php?p=editPost&id=' . $postId . '&result=success');
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
    $approvedComment = $commentManager->okComment($commentId);

    if ($deletedComment === false) {
        throw new Exception('Impossible d\'approuver le commentaire !');
    }
    else {
        header('Location: index.php?p=admin');
    }
}

function deleteComment($commentId) {

	$commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
	$deletedComment = $commentManager->eraseComment($commentId);

	if ($deletedComment === false) {
        throw new Exception('Impossible de supprimer le commentaire !');
    }
    else {
        header('Location: index.php?p=admin');
    }
}