<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
        <link href="../../public/cse/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <?php
        if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
            ?>  
            <p>Bonjour <?= $_SESSION['pseudo'] ?>, bienvenue sur votre espace d'administration.</p>

            <?= $content ?>
        <?php
        }
        else{
            ?>
            <p>Bonjour, vous n'avez pas le droit d'accéder à cette page</p>
            <?php
        }
        ?>  
    </body>
</html>