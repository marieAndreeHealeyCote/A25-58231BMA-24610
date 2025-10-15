<?php
require_once 'Classe/CRUD.php';

class Livre
{

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

    public function ajouter($aPost)
    {
        $aData = [
            'titre' => $aPost['titre'],
            'annee_publication' => $aPost['annee_publication'],
            'genre' => $aPost['genre'],
            'categorie_id' => $aPost['categorie_id'],
            'editeur_id' => $aPost['editeur_id'],
            'auteur_id' => $aPost['auteur_id'],
        ];
        $livreId = $this->crud->insert('livres', $aData);
        return $livreId;
    }

    public function modifier($aPost, $url = 'livre-index')
    {
        $aData = [
            'id' => $aPost['id'],
            'titre' => $aPost['titre'],
            'annee_publication' => $aPost['annee_publication'],
            'genre' => $aPost['genre'],
            'categorie_id' => $aPost['categorie_id'],
            'editeur_id' => $aPost['editeur_id'],
            'auteur_id' => $aPost['auteur_id'],
        ];
        $this->crud->update('livres', $aData, $url);
    }

    public function supprimer($id, $url = 'livre-index')
    {
        $this->crud->delete('livres', $id, $url);
    }
}
