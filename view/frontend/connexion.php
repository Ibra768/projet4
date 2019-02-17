<?php
    if (isset($_GET['erreur'])) {
                echo 'Votre pseudo et' . '/' . 'ou votre mot de passe sont incorrect.';
    }
?>

<form action="../../index.php?action=connexion" method="post">
<label>Votre pseudo<input type="text" name="pseudo" /></label>
<label>Votre mot de Passe<input type="text" name="pass" /></label>
<input type="submit" value="Valider" />

