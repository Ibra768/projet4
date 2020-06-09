<?php

namespace Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts() // Récupère la liste des billets dans l'ordre souhaité afin de les afficher sur la page d'accueil
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT 
                            posts.id, posts.title, posts.content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, 
                            images.img_nom AS img
                            FROM posts 
                            LEFT JOIN images ON id = images.post_id
                            ORDER BY creation_date DESC');
        $posts = $req->fetchAll();
        return $posts;
    }
    public function getPost($postId) // Récupère 1 billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT 
                            posts.id, posts.title, posts.author, posts.content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr,
                            images.img_nom AS img
                            FROM posts 
                            LEFT JOIN images ON id = images.post_id
                            WHERE posts.id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }
    public function allPosts() // Permet de renvoyer le nombre de ligne, afin de les compter dans le controller 
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id FROM posts');
        return $req;
    }
    public function checkId($id){

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id FROM posts WHERE id = ?');
        $req->execute(array($id));
        $post = $req->fetch();
        return $post;
    }
    public function checkImageName($name){

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM images WHERE img_nom = ?');
        $req->execute(array($name));
        $response = $req->fetch();
        return $response;
    }
    public function checkImageId($id){

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM images WHERE post_id = ?');
        $req->execute(array($id));
        $response = $req->fetch();
        return $response;
    }
    public function getPostsPage($depart,$billetParPage) // Récupère la liste des billets pour chaque page (espace administrateur)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts ORDER BY ID LIMIT ' . $depart . ',' .$billetParPage);
        $response = $req->fetchAll();
        return $response;
    }

    public function addPost($id,$addTitle,$addContent,$addAuthor) // Ajouter un billet
    {
        $db = $this->dbConnect();
        $insertPost = $db->prepare('INSERT INTO posts(id, title, content, author, creation_date) VALUES(?, ?, ?, ?, NOW())');
        $addPost = $insertPost->execute(array($id,$addTitle,$addContent,$addAuthor));
        return $addPost;
    }
    public function addImage($post_id,$img_nom,$img_taille,$img_type){
        $db = $this->dbConnect();
        $addImage = $db->prepare('INSERT INTO images(post_id, img_nom, img_taille, img_type) VALUES(?, ?, ?, ?)');
        $exec = $addImage->execute(array($post_id,$img_nom,$img_taille,$img_type));
        return $exec;
    }
    public function deletePost($idPost) // Supprimer un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($idPost));
    }
    public function updatePostDB($titleUpdate,$contentUpdate,$authorUpdate,$id) // Modifier un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?');
        $response = $req->execute(array($titleUpdate,$contentUpdate,$authorUpdate,$id));
        return $response;
    }
    public function updateImage($img_taille,$img_type,$id) // Modifier un billet
    {   
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE images SET img_taille = ?, img_type = ? WHERE post_id = ?');
        $response = $req->execute(array($img_taille,$img_type,$id));
        return $response;
    }
    public function updatePostDBWithoutImage($titleUpdate,$contentUpdate,$authorUpdate,$idUpdate) // Modifier un billet en gardant l'image initiale
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, author = ? WHERE id = ?');
        $req->execute(array($titleUpdate,$contentUpdate,$authorUpdate,$idUpdate));
        $response = $req->rowCount();
        return $response;
    }
}