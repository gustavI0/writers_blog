<?php $title = 'Ajouter un billet'; ?>

<h1><?= $title; ?></h1>

<!-- Formulaire d'ajout de billet -->
<div class="container">
    <form action="createPost" method="post">
        <!-- Erreurs -->
        <?php
            if (isset($_GET['status'])):
                if ($_GET['status'] === 'empty'):
                    echo '<div class="alert alert-danger" role="alert">
                    Au moins un des champs de billet est vide !
                    </div>';
                endif;
            endif; ?>
        <?php if ($post->getId()):?>
            <input type="hidden" name="values[id]" value="<?= $post->getId(); ?>"/>
        <?php endif;?>
        <div class ="form-group">
            <label for="title">Titre :</label><br />
            <input id="title" name="values[title]" class="form-control"/>
        </div>
        <div class ="form-group">
            <label for="content">Contenu du billet :</label><br />
            <textarea id="content" name="values[content]" class="form-control" rows="20" cols="60"></textarea>
        </div>
        <div class ="form-group">
            <button type="submit" class="btn btn_basic" value="Ajouter" />Ajouter</button>
        </div>
    </form>
</div>