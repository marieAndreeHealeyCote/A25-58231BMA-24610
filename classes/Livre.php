<?php
require_once 'Classe/CRUD.php';

class Livre
{
    public $id;
    public $titre;
    public $auteur;
    public $annee_publication;
    public $genre;
    public $categorie_id;
    public $editeur_id;
    public $auteur_id;

    private $crud;

    public function __construct()
    {
        $this->crud = new CRUD;
    }

    public function __destruct()
    {
        // Ferme proprement la connexion à la base de données
        $this->crud = null;
    }

    public function getAll()
    {
        return $this->crud->select('livres');
    }

    public function getById($id)
    {
        return $this->crud->selectId('livres', $id);
    }

    public function ajouter()
    {
        $aData = [
            'titre' => $this->titre,
            'annee_publication' => $this->annee_publication,
            'genre' => $this->genre,
            'categorie_id' => $this->categorie_id,
            'editeur_id' => $this->editeur_id,
            'auteur_id' => $this->auteur_id,
        ];
        $livreId = $this->crud->insert('livres', $aData);
        return $livreId;
    }

    public function modifier($url = 'livres-index')
    {
        $aData = [
            'id' => $this->id,
            'titre' => $this->titre,
            'annee_publication' => $this->annee_publication,
            'genre' => $this->genre,
            'categorie_id' => $this->categorie_id,
            'editeur_id' => $this->editeur_id,
            'auteur_id' => $this->auteur_id,
        ];
        $this->crud->update('livres', $aData, $url);
    }

    public function supprimer($id, $url = 'livres-index')
    {
        $this->crud->delete('livres', $id, $url);
    }
}
