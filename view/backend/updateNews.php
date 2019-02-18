<?php 
$title = 'Ajouter une news'; 
?>


<?php ob_start(); ?>



    <h1>Modifier un billet</h1>

    <form method="POST" action="index.php?action=confirmUpdatePost">
    <label>Titre du billet<input type="text" name="titleUpdate" value="<?= htmlspecialchars($postUp['title']) ?>" required></label>
    <label>Contenu<input type="textarea" name="contentUpdate" value="<?= htmlspecialchars($postUp['content']) ?>" required></label>
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <input type="submit" value="Envoyer le billet">

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>
