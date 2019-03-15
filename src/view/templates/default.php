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
                <?php
                if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])) {
                    echo '<div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bonjour ' . $_SESSION['pseudo'] . ' ! 
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="index.php?p=admin">Accès au panneau d\'administration</a>
                    <a class="dropdown-item" href="index.php?p=disconnect">Se déconnecter</a>
                    </div>
                    </div>';
                } else {
                    echo '<button type="button" class="btn btn-secondary" onclick="window.location.href=\'index.php?p=signin\'">Connexion</button>';
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