<?php

namespace App\Entity;

class ReservationEntity
{
    private ?int $id = null;
    private string $nomClient;
    private int $numeroChambre;
    private int $nombreNuits;
    private string $typeChambre;
    private string $statut = 'valide';


    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getNomClient(): string { return $this->nomClient; }
    public function setNomClient(string $nomClient): void { $this->nomClient = $nomClient; }

    public function getNumeroChambre(): int { return $this->numeroChambre; }
    public function setNumeroChambre(int $numeroChambre): void { $this->numeroChambre = $numeroChambre; }

    public function getNombreNuits(): int { return $this->nombreNuits; }
    public function setNombreNuits(int $nombreNuits): void { $this->nombreNuits = $nombreNuits; }

    public function getTypeChambre(): string { return $this->typeChambre; }
    public function setTypeChambre(string $typeChambre): void { $this->typeChambre = $typeChambre; }

    public function getStatut(): string { return $this->statut; }
    public function setStatut(string $statut): void { $this->statut = $statut; }
}