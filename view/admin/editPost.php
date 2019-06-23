<?php $title = 'Editer un billet'; ?>

<h1><?= $title; ?></h1>

<!-- Formulaire d'édition d'un billet -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="updatePost-id-<?= $post->getId(); ?>" method="post">
                <p>
                    <em>Publié le <?= $post->getCreationDate(); ?></em>
                </p>
                <!-- Erreurs -->
                <?php
                    if (isset($_GET['status'])):
                        if ($_GET['status'] === 'success'):
                            echo '<div class="alert alert-success" role="alert">
                            Ce billet a bien été mis à jour ! <a href="showPost-id-' . $post->getID() . '">Voir l\'article</a>
                            </div>';
                        elseif ($_GET['status'] === 'empty'):
                            echo '<div class="alert alert-danger" role="alert">
                            Au moins un des champs de billet est vide !
                            </div>';
                        elseif ($_GET['status'] === 'failed'):
                        echo '<div class="alert alert-danger" role="alert">
                        Impossible d\'éditer ce billet !
                        </div>';
                        endif;
                    endif; ?>
                <!-- Formulaire -->
                <?php if ($post->getId()): ?>
                    <input type="hidden" name="values[id]" value="<?= $post->getId(); ?>"/>
                <?php endif; ?>
                <div class ="form-group">
                    <label for="title">Titre :</label><br />
                    <input id="title" name="values[title]" class="form-control" value="<?= nl2br(htmlspecialchars($post->getTitle())); ?>"/>
                </div>
                <div class ="form-group">
                    <label for="content">Contenu du billet :</label><br />
                    <textarea id="content" name="values[content]" class="form-control" rows="20" cols="60"><?= $post->getContent(); ?></textarea>
                </div>
                <div class ="form-group">
                    <button type="submit" class="btn btn-primary" value="Mettre à jour"/>Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>