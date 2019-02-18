<?php 
$title = 'Connexion'; 
?>

<?php ob_start(); ?>

<?php
    if (isset($_GET['erreur'])) {
                echo '<p id="erreurConnexion>' . 'Votre pseudo et' . '/' . 'ou votre mot de passe sont incorrect.' . '</p>';
    }
?>

        <div id="flexbox_Connexion">
            <div id="formulaire_Connexion">
                <form action="index.php?action=connexion" method="post">
                <label for="pseudo">Votre pseudo</label><br><input type="text" name="pseudo" /><br>
                <label for="pass">Votre mot de passe</label><br><input type="password" name="pass" />
                <input type="submit" class="boutons" value="Valider" />
                <form>
            </div>
        </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>