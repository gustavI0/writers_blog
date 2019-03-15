<?php
    require_once('model/UserManager.php');

	if(isset ($_COOKIE['pseudo']) && isset ($_COOKIE['pwd']) && !isset($_SESSION)) {

        $pseudo = $_COOKIE['pseudo'];
        $pwd = $_COOKIE['pwd'];

        $userManager = new \OpenClassrooms\Blog\Model\UserManager();
        $result = $userManager->getUserCred($pseudo);
        
        if ($pwd === $result['pwd']) {
            
                session_start();
                $_SESSION['id'] = $result['id'];
                $_SESSION['pseudo'] = $pseudo;
        } 
    } elseif (!isset($_SESSION)) { 

        session_start();
    }

?>