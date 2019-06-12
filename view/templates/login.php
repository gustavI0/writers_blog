<?php include ('view/templates/head.php'); ?>
        
<nav class="col-sm-12">
    <div>
        <a href="home" class="btn btn_link">Accès à la page d'accueil</a>
    </div>
</nav>
<main>
    <div class="container">
        <?= $content ?>
    </div>
</main>

<?php include ('view/templates/footer.php'); ?>