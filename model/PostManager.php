<?php

namespace Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts() // Récupère la liste des billets dans l'ordre souhaité afin de les afficher sur la page d'accueil
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, images, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts ORDER BY creation_date DESC');
        $posts = $req->fetchAll();
        return $posts;
    }
    public function getPost($postId) // Récupère 1 billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, images, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }
    public function getPostAdmin() // Récupère le nombre de billets 
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT ID FROM posts');
        return $req;
    }
    public function getPostsPage($depart,$billetParPage) // Récupère la liste des billets pour chaque page (espace administrateur)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, images, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts ORDER BY ID LIMIT ' . $depart . ',' .$billetParPage);
        $response = $req->fetchAll();
        return $response;
    }
    public function addPost($addTitle, $addContent, $addAuthor, $fichier) // Ajouter un billet
    {
        $db = $this->dbConnect();
        $insertPost = $db->prepare('INSERT INTO posts(title, content, author, images, creation_date) VALUES(?, ?, ?, ?, NOW())');
        $addPost = $insertPost->execute(array($addTitle, $addContent, $addAuthor, $fichier));
        return $addPost;
    }
    public function deletePost($idPost) // Supprimer un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($idPost));
    }
    public function updatePostDB($titleUpdate,$contentUpdate,$authorUpdate,$fichierImage,$idUpdate) // Modifier un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, author = ?, images = ? WHERE id = ?');
        $req->execute(array($titleUpdate,$contentUpdate,$authorUpdate,$fichierImage,$idUpdate));
        return $req;
    }
    public function updatePostDBWithoutImage($titleUpdate,$contentUpdate,$authorUpdate,$idUpdate) // Modifier un billet en gardant l'image initiale
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?');
        $req->execute(array($titleUpdate,$contentUpdate,$authorUpdate,$idUpdate));
        return $req;
    }
}