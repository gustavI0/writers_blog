<?php $title = 'Editer un commentaire'; ?>
 
<?php ob_start(); ?>
<h1>Le blog de l'écrivain</h1>
<p><a href="index.php?p=post&amp;id=<?= $comment['post_id'] ?>">Retour au billet</a></p>

<h2>Editer un commentaire</h2>
<div class="container">
    <form action="index.php?p=editComment&amp;id=<?= $comment['id'] ?>&amp;post_id=<?= $comment['post_id'] ?>" method="post">
        <p>
            <strong><?= htmlspecialchars($comment['author']) ?></strong>
            le <?= $comment['comment_date_fr'] ?>
        </p>
        <div class="form-group">
            <label for="comment">Commentaire à modifier :</label><br />
            <textarea id="comment" name="comment" class="form-control" rows="8" cols="50"><?= nl2br(htmlspecialchars($comment['comment'])) ?></textarea>
        </div>
            <button type="submit" class="btn btn-primary" value="Modifier" />Modifier</button>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
 
<?php require('view/templates/admin.php'); ?>