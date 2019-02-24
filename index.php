<?php
// Début de la session
session_start();
// Appel du controller
require('controller/frontend/controller.php');
require('controller/backend/controller.php');
// Bloc qui regroupe toutes les actions effectués, en fonction des requêtes GET & POST envoyées
try {
    if (isset($_GET['action'])) {
        switch($_GET['action']) {
            case 'post' :
                post(htmlspecialchars($_GET['id']));
                break;
            case 'addComment' :
                addComment(htmlspecialchars($_GET['id']), htmlspecialchars($_POST['author']), htmlspecialchars($_POST['comment'])); 
                break;
            case 'report' :
                reportComment(htmlspecialchars($_GET['id']), htmlspecialchars($_GET['postid']));
                break;
            case 'connexion' :
                getAdministrator(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['pass']));
                break;
            case 'getConnexion' :
                require('view/frontend/connexion.php');
                break;
            case 'erreurConnexion' :
                require('view/frontend/connexion.php');
                break;
            case 'admin' :
                dataAdmin();
                break;
            case 'addPost' :
                addPost(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['content'])); 
                break;
            case 'add' :
                require('view/backend/addPost.php');
                break;
            case 'updatePost' :
                updatePost(htmlspecialchars($_GET['id']));
                break;
            case 'confirmUpdatePost' :
                confirmUpdatePost(htmlspecialchars($_POST['id']), htmlspecialchars($_POST['titleUpdate']), strip_tags($_POST['contentUpdate']));
                break;
            case 'deletePost' :
                deletePost(htmlspecialchars($_GET['id']));
                break;
            case 'ignore' :
                allowComment(htmlspecialchars($_GET['id']));
                break;
            case 'deleteComment' :
                deleteComment(htmlspecialchars($_GET['id']));
                break;
            case 'deleteCommentAdmin' :
                deleteCommentAdmin(htmlspecialchars($_GET['id']),htmlspecialchars($_GET['postid']));
                break;
            case 'deconnexion' : 
                disconnect();
                break;
            case 'updatePost' :
                dataAdmin();
                break;
        }
    }
    else{
        listPostsHome();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}