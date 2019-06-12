<?php $title = 'Administration du blog'; ?>

<h1><?= $title; ?></h1>

<!-- Modal suppression billet-->
<div class="modal fade" id="delete-post" tabindex="-1" role="dialog" aria-labelledby="delete-post" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete-post">Supprimer un billet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Souhaitez-vous vraiment supprimer ce billet ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_link" data-dismiss="modal">Annuler</button>
        <a class="btn btn_delete btn_ok">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal suppression commentaire-->
<div class="modal fade" id="delete-comment" tabindex="-1" role="dialog" aria-labelledby="delete_comment" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delete_comment">Supprimer un commentaire</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Souhaitez-vous vraiment supprimer ce commentaire ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn_link" data-dismiss="modal">Annuler</button>
        <a class="btn btn_delete btn_ok">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<!-- Administration des billets -->

<!-- Bouton d'ajout de billet -->
<div class="container">
	<div class="row">
		<div class="add_btn">
			<a href="addPost" class="btn btn_link">Ajouter un billet</a>
		</div>
	</div>
</div>

<!-- Tableau de liste des billets -->
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="admin_posts">
				<h2>Liste des billets</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="table_posts">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Titre</th>
							<th>Date de publication</th>
							<th>Actions</th>
						</tr>
					</thead>
				<?php
				foreach ($posts as $post): ?>
					<tbody>
					    <tr>
					        <td>
					        	<?= htmlspecialchars($post->getTitle()); ?><br /><a href="showPost-id-<?= $post->getId(); ?>" class="dark_link">Voir l'article</a>
					        </td>
					        <td>
					        	<?= $post->getCreationDate(); ?>
					        </td>
					        <td>
					        	<a href="editPost-id-<?= $post->getId(); ?>"class="btn btn_basic">Editer</a>
					        	<button type="button" class="btn btn_delete" data-toggle="modal" data-target="#delete-post" data-href="erasePost-id-<?= $post->getId() ?>">Supprimer</button>
					        </td>
					    </tr>
				<?php
				endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Administration des commentaires -->
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="admin_comments">
				<h2>Liste des commentaires</h2>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="table_comments">
				<table class="table table-hover table-responsive">
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
				foreach ($comments as $comment): ?>
					<tbody>
				        <?php if ($comment->getModeration(true)):
					        	echo '<tr class="moderate_row info">
						        	<td>'. htmlspecialchars($post->getTitle()) .'<br /><a href="showPost-id-'. $comment->getPostId() .'" class="dark_link">Voir l\'article</a></td>
							        <td>'. htmlspecialchars($comment->getAuthor()) .'</td>
							        <td>'. htmlspecialchars($comment->getContent()) .'</td>
							        <td>'. $comment->getCreationDate() .'</td>
						        	<td>
						        		<a href="approveComment-id-' . $comment->getId() . '" class="btn btn_approve" >Approuver</a>
						        		<button type="button" data-href="eraseComment-id-' . $comment->getId() . '"class="btn btn_delete" data-toggle="modal" data-target="#delete-comment" >Supprimer</button>
						        		</td>
					        		</tr>';
					        else:
					        	echo '<tr>
						        	<td>'. htmlspecialchars($comment->getPostTitle()) .'<br /><a href="showPost-id-'. $comment->getPostId() .'" class="dark_link">Voir l\'article</a></td>
							        <td>'. htmlspecialchars($comment->getAuthor()) .'</td>
							        <td>'. htmlspecialchars($comment->getContent()) .'</td>
							        <td>'. $comment->getCreationDate() .'</td>
							        <td><button type="button" data-href="eraseComment-id-' . $comment->getId() . '" class="btn btn_delete" data-toggle="modal" data-target="#delete-comment" >Supprimer</button></td>
					        	</tr>';
					        endif;
					endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>