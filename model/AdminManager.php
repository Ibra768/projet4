<?php

namespace Model;

require_once("model/Manager.php");

class AdminManager extends Manager
{
    public function getAdmin($pseudoAdmin)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, pass FROM administrateur WHERE pseudo = ?');
        $req->execute(array($pseudoAdmin));
        $resultat = $req->fetch();

        return $resultat;
    }
}
