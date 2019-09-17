<?php

namespace Model;

require_once("Manager.php");

class AdminManager extends Manager
{
    public function getAdmin($pseudoAdmin) // Permet de vérifier si le mot de passe renseigné correspond à un pseudo dans la DB
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, pass, email FROM administrateur WHERE pseudo = ?');
        $req->execute(array($pseudoAdmin));
        $resultat = $req->fetch();

        return $resultat;
    }
    public function changeAccess($newPseudo,$newPass,$currentPseudo) // Modifie un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE administrateur SET pseudo = ?, pass = ? WHERE pseudo = ?');
        $req->execute(array($newPseudo,$newPass,$currentPseudo));
        return $req;
    }
    public function changeOnlyPseudo($newPseudo,$currentPseudo) // Modifie un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE administrateur SET pseudo = ? WHERE pseudo = ?');
        $req->execute(array($newPseudo,$currentPseudo));
        return $req;
    }
    public function addPost($addTitle, $addContent, $addAuthor, $fichier) // Ajoute un billet
    {
        $db = $this->dbConnect();
        $insertPost = $db->prepare('INSERT INTO posts(title, content, author, images, creation_date) VALUES(?, ?, ?, ?, NOW())');
        $addPost = $insertPost->execute(array($addTitle, $addContent, $addAuthor, $fichier));
        return $addPost;
    }
}
