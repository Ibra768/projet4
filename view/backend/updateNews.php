<?php 
$title = 'Modifier un billet'; 
$meta = 'Modifications de billet';
$body = "body_Modif";
ob_start(); 
?>

<h1>Modifier un billet</h1>

    <form method="POST" action="index.php?action=confirmUpdatePost" enctype="multipart/form-data">
                <label for="title">Titre du billet</label><br>
                <input type="text" name="title"  value="<?= htmlspecialchars($postUp['title']) ?>" required><br>
                <input type="file" id="avatar" name="avatar" required><br>  
                <label for="content">Contenu</label>
            <textarea  type="text"  class="tiny" name="content"><?= html_entity_decode($postUp['content']) ?></textarea><br>
            <input type="submit" class="boutons" value="Envoyer">
            <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'])?>">
    </form>

<?php 
$content = ob_get_clean(); 
require('view/template.php'); 
?>
