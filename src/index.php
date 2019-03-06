<?php
if(!isset($_SESSION)) { 
    session_start(); 
} 

require('controller/frontController.php');
require('controller/adminController.php');
require('controller/loginController.php');

try {

    // Gestion de l'affichage des pages front
    if (isset($_GET['p'])) {
        if ($_GET['p'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['p'] == 'showPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                showPost();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        // Gestion des billets
        elseif ($_GET['p'] == 'addPost') {
                addPost();
        }
        elseif ($_GET['p'] == 'newPost') {
            if (!empty($_POST['content'])) {
                newPost($_POST['title'], $_POST['content']);
            }
            else {
                throw new Exception('Le champ de billet est vide !');
            }
        }
        elseif ($_GET['p'] == 'editPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                editPost();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['p'] == 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['content'])) {
                    updatePost($_GET['id'], $_POST['title'], $_POST['content']);
                }
                else {
                    throw new Exception('Le champ de billet est vide !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['p'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        // Gestion des commentaires
        elseif ($_GET['p'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['p'] == 'editComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                comment();
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['p'] == 'signalComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                signalComment($_GET['id'], $_GET['post_id']);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['p'] == 'approveComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                approveComment($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['p'] == 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }

        // Gestion des utilisateurs
        elseif ($_GET['p'] == 'signup') {
                signup();
        }
        elseif ($_GET['p'] == 'register') {
            if (!empty($_POST['pseudo']) && !empty($_POST['pwd']) && !empty($_POST['email'])) {
                if(!preg_match($_POST['pwd'], $_POST['pwd2'])) {
                    register($_POST['pseudo'], $_POST['pwd'], $_POST['email']);
                } else {
                throw new Exception('Vos mots de passe ne correspondent pas !');
                } 
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }   
        }
        elseif ($_GET['p'] == 'regSuccess') {
                header('Location: frontend/regSuccess.php');
        }
        elseif ($_GET['p'] == 'signin') {
                signin();
        }
        elseif ($_GET['p'] == 'login') {
            if (!empty($_POST['pseudo']) && !empty($_POST['pwd'])) {
                login($_POST['pseudo'], $_POST['pwd']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }  
        }
        elseif ($_GET['p'] == 'admin') {
            if (isset($_SESSION['id'])) {
                adminPosts();
            } else {
                throw new Exception('Vous ne passerez pas !');
            }
        }
        elseif ($_GET['p'] == 'disconnect') {
            session_destroy();
            header('Location: index.php');
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) { 
    echo 'Erreur : ' . $e->getMessage();
}
