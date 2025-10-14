<?php
class Database
{
    private static $host = 'localhost';
    private static $dbname = 'librairie';
    private static $username = 'root';
    private static $password = 'root';
    private static $pdo = null;

    public static function connect()
    {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$username, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
