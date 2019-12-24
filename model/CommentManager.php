<?php

namespace Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getAllComments() // Récupère la liste des billets
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments ORDER BY comment_date DESC');
        $posts = $req->fetchAll();
        return $posts;
    }

    public function getComments($postId) // Récupère les commentaires d'un billet
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        $req = $comments->fetchAll();

        return $req;
    }

    public function postComment($postId, $author, $comment) // Ajoute un commentaire
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, signalement, nb_signalements) VALUES(?, ?, ?, NOW(), ?, ?)');
        $affectedLines = $comments->execute(array($postId, $author, $comment, "FALSE", "0"));
        return $affectedLines;
    }
    public function reportCommentDB($idComment) // Passe la colonne signalement d'un commentaire a "TRUE" 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signalement = "TRUE", nb_signalements = nb_signalements+1 WHERE id = ?');
        $req->execute(array($idComment));
    }
    public function allowCommentDB($idAutorisation) // Passe la colonne signalement d'un commentaire a "FALSE" 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signalement = "FALSE", nb_signalements = 0 WHERE id = ?');
        $req->execute(array($idAutorisation));
    }
    public function getCommentsReport() // Récupère la liste complete des commentaires signalés
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT ID FROM comments WHERE signalement = ?');
        $req->execute(array("TRUE"));
        return $req;
    
    }
    public function getCommentsReportByPage($departComments,$commentsParPage) // Récupère la liste des commentaires signalés (signalement = "TRUE") page par page
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr, nb_signalements FROM comments WHERE signalement = ? ORDER BY comment_date DESC LIMIT ' . $departComments . ',' .$commentsParPage);
        $req->execute(array("TRUE"));
        $response = $req->fetchAll();
        return $response;
    }
    public function deleteComment($idComment) // Supprime un commentaire
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($idComment));
    }
}