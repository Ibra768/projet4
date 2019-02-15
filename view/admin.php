<?php
session_start();
// Si session ouverte ..
if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
?>  
<a href="../index.php?action=deconnexion">Deconnexion</a>
<?php
?>
<p>Bonjour <?php echo $_SESSION['pseudo']; ?>, bienvenue sur votre espace d'administration.</p>

<a href="addPost.php">Ajouter</a>
<a href="../index.php?action=delete">Supprimer</a>
<?php
}

// Si pas de session ouverte
else {
    echo "Vous n'avez pas le droit d'accéder à cette page.";
}
?>

