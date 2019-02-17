<?php

namespace Model;

require_once("model/Manager.php");

class AdminManager extends Manager
{
    public function getAdmin($pseudoAdmin) // Permet de vérifier si le mot de passe renseigné correspond à un pseudo dans la DB
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, pass FROM administrateur WHERE pseudo = ?');
        $req->execute(array($pseudoAdmin));
        $resultat = $req->fetch();

        return $resultat;
    }
}
