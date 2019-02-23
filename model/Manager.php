<?php

namespace Model;

class Manager
{
    protected function dbConnect() // Permet la connexion a la base de données
    {
        $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        return $db;
    }
}

/*
<?php

namespace Model;

class Manager
{
    protected function dbConnect() // Permet la connexion a la base de données
    {
        $db = new \PDO('mysql:host=localhost;dbname=projunpb_alaska;charset=utf8', 'projunpb_jean', 'forteroche');
        return $db;
    }
}
*/