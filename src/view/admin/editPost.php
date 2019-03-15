<?php $title = 'Editer un billet'; 

?>
 
<?php ob_start(); ?>
<h1><?= $title; ?></h1>
<p><a href="index.php?p=admin" class="btn btn_link">Retour à l'administration</a></p>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="index.php?p=updatePost&amp;id=<?= $post['id'] ?>" method="post">
                <p>
                    <em>Publié le <?= $post['creation_date_fr'] ?></em>
                </p>
                <?php
                    if (isset($_GET['result'])) {
                        if ($_GET['result'] === 'success') {
                            echo '<div class="alert alert-success" role="alert">
                            Ce billet a bien été mis à jour ! <a href="#">Voir l\'article</a>
                            </div>';
                        } elseif ($_GET['result'] === 'failed') {
                            echo '<div class="alert alert-danger" role="alert">
                            Impossible d\'éditer ce billet !
                            </div>';
                        }
                    }  
                ?>
                <!--<div class ="form-group">
                    <label for="date">Publié le :</label>
                    <input type="date" id="date" name="date" class="form-control" value="<?= $post['creation_date'] ?>"/>
                </div>-->
                <div class ="form-group">
                    <label for="title">Titre :</label><br />
                    <input id="title" name="title" class="form-control" value="<?= nl2br(htmlspecialchars($post['title'])) ?>"/>
                </div>
                <div class ="form-group">
                    <label for="content">Contenu du billet :</label><br />
                    <textarea id="content" name="content" class="form-control" rows="20" cols="60"><?= nl2br(htmlspecialchars($post['content'])) ?></textarea>
                </div>
                <div class ="form-group">
                    <button type="submit" class="btn btn-primary" value="Modifier"/>Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
 
<?php require('view/templates/admin.php'); ?>