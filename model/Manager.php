<?php

namespace Model;

class Manager
{
    protected function dbConnect() // Permet la connexion a la base de données
    {
        $db = new \PDO('mysql:host=localhost;dbname=jean;charset=utf8','jean','forteroche');
        return $db;
    }
}



