<?php 
$title = 'Erreur'; 
$meta = "Page d'erreur du site";
$body = "body_Error";
ob_start(); 
?>
<div id="message_Error"><p>Désolé, nous avons rencontrer une erreur.<br><a class="boutons" href="javascript:history.go(-1)">Retour</a></div>
<?php

$content = ob_get_clean();

require('view/template.php'); 