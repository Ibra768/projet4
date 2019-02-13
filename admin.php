<?php
session_start();
?>
<a href="index.php?deconnexion">Deconnexion</a>
<?php
?>
<p>Bonjour <?php echo $_SESSION['pseudo']; ?>, bienvenue sur votre espace d'administration.</p>

