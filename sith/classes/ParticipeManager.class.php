<?php

class BulletinModeleSalaireManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function add($participe)
    {

        $reqSQL = 'INSERT INTO BULLETIN_MODELE_SALAIRE (intitulebulletinmodelesalaire) VALUES (:intituleBulletinModeleSalaire)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':intituleBulletinModeleSalaire', $bulletinModeleSalaire->getIntitule());
        $reqPreparee->execute();
    }

    public function getAll()
    {

        $tabAll = array();

        $reqSQL = "SELECT idbulletinmodelesalaire, intitulebulletinmodelesalaire FROM BULLETIN_MODELE_SALAIRE";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($bulletinModeleSalaire = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Participe($bulletinModeleSalaire->idbulletinmodelesalaire,
                                      $bulletinModeleSalaire->intitulebulletinmodelesalaire);
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }
}

?>
