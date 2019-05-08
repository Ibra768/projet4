<?php 
$title = 'Modifier un billet'; 
$meta = 'Modifications de billet';
$body = "body_Modif";
ob_start(); 
?>

<h1>Modifier un billet</h1>

<div class="container form">
    <form method="POST" action="index.php?action=confirmUpdatePost" enctype="multipart/form-data">
        <div class="row">
            <div class="col-25">
                <label for="title">Titre du billet</label>
            </div>
            <div class="col-75">
                <input type="text" name="title"  value="<?= htmlspecialchars($postUp['title']) ?>" required><br>
                <input type="file" id="avatar" name="avatar" required><br>  
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="content">Contenu</label>
            </div>
            <div class="col-75">
            <textarea  type="text"  class="tiny" name="content"><?= html_entity_decode($postUp['content']) ?></textarea><br>
            <input type="submit" class="boutons" value="Envoyer">
            <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'])?>">
            </div>
        </div>
    </form>
</div>

<?php 
$content = ob_get_clean(); 
require('view/template.php'); 
?>
