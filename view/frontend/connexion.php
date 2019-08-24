<?php 
$title = 'Connexion'; 
$meta = "Connexion à l'espace ADMIN du site de Jean Forteroche";
$body = "body_Connexion";
ob_start(); 

if ($_GET['action'] == 'erreurConnexion') {
        echo  '<div class="message">' . 'Votre pseudo et' . '/' . 'ou votre mot de passe sont incorrect.' . '</div>';
}
?>  
    <div class="flexbox_Center">
        <div>
            <form method="POST" action="index.php?action=connexion">
                <div class="row">
                    <div class="col-25">
                        <label for="pseudo">Votre Pseudo</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="pseudo" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="pass">Votre mot de passe</label>
                    </div>
                    <div class="col-75">
                        <input type="password" name="pass" required><br>
                        <input type="submit" class="boutons" value="Connexion">
                        <a href="index.php?action=forgotpassword">Mot de passe oublié ?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php 
$content = ob_get_clean(); 
require('view/template.php');
?>