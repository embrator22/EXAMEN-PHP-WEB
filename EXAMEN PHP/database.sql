CREATE DATABASE IF NOT EXISTS hotel-Reservation

USE hotel-Reservation

CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_client VARCHAR(255) NOT NULL,
    numero_chambre INT NOT NULL,
    nombre_nuits INT NOT NULL,
    type_chambre ENUM('STANDARD', 'CONFORT', 'SUITE') NOT NULL,
    statut ENUM('valide', 'annuler') DEFAULT 'valide' NOT NULL
)
