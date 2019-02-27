<?php

?>
<!DOCTYPE html>
<html>
    <head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="language" content="fr-FR" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content= <?= $meta  ?> />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:500,900|Roboto+Condensed:700|Nova+Flat" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="public/js/script.js"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({ selector: '.tiny', height : 320, max_width : 700, theme_advanced_default_foreground_color: "red"});</script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
    <body id="<?= $body  ?>">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Billet simple pour l'Alaska</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php"><span class= "glyphicon glyphicon-home"></span> Accueil</a></li>
                    <?php
                        if (isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
                    ?>
                    <li><a href="#"><span><i class="far fa-smile-beam"></i></span> Bonjour <?= $_SESSION['pseudo'] ?> </a></li>
                    <li><a href="index.php?action=admin"><span class="glyphicon glyphicon-user"></span> Administration</a></li>
                    <li><a href="index.php?action=deconnexion"><span class="glyphicon glyphicon-log-in"></span> Déconnexion</a></li>
                    <?php
                        }   
                        else{ 
                        ?>
                    <li><a href="index.php?action=getConnexion"><span class="glyphicon glyphicon-user"></span> Connexion</a></li>
                        <?php
                        }
                        ?>
                </ul>
            </div>
        </nav>
        <?= $content ?>
        <!-- Footer -->
        <footer class="page-footer font-small cyan darken-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 py-5">
                    <p><i class="far fa-copyright"></i> Jean Forteroche</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row-->
            </div>
        </footer>
        <!-- Footer -->
    </body>
</html>

