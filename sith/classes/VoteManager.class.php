<?php
	class VoteManager {
	public function __construct($db){
		$this->db = $db;
	}
  public function listerPerNum($pers){

    $sql = "SELECT per_num FROM personne WHERE per_login = '".$pers->getLogin()."'";
    $req = $this->db->prepare($sql);
    $req->execute();

    $div = $req->fetch();

    return $div;
  }
  public function ajouterNote($cit,$etu,$note){
    if(!empty($cit)){
      $sqlVerif = "SELECT vot_valeur FROM vote WHERE per_num = '".$etu->getNum()."' AND cit_num = '".$cit->getCitNum()."'";
      $req = $this->db->prepare($sqlVerif);
      $req->execute();

      $verif = $req->fetch();

      if(!empty($verif)){
        return false;
      }

      $sqlEnvoi = "INSERT INTO vote(cit_num, per_num, vot_valeur) VALUES (:c, :p, :v)";

      $req2 = $this->db->prepare($sqlEnvoi);
      $req2->bindValue(':c', $cit->getCitNum());
      $req2->bindValue(':p', $etu->getNum());
      $req2->bindValue(':v', $note);
      $req2->execute();

      return true;
    }
  }
}
?>
