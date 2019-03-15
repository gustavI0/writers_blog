<?php

include ('view/admin/config.php');
include ('view/templates/head.php');

?>
        
    <body>
        <nav>
            <div>
                <?php
                if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])) {
                    echo '<div class="dropdown">
                    <a class="btn btn_link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bonjour ' . $_SESSION['pseudo'] . ' ! </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="index.php">Accès à la page d\'accueil</a>
                    <a class="dropdown-item" href="index.php?p=disconnect">Se déconnecter</a>
                    </div>
                    </div>';
                } else {
                    echo '<a href="index.php?p=signin" class="btn btn_link">Se reconnecter</a>';
                }
                ?>
            </div>
        </nav>
        <main>
            <div class="container">
                <?= $content ?>
            </div>
        </main>
    </body>
<?php include ('view/templates/footer.php'); ?>