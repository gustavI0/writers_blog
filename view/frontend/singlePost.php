<?php $title = $post->getTitle(); ?>

<!-- Titre du blog -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><a href="home"><?= BLOGTITLE; ?></a></h1>
        </div>
    </div>
</div>

<!-- Affichage du billet -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="single_post">
                <div class="title_single_post">
                    <h2><?= htmlspecialchars($post->getTitle()); ?></h2>
                    <h4>le <?= $post->getCreationDate(); ?></h4>
                </div>
                <div class="content_single_post">
                    <p>
                        <?= $post->getContent(); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Liste de commentaires -->
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-6">
            <h3>Commentaires</h3>
            <?php if(isset($comments)):
                foreach ($comments as $comment): ?>
                    <div class="comment">
                        <p>
                            <strong><?= htmlspecialchars($comment->getAuthor()); ?></strong><?= $comment->getCreationDate(); ?> (<a href="signalComment-id-<?= $comment->getId(); ?>-postId-<?= $post->getId(); ?>" class="dark_link">signaler</a>)
                        </p>
                        <p>
                            <?php if ($comment->getModeration(true)):
                                    echo '<p><em>Commentaire modéré !</em></p>';
                                else:
                                    echo nl2br(htmlspecialchars($comment->getContent()));
                                endif; ?>
                        </p>
                    </div>
            <?php endforeach;
            else:
                echo '<h4> Soyez le premier à commenter !</h4>';
            endif; ?>
        </div>
    </div>
</div>

<!-- Formulaire d'ajout de commentaire -->
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-6">
            <div class="add_comment">
                <form action="addComment-id-<?= $post->getId(); ?>" method="post">
                    <?php if ($post->getId()):?>
                        <input type="hidden" name="values[postId]" value="<?= $post->getId(); ?>"/>
                    <?php endif;?>
                    <div class="form-group">
                        <label for="author">Auteur</label><br />
                        <input type="text" id="author" name="values[author]" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="comment">Commentaire</label><br />
                        <textarea id="comment" name="values[content]" class="form-control" rows="4" cols="50"></textarea>
                    </div>
                        <button type="submit" class="btn btn_basic" value="Ajouter" />Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>