<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class CRUD extends PDO
{

    public function __construct()
    {
        parent::__construct('mysql:host=localhost; dbname=librairie; port=3306; charset=utf8', 'root', 'root');
    }

    // Récupération de données avec la classe CRUD
    public function select($table, $field = 'id', $order = 'ASC')
    {
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    // Récupération d'une seule donnée avec la classe CRUD
    public function selectId($table, $value, $field = 'id', $url = 'livre-index')
    {
        $sql = "SELECT * FROM $table WHERE $field = :$field";

        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            header("location:$url.php");
            exit;
        }
    }

    // Insertion de données avec la classe CRUD
    public function insert($table, $data)
    {
        $fieldName = implode(', ', array_keys($data));
        $fieldValue = ":" . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($fieldName) VALUES ($fieldValue)";
        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        var_dump($stmt, $this, $this->lastInsertId());
        die('yahoo');
        return $this->lastInsertId();
    }

    // Mise à jour des données avec la classe CRUD
    public function update($table, $data, $url, $field = 'id')
    {
        $fieldName = null;
        foreach ($data as $key => $value) {
            $fieldName .= "$key = :$key, ";
        }
        $fieldName = rtrim($fieldName, ', ');

        $sql = "UPDATE $table SET $fieldName WHERE $field = :$field";

        $stmt = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count == 1) {
            header("location:$url.php");
        } else {
            print_r($stmt->errorInfo());
        }
    }

    // Suppression de données avec la classe CRUD
    public function delete($table, $value, $url, $field = 'id')
    {
        $sql = "DELETE FROM $table WHERE $field = :$field";
        //return $sql;
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            header("location:$url.php");
        } else {
            print_r($stmt->errorInfo());
        }
    }
}
