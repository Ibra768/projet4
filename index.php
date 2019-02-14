<?php
// Début de la session
session_start();

// Appel du controller
require('controller/controller.php');


try {
    
    if (isset($_GET['action'])) { // Si ?action

        if ($_GET['action'] == 'listPosts') { // Si ?action=listPosts
            listPosts();
        }

        else if ($_GET['action'] == 'post') { // Si ?action=post

            if (isset($_GET['id']) && $_GET['id'] > 0) {  // Si ?action=post&id>0
                post();
            }

            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'addComment') { // Si ?action=addComment

            if (isset($_GET['id']) && $_GET['id'] > 0) { // Si ?action=addComment&id>0

                if (!empty($_POST['author']) && !empty($_POST['comment'])) { // Si ?action=addComment&id>0 et lles valeurs $POST ne sont pas vides
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']); 
                }

                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }

            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        }
        else if($_GET['action'] == 'addPost') {

            if (!empty($_POST['title']) && !empty($_POST['content'])) { // Si ?action=addPost&id>0 et lles valeurs $POST ne sont pas vides
                addPost($_POST['title'], $_POST['content']); 
            }

            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        else if (isset($_GET['action']) == 'deconnexion') { // Si ?action=deconnexion
            disconnect();
        }

    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

