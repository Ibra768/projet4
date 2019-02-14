<?php

// Chargement des classes

require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');

function listPosts()
{
    $postManager = new \Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/listPostsView.php');
}

function post()
{
    $postManager = new \Model\PostManager();
    $commentManager = new \Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new \Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function getAdministrator() {


    $pseudo = $_POST['pseudo']; 
    $checkAdmin = new \Model\AdminManager();
    $resultat = $checkAdmin->getAdmin($pseudo);
    var_dump($resultat);
    
    $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);
    
    if (!$resultat)
    {
        header('Location: connexion.php?erreur');
    }
    else
    {
        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['pass'] = $_POST['pass'];
            header('Location: admin.php');
        }
        else {
            header('Location: connexion.php?erreur');
        }
    }
}
function disconnect () {
    
    session_unset();
    session_destroy();
    listPosts();
}




