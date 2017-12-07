citnum pernum vot_valeur
<?php
Class Vote{
  private $cit_num;
  private $per_num;
  private $vot_valeur;

  public function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affecte($valeurs);
    }
  }

  public function affecte($donnees) {
    foreach ($donnees as $attribut => $valeur) {

      switch ($attribut) {
        case 'cit_num':
        $this->setCitNum($valeur);
        break;

        case 'per_num':
        $this->setPerNum($valeur);
        break;

        case 'vot_valeur':
        $this->setVotVal($valeur);
        break;

        default:
        break;
      }
    }
  }

  public function setCitNum($val){
    $this->cit_num = $val;
  }
  public function getCitNum(){
    return $this->cit_num;
  }

  public function setPerNum($val){
    $this->per_num = $val;
  }
  public function getPerNum(){
    return $this->per_num;
  }

  public function setVotVal($val){
    $this->vot_valeur = $val;
  }
  public function getVotVal(){
    return $this->vot_valeurs;
  }
} ?>
