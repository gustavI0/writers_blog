<?php $title = 'Connectez-vous'; ?>

<?php ob_start(); ?>
<h1><?= $title ?></h1>

<div class="container">
	<div class="col-sm-12">
		<?php
            if (isset($_GET['result'])) {
                if ($_GET['result'] === 'failed') {
                    echo '<div class="alert alert-danger" role="alert">Mauvais identifiant ou mot de passe !</div>';
                }
            }  
        ?>
		<div class="log_form">
			<form action="index.php?p=login" method="post">
				<div class="form-group row">
						<label for="pseudo">Votre pseudo :</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="pseudo"/>
					</div>
				</div>
				<div class="form-group row">
						<label for="pwd">Mot de passe :</label>
					<div class="col-sm-4">
						<input type="password" class="form-control" name="pwd"/>
					</div>
				</div>
				<div class="form-check row">
				    <input type="checkbox" name="cookie" class="form-check-input" id="cookie">
				    <label class="form-check-label" for="cookie">Se souvenir de moi</label>
				</div>
				<button type="submit" class="btn btn_basic" value="Valider"/>Valider</button>
			</form>
		</div>
	</div>
</div>

<?php
$content = ob_get_clean(); ?>

<?php require('view/templates/login.php'); ?>