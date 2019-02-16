<?php

// Chargement des classes

require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');


// Foonction qui récupère toutes les news
function listPostsHome()
{
    $postManager = new \Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/listPostsView.php');
    require('view/admin.php');

}
function listPostsAdmin()
{
    $postManagerAdmin = new \Model\PostManager();
    $commentReport = new \Model\CommentManager();

    $postsAdmin = $postManagerAdmin->getPosts();
    $commentsReporting = $commentReport->getCommentsReport();

    require('view/admin.php');


}

// Fonction qui récupère 1 news et les commentaires associés
function post()
{
    $postManager = new \Model\PostManager();
    $commentManager = new \Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

function updatePost()
{
    $postUpdate = new \Model\PostManager();

    $postUp = $postUpdate->getPost($_GET['id']);

    require('view/updateNews.php');
}
function confirmUpdatePost($idUpdate, $titleUpdate, $contentUpdate)
{
    $confirmPostUpdate = new \Model\PostManager();

    $confirmUp = $confirmPostUpdate->updatePost($idUpdate, $titleUpdate, $contentUpdate);


    if ($confirmUp === false) {
        throw new Exception('Impossible de modifier le billet !');
    }
    else {
        header('Location: index.php?action=admin'); 
    }
}
function report($idReport)
{
    $report = new \Model\CommentManager();

    $reporting = $report->reportDB($idReport);

    if ($reporting === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }

}

// Fonction qui permet l'ajout de commentaire
function addComment($postId, $author, $comment)
{
    $addComments = new \Model\CommentManager();

    $affectedLines = $addComments->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function addPost($title, $content)
{
    $newPost = new \Model\PostManager();

    $addedPost = $newPost->addPost($title, $content);

    if ($addedPost === false) {
        throw new Exception('Impossible d\'ajouter le billet !');
    }
    else {
        header('Location: index.php?action=admin'); 
    }
}
function deletePost()
{
    $postManagerDeletePosts = new \Model\PostManager();

    $post = $postManagerDeletePosts->deletePost($_GET['id']);

    header('Location: index.php?action=admin');  

}
// Fonction qui permet de vérifier le pseudo et le mot de passe pour la connexion
function getAdministrator($pseudo, $mdp) {

    $checkAdmin = new \Model\AdminManager();
    $resultat = $checkAdmin->getAdmin($pseudo);
    
    $isPasswordCorrect = password_verify($mdp, $resultat['pass']);
    
    if (!$resultat)
    {
        header('Location: view/connexion.php?erreur');
    }
    else
    {
        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['pass'] = $mdp;    
            header('Location: index.php?action=admin');  
        }
        else {
            header('Location: view/connexion.php?erreur');
        }
    }
}

// Fonction qui permet la deconnexion de l'admin
function disconnect () {
    
    session_unset();
    session_destroy();
    listPostsHome();
}






