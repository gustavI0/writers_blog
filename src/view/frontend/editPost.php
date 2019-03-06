<?php $title = 'Editer un billet'; ?>
 
<?php ob_start(); ?>
<h1>Le blog de l'écrivain</h1>
<p><a href="index.php?p=admin">Retour à l'administration</a></p>

    <h2>Editer un billet</h2>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="index.php?p=updatePost&amp;id=<?= $post['id'] ?>" method="post">
                <p>
                    <em>Publié le <?= $post['creation_date_fr'] ?></em>
                </p>
                <div class ="form-group">
                    <label for="title">Titre :</label><br />
                    <input id="title" name="title" class="form-control" value="<?= nl2br(htmlspecialchars($post['title'])) ?>"/>
                </div>
                <div class ="form-group">
                    <label for="content">Contenu du billet :</label><br />
                    <textarea id="content" name="content" class="form-control" rows="20" cols="60"><?= nl2br(htmlspecialchars($post['content'])) ?></textarea>
                </div>
                <div class ="form-group">
                    <button type="submit" class="btn btn-primary" value="Modifier" />Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
 
<?php require('view/frontend/templates/default.php'); ?>