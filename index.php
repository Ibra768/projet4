<?php
// Début de la session
session_start();

// Appel du controller
require('controller/frontend/controller.php');
require('controller/backend/controller.php');

// Bloc qui regroupe toutes les actions effectués, en fonction des requêtes GET & POST envoyées

try {
    
    if (isset($_GET['action'])) { 

                /*                                             Requêtes UTILISATEUR                                    */

        if ($_GET['action'] == 'post') { // Lance la fonction post() pour afficher le billet selectionné
                post($_GET['id']);
        }

        elseif ($_GET['action'] == 'addComment') { // Lance la fonction addComment() pour ajouter un commentaire

                    addComment($_GET['id'], $_POST['author'], $_POST['comment']); 

        }

        else if($_GET['action'] == 'report') { // Lance la fonction reportComment() pour signaler un commentaire
                reportComment($_GET['id'], $_GET['postid']);
        }

                        /*                                             Requêtes ADMINISTRATEUR                                    */


        else if ($_GET['action'] == 'connexion') { // Lance la fonction getAdministrator() qui connecte l'utilisateur si il est référencé comme administrateur dans la DB
            getAdministrator($_POST['pseudo'], $_POST['pass']);
        }

        else if ($_GET['action'] == 'getConnexion') { // Accès a la page de connexion
            require('view/frontend/connexion.php');
        }
        
        else if ($_GET['action'] == 'erreurConnexion') { // Erreur de connexion (login/mdp)
            require('view/frontend/connexion.php');
        }

        else if ($_GET['action'] == 'admin') { // Lance la fonction dataAdmin() qui récupérer la liste des posts, et la liste des commentaires signalés

            dataAdmin();
        }

        else if($_GET['action'] == 'addPost') { // Lance la fonction addPost() pour ajouter un nouveau billet

                addPost($_POST['title'], $_POST['content']); 
        }
        else if ($_GET['action'] == "add") {

            require('view/backend/addPost.php');
        }

        else if ($_GET['action'] == 'updatePost') { // Lance la fonction updatePost() qui selectionne le billet a modifier, et le renvoie dans un formulaire a modifier

                updatePost($_GET['id']);
            
        }

        else if($_GET['action'] == 'confirmUpdatePost') { // Lance la fonction confirmUpdatePost() qui modifie le commentaire selectionné precedemment

                confirmUpdatePost($_POST['id'], $_POST['titleUpdate'], $_POST['contentUpdate']); 
        }

        else if ($_GET['action'] == 'deletePost') { // Lance la fonction deletePost() qui supprime un billet
        
            deletePost($_GET['id']);

        }

        else if($_GET['action'] == "ignore") { // Lance la fonction allowComment() pour autoriser un commentaire signalé

                allowComment($_GET['id']);
        }
        else if($_GET['action'] == "deleteComment") { // Lance la fonction deleteComment() pour supprimer un commentaire

                deleteComment($_GET['id']);
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

