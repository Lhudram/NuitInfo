<?php
Class DepartementManager{
  public function __construct($db){
    $this->db = $db;
  }


  public function listerDep(){
    $liste = array();

    $sql = "SELECT DISTINCT(dep_nom), dep_num FROM departement";

    $req = $this->db->prepare($sql);
    $req->execute();

    while ($dep = $req->fetch(PDO::FETCH_OBJ)){

      $liste[] = new Departement($dep);

    }

    return $liste;
  }

  	public function listerDepNum($val){

  			$sql = "SELECT dep_num FROM departement WHERE dep_nom = '".$val."'";
  			$req = $this->db->prepare($sql);
  			$req->execute();

  			$div = $req->fetch();

  			return $div;
  	}
  public function listerDepNom($num){
    $sql = ("SELECT d.dep_nom FROM departement d, etudiant e WHERE e.per_num ='".$num."' AND e.dep_num = d.dep_num");

    $req = $this->db->prepare($sql);
    $req->execute();
    $dep_nom = $req->fetch();

    return $dep_nom;

  }
}
