<?php include_once('view/templates/head.php'); ?>

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
                        <a class="dropdown-item" href="admin">Accès au panneau d\'administration</a>
                        <a class="dropdown-item" href="disconnect">Se déconnecter</a>
                    </div>
                </div>';
            } else {
                echo '<a href="signin" class="btn btn_link">Connexion</a>';
            }
            ?>
        </li>
        <li>
            <a href="home" class="btn btn_link" id="home" >Accueil</a>
        </li>
    </ul>
</nav>
<main>
    <?= $content ?>
</main>

<?php include_once('view/templates/footer.php'); ?>