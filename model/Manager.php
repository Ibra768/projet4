<?php

namespace Model;

class Manager
{
    protected function dbConnect() // Permet la connexion a la base de données
    {
        $db = new \PDO('mysql:host=db5000560214.hosting-data.io;port=3306;dbname=dbs537857;charset=utf8','dbu366971','AdamIbTp76*');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}



