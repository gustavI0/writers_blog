<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

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
        header('Location: index.php?p=regSuccess');
    }
}

function regSuccess() {

    require('view/frontend/regSuccess.php');
}

function signin() {
    
    require('view/frontend/signin.php');
}

function login($pseudo, $pwd) {

    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $result = $userManager->getUserCred($pseudo);

    $isPasswordCorrect = password_verify($pwd, $result['pwd']);
    
    if (!$result)
    {
        header('Location: index.php?p=signin&result=failed');
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
            header('Location: index.php?p=signin&result=failed');
        }
    }

    if (isset ($_POST['cookie'])) {
        setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true);
        setcookie('pwd', $result['pwd'], time() + 365*24*3600, null, null, false, true);
    }

}
