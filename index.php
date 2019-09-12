<?php
// Début de la session
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
ini_set('display_errors','on');
error_reporting(E_ALL);
// Appel du controller
require_once('controller/frontend/controller.php');
require_once('controller/backend/controller.php');
// Bloc qui regroupe toutes les actions effectués, en fonction des requêtes GET & POST envoyées

if (isset($_GET['action'])) {
    switch($_GET['action']) {

        case 'post' :
            post(htmlspecialchars($_GET['id']));
            break;
        case 'error' :
            error();
            break;
        case 'addComment' : // Ajout commentaire
            addComment(htmlspecialchars($_GET['id']), htmlspecialchars($_POST['author']), htmlspecialchars($_POST['comment'])); 
            break;
        case 'report' : // Signalement commentaire
            reportComment(htmlspecialchars($_GET['id']), htmlspecialchars($_GET['postid']));
            break;
        case 'connexion' : // Connexion
            if(isset($_POST['pseudo']) && isset($_POST['pass'])){
                getAdministrator(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['pass']));
            }
            else{
                listPostsHome();
            }
            break;
        case 'getConnexion' : // Accès page connexion
            getConnexion();
            break;
        case 'erreurConnexion' : // Erreur de connexion
            getConnexion();
            break;

        case 'admin' : // Accès admin post
            if(isset($_GET["page"]) AND !empty($_GET["page"]) AND $_GET["page"] > 0) {
                $_GET["page"] = intval($_GET["page"]);
                $pageCourante = htmlspecialchars($_GET["page"]);
                dataAdmin($pageCourante);
            } else{
                $pageCourante = 1;
                dataAdmin($pageCourante);
            }
            break;

        case 'adminreport' : // Accès admin commentaires signalés
            if(isset($_GET["pageComment"]) AND !empty($_GET["pageComment"]) AND $_GET["pageComment"] > 0) {
                $_GET["pageComment"] = intval($_GET["pageComment"]);
                $pageCouranteComments = htmlspecialchars($_GET["pageComment"]);
                adminCommentReport($pageCouranteComments);
            } else{
                $pageCouranteComments = 1;
                adminCommentReport($pageCouranteComments);
            }
            break;
        case 'addPost' : // lancement ajout
            addPost($_FILES,htmlspecialchars($_POST['title']),htmlspecialchars($_POST['content']),htmlspecialchars($_SESSION['pseudo']));
            break;
        case 'add' : // accès à la page d'ajout de post
            getAddPage();
            break;
        case 'updatePost' : // accès a la page de modification de post
            updatePost(htmlspecialchars($_GET['id']));
            break;
        case 'confirmUpdatePost' : // modification du post
            $_POST = array_map('htmlspecialchars', $_POST);
            $_SESSION = array_map('htmlspecialchars', $_SESSION);
            confirmUpdatePost($_FILES,$_POST,$_SESSION);
            break;
        case 'deletePost' : // Suppression de post
            deletePost(htmlspecialchars($_GET['id']));
            break;
        case 'ignore' : // Autorisation commentaire
            allowComment(htmlspecialchars($_GET['id']));
            break;
        case 'deleteComment' : // Suppression commentaire dans la partie admin
            deleteComment(htmlspecialchars($_GET['id']));
            break;
        case 'deleteCommentAdmin' : // Suppression du commentaire dans le post directement
            deleteCommentAdmin(htmlspecialchars($_GET['commentid']),htmlspecialchars($_GET['postid']));
            break;
        case 'forbidden' : // Deconnexion
            forbidden();
            break;
        case 'deconnexion' : // Deconnexion
            disconnect();
            break;
        case 'passrequest' : // accès page changement mot de passe
            passRequest();
            break;
        case 'changeaccess' : // accès page changement mot de passe
        changeAccess(htmlspecialchars($_POST['pseudo']),htmlspecialchars($_POST['pass']),htmlspecialchars($_POST['newPass']));
            break;
        case 'forgotpassword' : // accès page changement mot de passe
        getForgotPassword();
            break;
        case 'sendPassword' : // accès page changement mot de passe
        sendPassword($_POST['pseudo']);
            break;
        default :
        listPostsHome();
    }
}
else{
    listPostsHome(); // Sinon on redirige vers la page d'accueil
}