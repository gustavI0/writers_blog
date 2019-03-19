<?php $title = 'Editer un commentaire'; ?>
 
<?php ob_start(); ?>
<h1>Le blog de l'écrivain</h1>

<h2>Ajouter un billet</h2>

<div class="container">
    <form action="index.php?p=newPost" method="post">
        <div class ="form-group">
            <label for="title">Titre :</label><br />
            <input id="title" name="title" class="form-control"/>
        </div>
        <div class ="form-group">
            <label for="content">Contenu du billet :</label><br />
            <textarea id="content" name="content" class="form-control" rows="20" cols="60"></textarea>
        </div>
        <div class ="form-group">
            <button type="submit" class="btn btn_basic" value="Ajouter" />Ajouter</button>
        </div>
    </form>

<?php $content = ob_get_clean(); ?>
 
<?php require('view/templates/admin.php'); ?>