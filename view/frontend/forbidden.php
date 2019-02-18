<?php
session_start();
if(isset($_SESSION['pseudo']) &&  isset($_SESSION['pass'])){
    header('location:index.php?action=admin');
}
else {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PDle/QlgIONtM1aqA2Qemk5gPOE7wFq8+Em+G/hmo5Iq0CCmYZLv3fVRDJ4MMwEA" crossorigin="anonymous">
        <style> body{
            background-image: url("../../public/images/forbidden.jpeg");
        }
        </style>
    </head>
        
    <body>

        
        <p> Vous n'avez pas le droit d'accéder à cette page. </p>
        <a href="javascript:history.go(-1)">Retour</a>
    </body>

</html>

<?php
}

