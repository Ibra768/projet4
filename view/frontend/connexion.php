<?php 
    $title = 'Billet Simple pour l\'Alaska - Connexion à l\'espace administrateur'; 
    $description = "Cet espace vous permet de renseigner votre identifiant et votre mot de passe afin de vous connecter à votre espace administrateur.";
    $body = "body_Connexion";
    ob_start(); 
?>  
<div class="flexbox_Center">
    <form method="POST" action="index.php?action=connexion">
                <label for="pseudo">Votre Pseudo</label><br>
                <input type="text" name="pseudo" width="150" height="150" required><br>
                <label for="pass">Votre mot de passe</label><br>
                <input type="password" name="pass" required><br>
                <input type="submit" class="boutons" value="Connexion">
                <a href="index.php?action=forgotpassword">Mot de passe oublié ?</a>
            </div>
    </form>
</div>

<?php 
    $content = ob_get_clean(); 
    require('view/template.php');
?>