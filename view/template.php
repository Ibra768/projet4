<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
    <?php
    if(isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
    echo "Bonjour" . $_SESSION['pseudo'];
    ?>
    <a href="index.php?action=deconnexion">Deconnexion</a>
    <?php
}
else {
    ?>
    
    <a href='connexion.php'>Connexion</a>
    <?php
}
?>

        <?= $content ?>
    </body>
</html>