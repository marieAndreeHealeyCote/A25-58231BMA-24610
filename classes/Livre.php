<?php
require_once 'Classe/Database.php';

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

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function __destruct()
    {
        // Ferme proprement la connexion à la base de données
        $this->pdo = null;
    }

    public function ajouter()
    {
        $sql = "INSERT INTO livres (titre, annee_publication, genre, categorie_id, editeur_id, auteur_id) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $this->titre,
            $this->annee_publication,
            $this->genre,
            $this->categorie_id,
            $this->editeur_id,
            $this->auteur_id
        ]);
    }

    public function modifier()
    {
        $sql = "UPDATE livres SET titre = ?, annee_publication = ?, genre = ?, categorie_id = ?, editeur_id = ?, auteur_id = ? 
        WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $this->titre,
            $this->annee_publication,
            $this->genre,
            $this->categorie_id,
            $this->editeur_id,
            $this->auteur_id,
            $this->id
        ]);
    }

    public function supprimer($id)
    {
        $sql = "DELETE FROM livres WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM livres ORDER BY id DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM livres WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
