<?php

class Evenement
{

    private $idevenement;
    private $nom_event;
    private $desc_event;
    private $date_event;
    private $idlieu;

    public function __construct($idevenement, $nom_event,$desc_event,$date_event,$idlieu)
    {
        $this->idevenement = $idevenement;
        $this->nom_event = $nom_event;
        $this->desc_event=$desc_event;
        $this->date_event=$date_event;
        $this->idlieu=$idlieu;
    }


    public function getIdevenement()
    {
        return $this->idevenement;
    }

    public function setIdevenement($idevenement)
    {
        $this->idevenement = $idevenement;
    }

    public function getNomevent()
    {
        return $this->nom_event;
    }

    public function setNomevent($nom_event)
    {
        $this->nom_event = $nom_event;
    }

    public function getDescevent()
    {
        return $this->desc_event;
    }

    public function setDescevent($desc_event)
    {
        $this->desc_event = $desc_event;
    }

    public function getDateevent()
    {
        return $this->date_event;
    }

    public function setDateevent($date_event)
    {
        $this->date_event = $date_event;
    }

    public function getIdlieu()
    {
        return $this->idlieu;
    }

    public function setIdlieu($idlieu)
    {
        $this->idlieu = $idlieu;
    }
}

?>
