<?php $title = 'Connectez-vous'; ?>

<h1><?= $title ?></h1>

<!-- Formulaire de connexion -->
<div class="container">
	<div class="col-sm-12">
		<?php
            if (isset($_GET['status'])):
                if ($_GET['status'] === 'failed'):
                    echo '<div class="alert alert-danger" role="alert">Mauvais identifiant ou mot de passe !</div>';
                elseif ($_GET['status'] === 'fieldmissing'):
                    echo '<div class="alert alert-danger" role="alert">Tous les champs ne sont pas remplis !</div>';
                endif;
            endif;  ?>
		<div class="log_form">
			<form action="login" method="post">
				<div class="form-group row">
						<label for="pseudo">Votre pseudo :</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="values[pseudo]"/>
					</div>
				</div>
				<div class="form-group row">
						<label for="pwd">Mot de passe :</label>
					<div class="col-sm-4">
						<input type="password" class="form-control" name="values[pwd]"/>
					</div>
				</div>
				<button type="submit" class="btn btn_basic" value="Valider"/>Valider</button>
			</form>
		</div>
	</div>
</div>