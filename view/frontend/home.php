<?php $title = 'Le Blog de l\'Écrivain'; ?>

<h1><a href="home"><?= BLOGTITLE ?></a></h1>

<?php
foreach ($posts as $post): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="post_home">
                    <div class="title_post_home">
                        <h2><?= htmlspecialchars($post->getTitle()); ?></h2>
                    </div>
                    <div class="date_post_home">
                        <h4>le <?= $post->getCreationDate(); ?></h4>
                    </div>
                    <div class="excerpt_post_home">
                        <p>
                            <?= substr(nl2br(strip_tags($post->getContent())), 0, 420) . '...' ?>
                        </p>
                        <div>
                            <a href="showPost-id-<?= $post->getId(); ?>" class="btn btn_link read_more">Lire la suite</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
endforeach; ?>