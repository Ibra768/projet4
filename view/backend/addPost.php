<?php 
$title = "Ajouter un billet"; 
$meta = 'Ajout de billet sur le site';
$body = "body_Admin";
ob_start(); 
?>

<h1>Ajouter un billet</h1>

<div class="flexbox_Admin">
    <div class="formulaire_Admin">
        <form method="POST" action="index.php?action=addPost">
        <label for="title">Titre du billet</label><br><input type="text" name="title" required><br>
        <label for="content">Contenu</label><br><textarea class="tiny" type="text" rows="17" cols="75" name="content"></textarea><br>
        <input type="submit" class="boutons" value="Envoyer le billet">
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>