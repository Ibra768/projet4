<?php
require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');
function listPostsHome() // Fonction qui récupère toutes les news
{
    $postManager = new \Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}
function post($postid) // Fonction qui récupère 1 news et les commentaires associés
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {  
        $postManager = new \Model\PostManager();
        $commentManager = new \Model\CommentManager();

        $post = $postManager->getPost($postid);
        $comments = $commentManager->getComments($postid);
        if(empty($post['content'])) {
            require('view/frontend/error.php');
        }
        else{
            require('view/frontend/postView.php');
        }
    }
    else{
        require('view/frontend/error.php');
    }
}
function reportComment($idReport, $postidReport) // Fonction qui permet de signaler un commentaire
{
    if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['postid']) && $_GET['postid'] > 0) {

        $report = new \Model\CommentManager();

        $reporting = $report->reportCommentDB($idReport);

        if ($reporting === false) {
            require('view/frontend/error.php');
        }
        else{
            header('Location: index.php?action=post&report&id=' . $postidReport);
        }
    }
    else {
        require('view/frontend/error.php');
    }

}
function addComment($postId, $author, $comment) // Fonction qui permet d'ajouter un commentaire
{
    if (isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['author']) && !empty($_POST['comment'])) { 

        $addComments = new \Model\CommentManager();

        $affectedLines = $addComments->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            require('view/frontend/error.php');
        }
        else {
            header('Location: index.php?action=post&add=' . $author . '&id=' . $postId);
            var_dump($affectedLines);
        }
    }else{
        require('view/frontend/error.php');
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
function forbidden() {
    require('view/frontend/forbidden.php');
}