<?php $title = "Ajouter un billet"; ?>

<?php ob_start(); ?>

<h1>Ajouter un billet</h1>

<form method="POST" action="../../index.php?action=addPost">
<label>Titre du billet<input type="text" name="title" required></label>
<label>Contenu<input type="textarea" name="content" required></label>
<input type="submit" value="Envoyer le billet">

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>