<?php $title = 'Merci pour votre inscription'; ?>

<?php ob_start(); ?>
<h1><?= $title ?></h1>

<div class="container">
	<div class="row">
		<div class="col-md-12">
					<button type="submit" class="btn btn-primary" value="Aller sur le site" />Aller sur le site</button>
		</div>
	</div>
</div>
<?php
$content = ob_get_clean(); ?>

<?php require('view/templates/default.php'); ?>