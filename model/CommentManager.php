<?php

namespace Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, signalement) VALUES(?, ?, ?, NOW(), ?)');
        $affectedLines = $comments->execute(array($postId, $author, $comment, "FALSE"));

        return $affectedLines;
    }
    public function reportDB($idReport)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signalement = "TRUE" WHERE id = ?');
        $req->execute(array($idReport));
    }
    public function getCommentsReport()
    {
        $db = $this->dbConnect();
        $commentsReporting = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE signalement = ? ORDER BY comment_date DESC');
        $commentsReporting->execute(array("TRUE"));

        return $commentsReporting;
    }
}