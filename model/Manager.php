<?php

namespace Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        return $db;
    }
}