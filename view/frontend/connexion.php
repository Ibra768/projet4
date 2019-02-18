<?php 
$title = 'Connexion'; 
$meta = "Connection à l'espace ADMIN du site de Jean Forteroche";
$body = "body_connexion";
?>

<?php ob_start(); ?>

<?php
                if ($_GET['action'] == 'erreurConnexion') {
                    echo  '<div class="message">' . 'Votre pseudo et' . '/' . 'ou votre mot de passe sont incorrect.' . '</div>';
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