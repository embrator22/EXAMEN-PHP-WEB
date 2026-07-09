<?php

namespace App\Database;

use PDO;
use PDOException;

abstract class Database
{
    protected static ?PDO $pdo = null;
    protected string $tableName;
    protected string $classeName;

    private function __construct()
    {
    }

    protected static function openConnexion(): ?PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        try {
            $host = 'localhost';
            $dbname = 'hotel-Reservation';
            $username = 'root';
            $password = '';

            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            return self::$pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getConnection(): ?PDO
    {
        return self::openConnexion();
    }
}