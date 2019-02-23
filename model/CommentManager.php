<?php

namespace Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId) // Récupère les commentaires d'un billet
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        $req = $comments->fetchAll();

        return $req;
    }

    public function postComment($postId, $author, $comment) // Ajoute un commentaire
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, signalement) VALUES(?, ?, ?, NOW(), ?)');
        $affectedLines = $comments->execute(array($postId, $author, $comment, "FALSE"));

        return $affectedLines;
    }
    public function reportCommentDB($idComment) // Passe la colonne signalement d'un commentaire a "TRUE" 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signalement = "TRUE" WHERE id = ?');
        $req->execute(array($idComment));
    }
    public function allowCommentDB($idAutorisation) // Passe la colonne signalement d'un commentaire a "FALSE" 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signalement = "FALSE" WHERE id = ?');
        $req->execute(array($idAutorisation));
    }
    public function getCommentsReport() // Récupère la liste des commentaires signalés (signalement = "TRUE")
    {
        $db = $this->dbConnect();
        $commentsReporting = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE signalement = ? ORDER BY comment_date DESC');
        $commentsReporting->execute(array("TRUE"));
        $req = $commentsReporting->fetchAll();


        return $req;
    }
    public function deleteComment($idComment) // Supprime un commentaire
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($idComment));
    }
}