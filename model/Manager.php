<?php

namespace Model;

class Manager
{
    protected function dbConnect() // Permet la connexion a la base de données
    {
        $db = new \PDO('mysql:host=localhost;dbname=jean;charset=utf8','jean','forteroche');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}



