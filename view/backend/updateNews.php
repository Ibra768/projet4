<?php
// Si pas de session ouverte
if (!isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
    echo "Vous n'avez pas le droit d'accéder à cette page.";
}
else {

    ?>

    <h1>Modifier un billet</h1>

    <form method="POST" action="index.php?action=confirmUpdatePost">
    <label>Titre du billet<input type="text" name="titleUpdate" value="<?= htmlspecialchars($postUp['title']) ?>"></label>
    <label>Contenu<input type="textarea" name="contentUpdate" value="<?= htmlspecialchars($postUp['content']) ?>"></label>
    <input type="hidden" name="id" value="<?= $_GET['id']?>">
    <input type="submit" value="Envoyer le billet">

    <?php

}

?>