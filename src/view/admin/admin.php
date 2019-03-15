<?php $title = 'Administration du blog'; ?>


<?php ob_start(); ?>

<!-- Modal suppression billet-->
<div class="modal fade" id="delete-post" tabindex="-1" role="dialog" aria-labelledby="delete-post" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete-post">Supprimer un billet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Souhaitez-vous réellement supprimer ce billet ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <a class="btn btn-danger btn-ok">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="row">
		<div class="add">
			<button type="button" class="btn btn-info" onclick="window.location.href='index.php?p=addPost'">Ajouter un billet</button>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="admin_posts">
				<h2>Liste des billets</h2>
				<table class="table table-hover">
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
					        <td>
					        	<?= htmlspecialchars($post['title']) ?><br /><a href="index.php?p=showPost&amp;id=<?= $post['id'] ?>" class="dark_link">Voir l'article</a>
					        </td>
					        <td>
					        	<?= $post['creation_date_fr'] ?>
					        </td>
					        <td>
					        	<button type="button" class="btn btn-primary" onclick="window.location.href='index.php?p=editPost&amp;id=<?= $post['id'] ?>'">Editer</button>
					        	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-post" data-href="index.php?p=deletePost&amp;id=<?= $post['id'] ?>">Supprimer</button>
					        </td>
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

<!-- Modal suppression commentaire-->
<div class="modal fade" id="delete-comment" tabindex="-1" role="dialog" aria-labelledby="delete_comment" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete_comment">Supprimer un commentaire</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Souhaitez-vous réellement supprimer ce commentaire ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <a class="btn btn-danger btn-ok">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="admin_comments">
				<h2>Liste des commentaires</h2>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Article</th>
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
						    	<td><?= htmlspecialchars($comment['title']) ?><br /><a href="index.php?p=showPost&amp;id=<?= $comment['post_id'] ?>" class="dark_link">Voir l'article</a></td>
						        <td><?= htmlspecialchars($comment['author']) ?></td>
						        <td><?= htmlspecialchars($comment['comment']) ?></td>
						        <td><?= $comment['comment_date_fr'] ?></td>
						        <?php
						        if ($comment['moderation'] == TRUE) {
						        	echo '<td>
						        		<button type="button" class="btn btn-success" onclick="window.location.href=\'index.php?p=approveComment&amp;id=' . $comment['id'] . '\'">Approuver</button>
						        		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-comment" data-href="index.php?p=deleteComment&amp;id=' . $comment['id'] . '">Supprimer</button>
						        		</td>';
						        } else {
						        	echo '<td>
						        	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-comment" data-href="index.php?p=deleteComment&amp;id=' . $comment['id'] . '">Supprimer</button>
						        	</td>';
						        }
						        ?>
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