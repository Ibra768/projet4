<?php

require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');
require_once('model/MyException.php');

function listPostsHome() // Fonction qui récupère toutes les news
{
    $postManager = new \Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}
function post($postid) // Fonction qui récupère 1 news et les commentaires associés
{
    try{

        if (isset($postid) && ((int)$postid)) {  

            $getAllPosts = new \Model\PostManager();
            $posts = $getAllPosts->getPosts();

            for($i = 0 ; $i < count($posts) ; $i++){
                $tableau[] = $posts[$i]['id']; 
            }
            if (!in_array($postid, $tableau)) {
                throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$postid . "</span>" . " n'existe pas.");
            }
            else{

                $postManager = new \Model\PostManager();
                $commentManager = new \Model\CommentManager();

                $post = $postManager->getPost($postid);
                $comments = $commentManager->getComments($postid);

                if(empty($post['content'])) {
                    throw new Exception('Désolé, une erreur a été rencontré. Veuillez réessayer..');
                }
                else{
                    require('view/frontend/postView.php');
                }
            }
        }
        else{
            throw new Exception("Aucun post n'a été sélectionné.");
        }
    }
    catch(Exception $e){
        header('Location: index.php?action=error&message='.$e->getMessage());

    }
}
function reportComment($idReport, $postidReport) // Fonction qui permet de signaler un commentaire
{
    try{

        if(isset($postidReport) && ((int)$postidReport)) {

            $getAllPosts = new \Model\PostManager();
            $posts = $getAllPosts->getPosts();

            for($i = 0 ; $i < count($posts) ; $i++){
                $tableau[] = $posts[$i]['id']; 
            }
            if (!in_array($postidReport, $tableau)) {
                throw new Exception("Désolé, le post n° " . "<span class='cible_Erreur'>" .$postidReport . "</span>" . " n'existe pas.");
            }
            else{
                if(isset($idReport) && ((int)$idReport)) {

                    $getAllComments = new \Model\CommentManager();
                    $getComments = $getAllComments->getAllComments();

                    for($i = 0 ; $i < count($getComments) ; $i++){
                        $tableau[] = $getComments[$i]['id']; 
                    }
                    if (!in_array($idReport, $tableau)) {
                        throw new Exception("Désolé, le commentaire n° " . "<span class='cible_Erreur'>" .$idReport . "</span>" . " n'existe pas.");
                    }
                    else{

                        $report = new \Model\CommentManager();

                        $reporting = $report->reportCommentDB($idReport);

                        if ($reporting === false) {
                            throw new Exception('Désolé, une erreur a été rencontré. Veuillez réessayer..');
                        }
                        else{
                            header('Location: index.php?action=post&id=' . $postidReport . '&message=Merci pour votre signalement, on s\'en occupe');
                        }
                    }
                }
                else{
                    throw new Exception('Désolé, une erreur a été rencontré. Veuillez réessayer.');
                }
            }
        }
        else{
            throw new Exception('Désolé, une erreur a été rencontré. Veuillez réessayer.');
        }
    }
    catch (Exception $e){
        header('Location: index.php?action=error&message='.$e->getMessage());
    }

}
function addComment($postId, $author, $comment) // Fonction qui permet d'ajouter un commentaire
{
    try{
        if (isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['author']) && !empty($_POST['comment'])) { 

            $addComments = new \Model\CommentManager();

            $affectedLines = $addComments->postComment($postId, $author, $comment);

            if ($affectedLines === false) {
                throw new Exception('Désolé ' . "<span class='cible_Erreur'>" . $author . "</span>" . ", une erreur a été rencontré. Réessayez plus tard.");
            }
            else {
                header('Location: index.php?action=post&add=' . $author . '&id=' . $postId);
            }
        }else{
            throw new Exception('Désolé ' . "<span class='cible_Erreur'>" . $author . "</span>" . ", une erreur a été rencontré. Réessayez plus tard.");
        }
    }
    catch (Exception $e){
        header('Location: index.php?action=post&add=' . $author . '&id=' . $postId . "&message=".$e->getMessage());
    }
}
function getAdministrator($pseudo, $mdp) { // Fonction qui permet de savoir si l'utilisateur est administrateur lors de la connexion

    if(!empty($_POST['pseudo']) && !empty($_POST['pass'])) {

        $checkAdmin = new \Model\AdminManager();
        $resultat = $checkAdmin->getAdmin($pseudo);
        
        $isPasswordCorrect = password_verify($mdp, $resultat['pass']);

        
        if (!$resultat)
        {
            header('Location: index.php?action=erreurConnexion');
        }
        else
        {
            if ($isPasswordCorrect) {
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['pass'] = $mdp;    
                header('Location: index.php?action=admin');  
            }
            else {
                header('Location: index.php?action=erreurConnexion');
            }
        }
    }
}
function getConnexion() {
    require('view/frontend/connexion.php');
}
function getForgotPassword() {
    require('view/frontend/forgotPassword.php');
}
function sendPassword($pseudo) {
    try{

        $getPass = new \Model\AdminManager();
        $resultat = $getPass->getAdmin($pseudo);

        if($resultat){
            $message = "<p>" . "Bonjour," . "</p>" . "<br>" . "<p>" . "Suite à votre demande, voici votre mot de passe : " . "</p>" . "<br>" . "<strong>" . $resultat['pass'] . "</strong>";
            mail($resultat['mail'], 'Votre mot de passe', $message);
            header('Location: index.php?action=forgotpassword&status=ok');
        }
        else{
            throw new Exception("Pas de compte retrouvé pour l'utilisateur " . "<span class='cible_Erreur'>" . $pseudo . "</span>");
        }
    }
    catch (Exception $e){
        header('Location: index.php?action=forgotpassword&message='.$e->getMessage());
    }
}
function forbidden() {
    require('view/frontend/forbidden.php');
}