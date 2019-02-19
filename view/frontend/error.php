<?php 
$title = 'Connexion'; 
$meta = "Connection à l'espace ADMIN du site de Jean Forteroche";
$body = "body_Admin";
ob_start(); 


$content = ob_get_clean();

 require('view/template.php'); 