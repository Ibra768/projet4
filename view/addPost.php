<?php
// Si pas de session ouverte
if (isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
    echo "Vous n'avez pas le droit d'accéder à cette page.";
}
else {

    ?>

    <h1>Ajouter un billet</h1>

    <form method="POST" action="../index.php?action=addPost">
    <label>Titre du billet<input type="text" name="title"></label>
    <label>Contenu<input type="textarea" name="content"></label>
    <input type="submit" value="Envoyer le billet">

    <?php

}

?>