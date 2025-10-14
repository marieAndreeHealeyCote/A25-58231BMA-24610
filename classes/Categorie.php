<?php
class Categorie
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categories ORDER BY nom ASC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id)
    {
        $sql = "SELECT nom FROM categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row ? $row->nom : 'Non défini';
    }

    public function ajouter($nom)
    {
        $sql = "INSERT INTO categories (nom) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom]);
    }

    public function update($id, $nom)
    {
        $sql = "UPDATE categories SET nom = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $id]);
    }

    public function supprimer($id)
    {
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    // Récupération complète d'une catégorie
    public function getByIdFull($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
