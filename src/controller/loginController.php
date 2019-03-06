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
        header('Location: index.php?=regSuccess');
    }
}

function signin() {
    
    require('view/frontend/signin.php');
}

function login($pseudo, $pwd) {

    $userManager = new \OpenClassrooms\Blog\Model\UserManager();
    $result = $userManager->connect($pseudo, $pwd);

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

    if (isset ($_POST['login_checked'])) {
        setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true);
        setcookie('pwd', $result['pwd'], time() + 365*24*3600, null, null, false, true);
    }

}
