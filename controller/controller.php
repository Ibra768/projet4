<?php

// Chargement des classes

require_once('model/CommentManager.php');
require_once('model/AdminManager.php');
require_once('model/PostManager.php');


// Foonction qui récupère toutes les news
function listPosts()
{
    $postManager = new \Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/listPostsView.php');
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
        header('Location: index.php');
    }
}
// Fonction qui permet de vérifier le pseudo et le mot de passe pour la connexion
function getAdministrator() {


    $pseudo = $_POST['pseudo']; 
    $checkAdmin = new \Model\AdminManager();
    $resultat = $checkAdmin->getAdmin($pseudo);
    
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

// Fonction qui permet la deconnexion de l'admin
function disconnect () {
    
    session_unset();
    session_destroy();
    listPosts();
}






