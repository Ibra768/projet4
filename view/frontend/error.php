<?php 
$title = 'Erreur'; 
$meta = "Page d'erreur du site";
$body = "body_Error";
ob_start(); 
?>
<div class="flexbox_Center">
    <div>
        <p id="message_Error"></p><br><a class="boutons" href="javascript:history.go(-1)">Retour</a>
    </div>
</div>
<?php

$content = ob_get_clean();

require('view/template.php'); 