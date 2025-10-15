<?php
require_once 'Classe/CRUD.php';

class Categorie
{
    private $crud;

    public function __construct()
    {
        $this->crud = new CRUD;
    }

    public function __destruct()
    {
        $this->crud = null;
    }

    public function getById($id)
    {
        return $this->crud->selectId('categories', $id);
    }

    public function getAll()
    {
        return $this->crud->select('categories');
    }
}
