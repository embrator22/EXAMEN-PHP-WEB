<?php

namespace App\Models;

use App\Database\Database;
use App\Entity\ReservationEntity;
use PDO;
use PDOException;

class ReservationModel extends Database
{   
    private function createReservation(array $row): ReservationEntity
    {
        $reservation = new ReservationEntity();
        $reservation->setId((int) $row['id']);
        $reservation->setNomClient($row['nom_client']);
        $reservation->setNumeroChambre((int) $row['numero_chambre']);
        $reservation->setNombreNuits((int) $row['nombre_nuits']);
        $reservation->setTypeChambre($row['type_chambre']);
        $reservation->setStatut($row['statut']);
        return $reservation;
    }

    public function selectActive(): array
    {
        try {
            $pdo = Database::getConnection();
            if ($pdo === null) {
                return [];
            }
            $stmt = $pdo->query("SELECT * FROM reservations WHERE statut = 'valide' ORDER BY id DESC");
            return array_map(fn($row) => $this->createReservation($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public function insertReservation(ReservationEntity $reservation): ReservationEntity
    {
        try {
            $pdo = Database::getConnection();
            if ($pdo === null) {
                return $reservation;
            }
            $stmt = $pdo->prepare('INSERT INTO reservations (nom_client, numero_chambre, nombre_nuits, type_chambre, statut) VALUES (:nom, :chambre, :nuits, :type, :statut)');
            $stmt->execute([
                ':nom' => $reservation->getNomClient(),
                ':chambre' => $reservation->getNumeroChambre(),
                ':nuits' => $reservation->getNombreNuits(),
                ':type' => $reservation->getTypeChambre(),
                ':statut' => $reservation->getStatut(),
            ]);
            $reservation->setId((int) $pdo->lastInsertId());
            return $reservation;
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public function findById(int $id): ?ReservationEntity
    {
        try {
            $pdo = Database::getConnection();
            if ($pdo === null) {
                return null;
            }
            $stmt = $pdo->prepare('SELECT * FROM reservations WHERE id = ? LIMIT 1');
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? $this->createReservation($row) : null;
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public function cancelReservation(int $id): bool
    {
        try {
            $pdo = Database::getConnection();
            if ($pdo === null) {
                return false;
            }
            $stmt = $pdo->prepare("UPDATE reservations SET statut = 'annuler' WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public function selectLongestStays(): array
    {
        try {
            $pdo = Database::getConnection();
            if ($pdo === null) {
                return [];
            }
            $sql = "SELECT * FROM reservations WHERE statut = 'valide' AND nombre_nuits = (SELECT MAX(nombre_nuits) FROM reservations WHERE statut = 'valide')";
            $stmt = $pdo->query($sql);
            return array_map(fn($row) => $this->createReservation($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }
}