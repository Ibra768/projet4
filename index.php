<?php
// Début de la session
session_start();

// Appel du controller
require('controller/controller.php');

// Bloc qui regroupe toutes les actions effectués, en fonction des requêtes GET & POST envoyées

try {
    
    if (isset($_GET['action'])) { 


                /*                                             Requêtes UTILISATEUR                                    */

        if ($_GET['action'] == 'post') { // Lance la fonction post() pour afficher le billet selectionné

            if (isset($_GET['id']) && $_GET['id'] > 0) {  
                post($_GET['id']);
            }

            else {
                header('Location : error.php');
            }
        }

        elseif ($_GET['action'] == 'addComment') { // Lance la fonction addComment() pour ajouter un commentaire

            if (isset($_GET['id']) && $_GET['id'] > 0) { 

                if (!empty($_POST['author']) && !empty($_POST['comment'])) { 
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']); 
                }

                else {
                    header('Location : error.php');
                }
            }

            else {
                header('Location : error.php');
            }

        }

        else if($_GET['action'] == 'report') { // Lance la fonction reportComment() pour signaler un commentaire

            if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postid']) && $_GET['postid'] > 0) {
                reportComment($_GET['id'], $_GET['postid']);
            }
            else{
                header('Location : error.php');
            }
        }

                        /*                                             Requêtes ADMINISTRATEUR                                    */


        else if ($_GET['action'] == 'connexion' && !empty($_POST['pseudo']) && !empty($_POST['pass']) ) { // Lance la fonction getAdministrator() qui connecte l'utilisateur si il est référencé comme administrateur dans la DB
            getAdministrator($_POST['pseudo'], $_POST['pass']);
        }
        else if ($_GET['action'] == 'getConnexion') { // Accès a la page de connexion
            require('view/frontend/connexion.php');
        }

        else if ($_GET['action'] == 'admin') { // Lance la fonction dataAdmin() qui récupérer la liste des posts, et la liste des commentaires signalés

            dataAdmin();
        }

        else if($_GET['action'] == 'addPost') { // Lance la fonction addPost() pour ajouter un nouveau billet

            if (!empty($_POST['title']) && !empty($_POST['content'])) { 
                addPost($_POST['title'], $_POST['content']); 
            }

            else {
               header("location: index.php");
            }
        }

        else if ($_GET['action'] == 'updatePost') { // Lance la fonction updatePost() qui selectionne le billet a modifier, et le renvoie dans un formulaire a modifier

            if (isset($_GET['id']) && $_GET['id'] > 0) {
        
                updatePost($_GET['id']);
            
            }
            else{

                header('Location : index.php');

            }
        }

        else if($_GET['action'] == 'confirmUpdatePost') { // Lance la fonction confirmUpdatePost() qui modifie le commentaire selectionné precedemment

            if(isset($_POST['id']) && $_POST["id"] > 0) {

                if (!empty($_POST['titleUpdate']) && !empty($_POST['contentUpdate'])) {
                    confirmUpdatePost($_POST['id'], $_POST['titleUpdate'], $_POST['contentUpdate']); 
                }
                else {
                    header('Location : error.php');
                }
            }
            else {
                header('Location : error.php');
            }
        }

        else if ($_GET['action'] == 'deletePost') { // Lance la fonction deletePost() qui supprime un billet

            if (isset($_GET['id']) && $_GET['id'] > 0) { 
        
            deletePost($_GET['id']);
            
            }
            else{

                header('Location : error.php');

            }
        }

        else if($_GET['action'] == "ignore") { // Lance la fonction allowComment() pour autoriser un commentaire signalé

            if(isset($_GET['id']) && $_GET['id'] > 0) {
                allowComment($_GET['id']);
            }
            else {
                header('Location : error.php');
            }
        }

        else if($_GET['action'] == "deleteComment") { // Lance la fonction deleteComment() pour supprimer un commentaire

            if(isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            }
            else {
                header('Location : error.php');
            }
        }

        else if (isset($_GET['action']) == 'deconnexion') { // Lance la fonctionne disconnect() qui déconnecte l'administrateur
            disconnect();
        }

        else if ($_GET['action'] == 'updatePost') {
        
            dataAdmin();

        }
    }
    else {
        listPostsHome(); // Sinon on lance la fonction listPostsHome() qui affiche les derniers billets
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

