<?php $title = $post['title']; ?>

<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Le blog de l'écrivain</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p><a href="index.php">Retour à l'accueil</a></p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="single_post">
                <div class="title_single_post">
                    <h2><?= htmlspecialchars($post['title']) ?></h2>
                    <em>le <?= $post['creation_date_fr'] ?></em>
                </div>
                <div class="content_single_post">
                    <p>
                        <?= nl2br(htmlspecialchars($post['content'])) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-6">
            <h3>Commentaires</h3>
            <?php
            while ($comment = $comments->fetch())
            {
            ?>
                <div class="comment">
                    <p>
                        <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> (<a href="index.php?p=signalComment&amp;id=<?= $comment['id'] ?>&amp;post_id=<?= $post['id'] ?>" class="signal_comment">signaler</a>)
                    </p>
                    <p>
                        <?php
                            if ($comment['moderation'] == true) {
                                echo $comment['comment'] = '<p><em> Commentaire modéré</em></p>';
                            } else {
                                echo nl2br(htmlspecialchars($comment['comment']));
                            }
                        ?>
                    </p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-8">
            <form action="index.php?p=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <div class="form-group">
                    <label for="author">Auteur</label><br />
                    <input type="text" id="author" name="author" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="comment">Commentaire</label><br />
                    <textarea id="comment" name="comment" class="form-control" rows="4" cols="50"></textarea>
                </div>
                    <button type="submit" class="btn btn-primary" value="Ajouter" />Ajouter</button>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/templates/default.php'); ?>