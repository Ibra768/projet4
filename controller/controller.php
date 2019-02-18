<?php

// Chargement des classes

require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');


                                  /*                  Requêtes UTILISATEUR                      */ 



function listPostsHome() // Fonction qui récupère toutes les news
{
    $postManager = new \Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');


}

function post($postid) // Fonction qui récupère 1 news et les commentaires associés
{
    $postManager = new \Model\PostManager();
    $commentManager = new \Model\CommentManager();

    $post = $postManager->getPost($postid);
    $comments = $commentManager->getComments($postid);

    require('view/frontend/postView.php');
}

function reportComment($idReport, $postidReport) // Fonction qui permet de signaler un commentaire
{
    $report = new \Model\CommentManager();

    $reporting = $report->reportCommentDB($idReport);

    if ($reporting === false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else{
        header('Location: index.php?action=post&report&id=' . $postidReport);
    }

}

function addComment($postId, $author, $comment) // Fonction qui permet d'ajouter un commentaire
{
    $addComments = new \Model\CommentManager();

    $affectedLines = $addComments->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&add=' . $author . '&id=' . $postId);
    }
}

function getAdministrator($pseudo, $mdp) { // Fonction qui permet de savoir si l'utilisateur est administrateur lors de la connexion

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
            session_start();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['pass'] = $mdp;    
            header('Location: index.php?action=admin');  
        }
        else {
            header('Location: index.php?action=erreurConnexion');
        }
    }
}


                                  /*                  Requêtes ADMINISTRATEUR                      */
                                  
                                  
function dataAdmin() // Fonction qui récupère la liste des billets, ainsi que les commentaires à modérer
{
    $postManagerAdmin = new \Model\PostManager();
    $commentReport = new \Model\CommentManager();

    $postsAdmin = $postManagerAdmin->getPosts();
    $commentsReporting = $commentReport->getCommentsReport();

    require('view/backend/admin.php');


}

function updatePost() // Fonction qui récupère le billet à modifier (afin de l'insérer dans un formulaire pour le modifier)
{
    $postUpdate = new \Model\PostManager();

    $postUp = $postUpdate->getPost($_GET['id']);

    require('view/backend/updateNews.php');
}

function confirmUpdatePost($idUpdate, $titleUpdate, $contentUpdate) // Fonction qui modifie le billet
{
    $confirmPostUpdate = new \Model\PostManager();

    $confirmUp = $confirmPostUpdate->updatePostDB($idUpdate, $titleUpdate, $contentUpdate);


    if ($confirmUp === false) {
        throw new Exception('Impossible de modifier le billet !');
    }
    else {
        
        header('Location: index.php?action=admin&amp;update'); 

    }
}

function addPost($title, $content) // Fonction qui permet d'ajouter un billet
{
    $newPost = new \Model\PostManager();

    $addedPost = $newPost->addPost($title, $content);

    if ($addedPost === false) {
        throw new Exception('Impossible d\'ajouter le billet !');
    }
    else {
        header('Location: index.php?action=admin&amp;add'); 
    }
}

function deletePost() // Fonction qui permet de supprimer un billet
{
    $postManagerDeletePosts = new \Model\PostManager();

    $deletePost = $postManagerDeletePosts->deletePost($_GET['id']);

    if ($deletePost === false) {
        throw new Exception('Impossible de supprimer le billet !');
    }
    else {
        header('Location: index.php?action=admin&amp;deletePost'); 
    }

}

function allowComment($idComment) // Fonction qui autorise un commentaire signalé
{
    $allow = new \Model\CommentManager();

    $allowingComment = $allow->allowCommentDB($idComment);

    if ($allowingComment === false) {
        throw new Exception('Impossible d\'autoriser le commentaire !');
    }
    else {
        header('Location: index.php?action=admin&amp;allow');
    }
}

function deleteComment($id) // Fonction qui permet de supprimer un commentaire signalé
{
    $deleteComment = new \Model\CommentManager();

    $confirmDeleteComment = $deleteComment->deleteComment($id);

    if ($confirmDeleteComment === false) {
        throw new Exception('Impossible de supprimer le billet !');
    }
    else {
        header('Location: index.php?action=admin&amp;deleteComment'); 
    }

}


function disconnect () { // Fonction qui permet la deconnexion de l'admin
    
    session_unset();
    session_destroy();
    listPostsHome();
}






