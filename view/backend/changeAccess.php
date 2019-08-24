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

<h1>Modifier mes accès</h1>
<form method="POST" action="index.php?action=changeaccess">
    <label>Pseudo<input type="text" name="pseudo" value="<?= $getAccess['pseudo'] ?>" required></label><Br>
    <label>Mot de passe actuel<input type="password" name="pass" value="" required></label><br>
    <label>Nouveau mot de passe<input type="password" name= "newPass" value="" required></label><br>
    <input type="submit" value="Envoyer">

</form>
<?php 
$content = ob_get_clean(); 
require('view/template.php'); 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="public/js/script.js"></script>