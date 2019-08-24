<?php 
$title = 'Oubli de mot de passe'; 
$meta = 'Demande de récupération de mot de passe';
$body = "";
ob_start(); 
if(isset($_GET['message'])){
    ?>
    <p class='message'><?= $_GET['message'];?></p>
    <?php
}
else if(isset($_GET['status']) && $_GET['status'] == "ok"){
    ?>
    <p class='message'>Le mot de passe a bien été envoyé.</p>
    <?php
}
else{

}
?>

<form method="POST" action="index.php?action=sendPassword">
<label>Votre pseudo<input type="text" name="pseudo"></label><input type="submit" value="Envoyer">











<?php 
$content = ob_get_clean(); 
require('view/template.php'); 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="public/js/script.js"></script>