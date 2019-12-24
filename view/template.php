<!DOCTYPE html>
<html>
    <head>
    <title><?= $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="language" content="fr-FR" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content= <?= $meta  ?> />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:500,900|Roboto+Condensed:700|Nova+Flat|Rock+Salt|Anton|Courgette|Luckiest+Guy" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="public/js/script.js"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({ selector: '.tiny', height : 280, max_width : 700, theme_advanced_default_foreground_color: "red", plugins: 'code', toolbar: 'undo redo | fontsizeselect fontselect | bold italic'});</script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
    <body id="<?= $body  ?>">
        <nav> 
            <div id="logo">
                <a href="index.php">Billet simple pour l'Alaska</a>
            </div>
            <div id="menu">
                <a href="index.php"><span class= "glyphicon glyphicon-home"></span> Accueil</a>
                <?php
                    if (isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
                ?>
                <a href="index.php?action=passrequest"><span><i class="far fa-smile-beam"></i></span> Bonjour <?= $_SESSION['pseudo'] ?> </a>
                <a href="index.php?action=admin"><span class="glyphicon glyphicon-user"></span> Administration</a>
                <a href="index.php?action=deconnexion"><span class="glyphicon glyphicon-log-in"></span> Déconnexion</a>
                <?php
                    }   
                    else{ 
                ?>
                <a href="index.php?action=getConnexion"><span class="glyphicon glyphicon-user"></span> Accès Administration</a>
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