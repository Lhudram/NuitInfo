<?php

class LieuManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function add($lieu)
    {

        $reqSQL = 'INSERT INTO lieu VALUES (:idlieu, :adresse, :departement)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idlieu', $lieu->getIdlieu());
        $reqPreparee->bindValue(':adresse', $lieu->getAdresse());
        $reqPreparee->bindValue(':departement', $lieu->getDepartement());
        $reqPreparee->execute();
    }

    public function getAll()
    {

        $tabAll = array();

        $reqSQL = "SELECT idlieu, adresse, departement FROM lieu";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($lieu = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Lieu($lieu->idlieu,
                                $lieu->adresse,
                                $lieu->departement
                                );
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }
}

?>
