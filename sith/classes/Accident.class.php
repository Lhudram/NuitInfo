<?php

class Accident
{

    private $lattitude;
    private $longitude;
    private $type;
    private $heure;
    private $nombre;

    public function __construct($lattitude, $longitude,$type,$heure,$nombre)
    {
        $this->lattitude = $lattitude;
        $this->longitude = $longitude;
        $this->type = $type;
        $this->heure = $heure;
        $this->nombre = $nombre;
    }


    public function getLattitude()
    {
        return $this->lattitude;
    }

    public function setLattitude($lattitude)
    {
        $this->lattitude = $lattitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getHeure()
    {
        return $this->heure;
    }

    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}

?>
