<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="public/css/style.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
        <link href="public/css/style.css" rel="stylesheet" />
    </head>
        
    <body>
        <nav>
            <div>
                <?= '<a href="index.php">Accès à la page d\'accueil</a>' ?>
            </div>
        </nav>
    	<main>
	    	<div class="container">
	        	<?= $content ?>
	    	</div>
    	</main>
    </body>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=jjfxgpy7rm00ytowzec4htmu0ppmvjeolcmd7or3nttqhw07"></script>
</html>