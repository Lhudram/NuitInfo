<?php
Class FonctionManager{
  public function __construct($db){
    $this->db = $db;
  }
  public function listerFct(){
    $liste = array();

    $sql = "SELECT fon_num, fon_libelle FROM fonction";

    $req = $this->db->prepare($sql);
    $req->execute();

    while ($fct = $req->fetch(PDO::FETCH_OBJ)){

      $liste[] = new Fonction($fct);

    }
    return $liste;
  }

  //Inutile ???
  public function listerFonNum($val){
    $sql = "SELECT fon_num FROM fonction WHERE fon_libelle = '".$val."'";
    $req = $this->db->prepare($sql);
    $req->execute();

    $div = $req->fetch(PDO::FETCH_OBJ);

    return $div;
  }

  public function listerFonLib($num){
    if (!empty($num)){
      $sql = ("SELECT f.fon_libelle FROM fonction f, salarie s WHERE s.per_num = '".$num."' AND s.fon_num = f.fon_num");
      $req = $this->db->prepare($sql);
      $req->execute();

      $fon_lib = $req->fetch();

      return $fon_lib;
      }
  }
}
