<?php require('controller/frontend.php');   ?>

<form action="connexion.php" method="post">
<label>Votre pseudo<input type="text" name="pseudo" /></label>
<label>Votre mot de Passe<input type="text" name="pass" /></label>
<input type="submit" value="Valider" />

<?php

 if (isset($_POST['pseudo']) && isset($_POST['pass'])) {
        getAdministrator();
}

if (isset($_GET['erreur'])) {
    echo 'Votre pseudo et' . '/' . 'ou votre mot de passe sont incorrect.';
}
