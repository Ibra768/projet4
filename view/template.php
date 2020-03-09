<!DOCTYPE html>
<html>
    <head>
    <title><?= $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="language" content="fr-FR" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content= <?= $description  ?> />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:500,900|Roboto+Condensed:700|Nova+Flat|Rock+Salt|Anton|Courgette|Luckiest+Guy" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet"/>
    <script type="text/javascript" src="public/js/jquery.min.js"></script> 
    <script type="text/javascript" src="public/tinymce/plugin/tinymce.min.js"></script>
    <script type="text/javascript" src="public/js/script.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
    <body id="<?= $body  ?>">
        <nav> 
            <div id="logo">
                <a href="index.php">Billet simple pour l'Alaska</a>
            </div>
            <div id="menu">
                <a href="index.php"><span><i class="fas fa-home"></i></span> Accueil</a>
                <?php
                    if (isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
                ?>
                <a href="index.php?action=passrequest"><span><i class="far fa-smile-beam"></i></span> Bonjour <?= $_SESSION['pseudo'] ?> </a>
                <a href="index.php?action=admin"><span><i class="far fa-user"></i></span> Administration</a>
                <a href="index.php?action=deconnexion"><span><i class="fas fa-sign-out-alt"></i></span> Déconnexion</a>
                <?php
                    }   
                    else{ 
                ?>
                <a href="index.php?action=getConnexion"><span><i class="fas fa-sign-in-alt"></i></span> Accès Administration</a>
                <?php
                    }
                ?>
            </div>
        </nav>
        <div class="message">
            <?php
                if (isset($_GET['message'])){
                    echo $_GET['message'];
                }
            ?>
        </div>
        <?= $content ?>
    </body>
</html>