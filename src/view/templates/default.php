<?php

include ('view/admin/config.php');
include ('view/templates/head.php');

?>
    <body>
        <nav class="col-sm-12">
            <ul>
                <li>
                    <?php
                    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])) {
                        echo '<div class="dropdown">
                            <a class="btn btn_link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Bonjour ' . $_SESSION['pseudo'] . ' ! 
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="index.php?p=admin">Accès au panneau d\'administration</a>
                                <a class="dropdown-item" href="index.php?p=disconnect">Se déconnecter</a>
                            </div>
                        </div>';
                    } else {
                        echo '<a href="index.php?p=signin" class="btn btn_link">Connexion</a>';
                    }
                    ?>
                </li>
                <li>
                    <a href="index.php" class="btn btn_link" id="return_home" >Accueil</a>
                </li>
            </ul>
        </nav>
    	<main>
	        <?= $content ?>
    	</main>
    </body>
<?php include ('view/templates/footer.php'); ?>