<?php

namespace Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts() // Récupère la liste des billets
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC');

        return $req;
    }

    public function getPost($postId) // Récupère 1 billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
    public function addPost($title, $content) // Ajoute un billet
    {
        $db = $this->dbConnect();
        $insertPost = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $addPost = $insertPost->execute(array($title, $content));

        return $addPost;
    }
    public function deletePost($idPost) // Supprime un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($idPost));
    }
    public function updatePostDB($idUpdate,$titleUpdate,$contentUpdate) // Modifie un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $req->execute(array($titleUpdate,$contentUpdate,$idUpdate));
    }
}