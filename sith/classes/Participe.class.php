<?php

class Participe
{

    private $idutilisateur;
    private $idevenement;

    public function __construct($idutilisateur, $idevenement)
    {
        $this->idutilisateur = $idutilisateur;
        $this->idevenement = $idevenement;
    }


    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur($idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;
    }

    public function getIdevenement()
    {
        return $this->idevenement;
    }

    public function setIdevenement($idevenement)
    {
        $this->idevenement = $idevenement;
    }

}

?>
