<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link <?= $link ?> /> 
    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class= "glyphicon glyphicon-home"></span> Accueil</a></li>
        <?php
        if (isset($_SESSION['pseudo']) && isset($_SESSION['pass'])) {
          ?>
          <li><a href="#"><span><i class="far fa-smile-beam"></i></span> Bonjour <?= $_SESSION['pseudo'] ?> </a></li>
          <li><a href="index.php?action=admin"><span class="glyphicon glyphicon-user"></span> Administration</a></li>
          <li><a href="index.php?action=deconnexion"><span class="glyphicon glyphicon-log-in"></span> Déconnexion</a></li>
          <?php
        }
        else{ ?>
        <li><a href="view/frontend/connexion.php"><span class="glyphicon glyphicon-user"></span> Connexion</a></li>
        <?php
        }
          ?>
      </ul>
    </div>
  </nav>

