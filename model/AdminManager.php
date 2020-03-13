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
    public function changeAccess($newPseudo,$newPass,$currentPseudo) // Permet de modifier le pseudo et le mot de passe d'un administrateur
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE administrateur SET pseudo = ?, pass = ? WHERE pseudo = ?');
        $req->execute(array($newPseudo,$newPass,$currentPseudo));
        return $req;
    }
    public function temporaryPass($newPass,$pseudo) // Permet d'ajouter un mot de passe temporaire en cas de mot de passe oublié
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE administrateur SET pass = ? WHERE pseudo = ?');
        $req->execute(array($newPass,$pseudo));
        return $req;
    }
    public function changeOnlyPseudo($newPseudo,$currentPseudo) // Permet de modifier le pseudo uniquement
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE administrateur SET pseudo = ? WHERE pseudo = ?');
        $req->execute(array($newPseudo,$currentPseudo));
        return $req;
    }
}
