<?php
require_once 'Classe/Database.php';

class Auteur
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
        $sql = "SELECT * FROM auteurs ORDER BY nom ASC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id)
    {
        $sql = "SELECT nom FROM auteurs WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row ? $row->nom : 'Non défini';
    }

    public function getByIdFull($id)
    {
        $sql = "SELECT * FROM auteurs WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function ajouter($nom)
    {
        $sql = "INSERT INTO auteurs (nom) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom]);
    }

    public function update($id, $nom)
    {
        $sql = "UPDATE auteurs SET nom = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $id]);
    }

    public function supprimer($id)
    {
        $sql = "DELETE FROM auteurs WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
