<?php
class Ville{
	private $vil_num;
	private $vil_nom;

	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees) {
		foreach ($donnees as $attribut => $valeur) {

			switch ($attribut) {
				case 'vil_num':
				$this->setVilleNum($valeur);
				break;
				case 'vil_nom':
				$this->setVilleNom($valeur);
				break;

				default:

				break;
			}
		}
	}
	public function getVilleNum(){
		return $this->vil_num;
	}
	public function setVilleNum($num){
		$this->vil_num = $num;
	}

	public function getVilleNom(){
		return $this->vil_nom;
	}
	public function setVilleNom($nom){
		$this->vil_nom = $nom;
	}
}