<?php

namespace App\Controller;

use App\Entity\ReservationEntity;
use App\Models\ReservationModel;
use Exception;

class ReservationController
{
    private ReservationModel $repository;

    public function __construct()
    {
        $this->repository = new ReservationModel(); 
    }

    public function ajouterReservation(array $data): void
    {
        try{
            $nom = trim($data['nom_client'] ?? '');
            $chambre = (int) ($data['numero_chambre'] ?? 0);
            $nuits = (int) ($data['nombre_nuits'] ?? 0);
            $type = $data['type_chambre'] ?? '';
            if($nom === ''|| $chambre <= 0 || $nuits <= 0){
                throw new Exception("Les champs sont obligatoire.");
            }

        $reservation = new ReservationEntity();
        $reservation->setNomClient($nom);
        $reservation->setNumeroChambre($chambre);
        $reservation->setNombreNuits($nuits);
        $reservation->setTypeChambre($type);

        $this->repository->insertReservation($reservation);
            
            }catch (Exception $e) {
                 die($e->getMessage());
        }
    }

    public function listerActives(): array
    {
        return $this->repository->selectActive();
    }

    public function annulerReservation(int $id): void
    {
        try{
            $res=$this->repository->findById($id);
            if($res===null){
                throw new Exception("Cette réservation n'existe pas.");
            }
        $this->repository->cancelReservation($id);
            }catch (Exception $e) {
                die($e->getMessage());
        }
    }

    public function calculerCA(): int
    {
        $actives = $this->repository->selectActive();
        $total = 0;
        $tarifs = ['STANDARD' => 25000, 'CONFORT' => 50000, 'SUITE' => 100000];
        foreach ($actives as $res) {
            $total += $res->getNombreNuits() * ($tarifs[$res->getTypeChambre()] ?? 0);
        }
        return $total;
    }

    public function obtenirSejourLePlusLong(): array
    {
        return $this->repository->selectLongestStays();
    }
}