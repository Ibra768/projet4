<?php 
    $title = 'Changer vos accès'; 
    $meta = 'Changements des identifiants';
    $body = "body_Access";
    ob_start(); 
?>

<div class="flex">
    <form method="POST" action="index.php?action=changeaccess">
        <h1>Modifier mes accès</h1>
        <div class="flexForm">
            <div class="formBox">
                <label class="labelBox">Pseudo</label>
                <input class="inputBox" pattern=".{6,12}" title="Entre 6 et 12 caractères requis" type="text" name="pseudo" value="<?= $getAccess['pseudo'] ?>" required>
            </div>
            <div id="checkBox">
                <label>Changer le mot de passe?</label><br>
                <input type="checkbox" name="changePass" id="changePass">
            </div>
            <div class="formBox blocPass">
                <label class="labelBox">Mot de passe actuel</label>
                <input class="inputBox pass" type="password" name="pass">
            </div>
            <div class="formBox blocPass">
                <label class="labelBox">Nouveau mot de passe</label>
                <input class="inputBox pass" pattern=".{8,30}" title="Entre 8 et 30 caractères requis" type="password" id="newPass" name="newPass">
            </div>
            <div class="formBox">
                <input class="boutons" type="submit" value="Envoyer">
            </div>
        </div>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="public/js/script.js"></script>
<?php 
    $content = ob_get_clean(); 
    require('view/template.php'); 
?>
