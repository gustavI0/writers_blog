<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
include ('view/templates/head.php');

?>
        
    <body>
        <nav>
            <div>
                <p><a href="index.php" class="link_btn">Accès à la page d'accueil</a></p>
            </div>
        </nav>
        <main>
            <div class="container">
                <?= $content ?>
            </div>
        </main>
    </body>
<?php include ('view/templates/footer.php'); ?>