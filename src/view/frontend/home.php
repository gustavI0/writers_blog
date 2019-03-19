<?php $title = 'Le blog de l\'écrivain'; ?>

<?php ob_start(); ?>
<h1><a href="index.php"><?= $title; ?></a></h1>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="post_home">
                    <div class="title_post_home">
                        <h2><?= htmlspecialchars($data['title']) ?></h2>
                    </div>
                    <div class="date_post_home">
                        <p><em>le <?= $data['creation_date_fr'] ?></em></p>
                    </div>
                    <div class="excerpt_post_home">
                        <p>
                            <?= substr(nl2br(strip_tags($data['content'])), 0, 400) . '...' ?>
                        </p>
                        <div>
                            <a href="index.php?p=showPost&amp;id=<?= $data['id'] ?>" class="btn btn_link read_more">Lire la suite</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/templates/default.php'); ?>