<?php

class UtilisateurManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function add($utilisateur)
    {

        $reqSQL = 'INSERT INTO utilisateur VALUES (:idutilisateur, :login:, :pwd, :estsam)';
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->bindValue(':idutilisateur', $utilisateur->getIdutilisateur());
        $reqPreparee->bindValue(':login', $utilisateur->getLogin());
        $reqPreparee->bindValue(':pwd', $utilisateur->getPwd());
        $reqPreparee->bindValue(':estsam', $utilisateur->getEstsam());
        $reqPreparee->execute();
    }

    public function getAll()
    {

        $tabAll = array();

        $reqSQL = "SELECT idutilisateur, login, pwd, estsam FROM utilisateur";
        $reqPreparee = $this->db->prepare($reqSQL);
        $reqPreparee->execute();

        while ($utilisateur = $reqPreparee->fetch(PDO::FETCH_OBJ)) {
            $tabAll[] = new Utilisateur($utilisateur->idutilisateur,
                                        $utilisateur->login,
                                        $utilisateur->pwd,
                                        $utilisateur->estsam,
                                      );
        }
        $reqPreparee->closeCursor();

        return $tabAll;
    }
}

?>
