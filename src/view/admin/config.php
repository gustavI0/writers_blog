<?php
    if (isset ($_COOKIE['pseudo']) && isset ($_COOKIE['pwd'])) {
        $pseudo = $_COOKIE['pseudo'];
        $pwd = $_COOKIE['pwd'];
        echo $_COOKIE['pwd'];
        login($pseudo, $pwd);
    } else {