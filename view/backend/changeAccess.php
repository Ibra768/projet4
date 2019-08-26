<?php 
$title = 'Changer vos accès'; 
$meta = 'Changements des identifiants';
$body = "body_Access";
ob_start(); 
if(isset($_GET['message'])){
    ?>
    <p class='message'><?= $_GET['message'];?></p>
    <?php
}
else{
    
}
?>


<div class="flex">
    <form method="POST" action="index.php?action=changeaccess">
    <h1>Modifier mes accès</h1>
            <div class="flexForm">
                <div class="formBox">
                    <label class="labelBox">Pseudo</label>
                    <input class="inputBox" type="text" name="pseudo" value="<?= $getAccess['pseudo'] ?>" required>
                </div>
                <div class="formBox">
                    <label class="labelBox">Mot de passe actuel</label>
                    <input class="inputBox" type="password" name="pass" value="" required>
                </div>
                <div class="formBox">
                    <label class="labelBox">Nouveau mot de passe</label>
                    <input class="inputBox" type="password" name= "newPass" value="" required>
                </div>
                <div class="formBox">
                <input class="boutons" type="submit" value="Envoyer">
                </div>
            </div>
    </form>
</div>
<?php 
$content = ob_get_clean(); 
require('view/template.php'); 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="public/js/script.js"></script>