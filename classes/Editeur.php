<?php
require_once 'Classe/Database.php';

class Editeur
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
        $sql = "SELECT * FROM editeurs ORDER BY nom ASC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id)
    {
        $sql = "SELECT nom FROM editeurs WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row ? $row->nom : 'Non défini';
    }

    public function getByIdFull($id)
    {
        $sql = "SELECT * FROM editeurs WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function ajouter($nom)
    {
        $sql = "INSERT INTO editeurs (nom) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom]);
    }

    public function update($id, $nom)
    {
        $sql = "UPDATE editeurs SET nom = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $id]);
    }

    public function supprimer($id)
    {
        $sql = "DELETE FROM editeurs WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
