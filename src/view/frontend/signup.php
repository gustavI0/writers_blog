<?php $title = 'Inscrivez-vous'; ?>

<?php ob_start(); ?>
<h1><?= $title ?></h1>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="index.php?p=register" method="post">
				<div class="form-group">
					<div class="col-sm-4">
						<label for="pseudo">Votre pseudo :</label>
						<input type="text" class="form-control" name="pseudo" size="45"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="pwd">Mot de passe :</label>
						<input type="password" class="form-control" name="pwd" size="45"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="pwd2">Retapez votre mot de passe :</label>
						<input type="password" class="form-control" name="pwd2" size="45"/>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-4">
						<label for="pseudo">Votre adresse email :</label>
						<input type="email" class="form-control" name="email" size="45"/>
					</div>
				</div>
					<button type="submit" class="btn btn-primary" value="Valider" />Valider</button>
			</form>
		</div>
	</div>
</div>
<?php
$content = ob_get_clean(); ?>

<?php require('view/templates/login.php'); ?>