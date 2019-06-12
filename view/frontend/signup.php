<?php $title = 'Inscrivez-vous'; ?>

<h1><?= $title ?></h1>

<!-- Formulaire d'inscription -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php if (isset($_GET['status'])):
                    if ($_GET['status'] === 'difpwd'):
                        echo '<div class="alert alert-danger" role="alert">Vos mots de passe sont différents !</div>';
                    elseif ($_GET['status'] === 'fieldmissing'):
                        echo '<div class="alert alert-danger" role="alert">Tous les champs ne sont pas remplis !</div>';
                    endif;
                endif; ?>
			<form action="register" method="post">
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
				<button type="submit" class="btn btn_basic" value="Valider">Valider</button>
			</form>
		</div>
	</div>
</div>