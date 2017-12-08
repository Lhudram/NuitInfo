<?php

class AccidentManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function add($accident)
    {

        $reqSQL = 'INSERT INTO accident VALUES (:lattitude, :longitude, :type, :heure, :nombre)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':lattitude', $accident->getLattitude());
        $reqPreparee->bindValue(':longitude', $accident->getLongitude());
        $reqPreparee->bindValue(':type', $accident->getType());
        $reqPreparee->bindValue(':heure', $accident->getHeure());
        $reqPreparee->bindValue(':nombre', $accident->getNombre());
        $reqPreparee->execute();
    }

    public function getAll()
    {

        $tabAll = array();

        $reqSQL = "SELECT lattitude, longitude, type, heure, nombre FROM accident";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($accident = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Accident($accident->lattitude,
                                    $accident->longitude,
                                    $accident->type,
                                    $accident->heure,
                                    $accident->nombre
                                  );
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }

    public function getAllFromLocation($lattitude, $longitude)
    {

        $tabAll = array();

        $reqSQL = "SELECT lattitude, longitude, type, heure, nombre FROM accident where lattitude
        BETWEEN ".($lattitude-0.025)." AND ".($lattitude+0.025)." AND longitude BETWEEN ".($longitude-0.025)." AND ".($longitude+0.025);
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($accident = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Accident($accident->lattitude,
                                    $accident->longitude,
                                    $accident->type,
                                    $accident->heure,
                                    $accident->nombre
                                  );
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }
}

?>
