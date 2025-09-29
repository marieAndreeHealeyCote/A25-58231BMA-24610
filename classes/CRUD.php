<?php

// Création d'une classe CRUD généralisée
class CRUD extends PDO
{

    public function __construct()
    {
        parent::__construct('mysql:host=localhost; dbname=ecommerce; port=3306; charset=utf8', 'root', 'root');
    }
}
