<?php 
$title = 'Modifier un billet'; 
$meta = 'Modifications de billet';
$body = "body_Admin";
ob_start(); 
?>

<h1>Modifier un billet</h1>

<div class="flexbox_Admin">
    <div class="formulaire_Admin">
        <form method="POST" action="index.php?action=confirmUpdatePost">
        <label for="titleUpdate">Titre du billet</label><br><input type="text" name="titleUpdate" value="<?= htmlspecialchars($postUp['title']) ?>" required><br>
        <label for="contentUpdate">Contenu</label><br><textarea class="tiny" rows="17" cols="75" name="contentUpdate" value="<?= htmlspecialchars($postUp['content']) ?>"></textarea><br>
        <input type="hidden" name="id" value="<?= $_GET['id']?>">
        <input type="submit" class="boutons" value="Modifier le billet">
    </div>
</div>

<?php 
$content = ob_get_clean(); 
require('view/template.php'); 
?>
