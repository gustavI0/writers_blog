<?php $title = 'Administration du blog'; ?>


<?php ob_start(); ?>

<div class="add">
	<button type="button" class="btn btn-info" onclick="window.location.href='index.php?p=addPost'">Ajouter un billet</button>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="admin_posts">
				<h2>Liste des billets</h2>
				<table class="table">
					<thead>
						<tr>
							<th>Titre</th>
							<th>Date de publication</th>
							<th>Actions</th>
						</tr>
					</thead>
				<?php
				while ($post = $posts->fetch())
				{
				?>
					<tbody>
					    <tr>
					        <td><?= htmlspecialchars($post['title']) ?><br /><a href="index.php?p=post&amp;id=<?= $post['id'] ?>">Voir l'article</a></td>
					        <td><?= $post['creation_date_fr'] ?></td>
					        <td><button type="button" class="btn btn-primary" onclick="window.location.href='index.php?p=editPost&amp;id=<?= $post['id'] ?>'">Editer</button> <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?p=deletePost&amp;id=<?= $post['id'] ?>'">Supprimer</button></td>
					    </tr>
				<?php
				}
				$posts->closeCursor();
				?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="admin_comments">
				<h2>Liste des commentaires à modérer</h2>
					<table class="table">
						<thead>
							<tr>
								<th>Auteur</th>
								<th>Contenu</th>
								<th>Date de publication</th>
								<th>Actions</th>
							</tr>
						</thead>
					<?php
					while ($comment = $comments->fetch())
					{
					?>
						<tbody>
						    <tr>
						        <td><?= htmlspecialchars($comment['author']) ?></td>
						        <td><?= htmlspecialchars($comment['comment']) ?></td>
						        <td><?= $comment['comment_date_fr'] ?></td>
						        <td><button type="button" class="btn btn-success" onclick="window.location.href='index.php?p=moderateComment&amp;id=<?= $comment['id'] ?>'">Approuver</button> <button type="button" class="btn btn-danger" onclick="window.location.href='index.php?p=deleteComment&amp;id=<?= $comment['id'] ?>'">Supprimer</button></td>
						    </tr>
					<?php
					}
					$posts->closeCursor();
					?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
$content = ob_get_clean();

require('view/templates/admin.php'); 
?>