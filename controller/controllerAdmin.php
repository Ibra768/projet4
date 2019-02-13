<?php

require_once('../model/CommentManager.php');
require_once('../model/AdminManager.php');
require_once('../model/PostManager.php');

function getAdministrator() {


$pseudo = $_POST['pseudo']; 
$checkAdmin = new \Model\AdminManager();
$resultat = $checkAdmin->getAdmin($pseudo);
var_dump($resultat);

$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

if (!$resultat)
{
    header('Location: connexion.php?erreur');
}
else
{
    if ($isPasswordCorrect) {
        session_start();
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['pass'] = $_POST['pass'];
        header('Location: admin.php');
    }
    else {
        header('Location: connexion.php?erreur');
    }
}
}