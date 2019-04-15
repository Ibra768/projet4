<?php

namespace Model;

class Manager
{
    protected function dbConnect() // Permet la connexion a la base de données
    {
        $db = new \PDO('mysql:host=localhost;dbname=jeankjbu_alaska;charset=utf8', 'jeankjbu_jean', 'forteroche');
        return $db;
    }
}



