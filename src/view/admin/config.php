<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    if (isset ($_COOKIE['pseudo']) && isset ($_COOKIE['pwd'])) {
        $pseudo = $_COOKIE['pseudo'];
        $pwd = $_COOKIE['pwd'];

        $userManager = new \OpenClassrooms\Blog\Model\UserManager();
        $result = $userManager->getUserCred($pseudo);
        
        if ($pwd === $result['pwd']) {
                session_start();
                $_SESSION['id'] = $result['id'];
                $_SESSION['pseudo'] = $pseudo;
        }
    }