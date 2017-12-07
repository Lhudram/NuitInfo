<?php

class Utilisateur
{

    private $idutilisateur;
    private $login;
    private $pwd;
    private $estsam;

    public function __construct($idutilisateur, $login,$pwd,$estsam )
    {
        $this->idutilisateur = $idutilisateur;
        $this->login = $login;
        $this->pwd = $pwd;
        $this->estsam = $estsam;
    }


    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur($idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPwd()
    {
        return $this->pwd;
    }

    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }

    public function getEstsam()
    {
        return $this->estsam;
    }

    public function setEstsam($estsam)
    {
        $this->estsam = $estsam;
    }

}

?>
