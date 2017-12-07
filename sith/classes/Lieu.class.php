<?php

class Lieu
{

    private $idlieu;
    private $adresse;
    private $departement;

    public function __construct($idlieu, $adresse,$departement)
    {
        $this->idlieu = $idlieu;
        $this->adresse = $adresse;
        $this->departement = $departement;
    }


    public function getIdlieu()
    {
        return $this->idlieu;
    }

    public function setIdlieu($idlieu)
    {
        $this->idlieu = $idlieu;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function getDepartement()
    {
        return $this->departement;
    }

    public function setDepartement($departement)
    {
        $this->departement = $departement;
    }
}

?>
