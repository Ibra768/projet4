<?php


session_start();

// Si session ouverte ..
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
?>
<a href="index.php?action=deconnexion">Deconnexion</a>
<?php
?>
<p>Bonjour <?php echo $_SESSION['pseudo']; ?>, bienvenue sur votre espace d'administration.</p>

<form method="POST" action="index.php?action=addPost">
<label>Titre du billet<input type="text" name="title"></label>
<label>Contenu<input type="textarea" name="content"></label>
<input type="submit" value="Envoyer le billet">
<?php 

}


// Si pas de session ouverte
else {
    echo "Vous n'avez pas le droit d'accéder à cette page.";
}
?>

