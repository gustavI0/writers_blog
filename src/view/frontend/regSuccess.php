<?php $title = 'Merci'; ?>

<?php ob_start(); ?>
<h1><?= $title ?></h1>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<p><a href="index.php">Retourner à la page d'accueil</a></p>
		</div>
	</div>
</div>
<?php
$content = ob_get_clean(); ?>

<?php require('view/templates/login.php'); ?>