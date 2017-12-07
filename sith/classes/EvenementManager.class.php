<?php

class EvenementManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    p  public function add($evenement)
      {

          $reqSQL = 'INSERT INTO accident VALUES (:idevenement, :nom_event, :desc_event, :date_event, :idlieu)';
          $reqPreparee = $this->db->prepare($reqSQL);
          $reqPreparee->bindValue(':idevenement', $accident->getIdevenement());
          $reqPreparee->bindValue(':nom_event', $accident->getNomevent());
          $reqPreparee->bindValue(':desc_event', $accident->getDescevent());
          $reqPreparee->bindValue(':date_event', $accident->getDateevent());
          $reqPreparee->bindValue(':idlieu', $accident->getIdlieu());
          $reqPreparee->execute();
      }

      public function getAll()
      {

          $tabAll = array();

          $reqSQL = "SELECT idevenement, nom_event, desc_event, date_event, idlieu FROM evenement";
          $reqPreparee = $this->db->prepare($reqSQL);
          $reqPreparee->execute();

          while ($evenement = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
              $tabAll[] = new Evenement($evenement->idevenement,
                                      $evenement->nom_event,
                                      $evenement->desc_event,
                                      $evenement->date_event,
                                      $evenement->idlieu
                                    );
          }
          $reqPreparee->closeCursor();

          return $tabAll;
      }
}

?>
