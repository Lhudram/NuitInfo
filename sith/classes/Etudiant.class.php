<?php
Class Etudiant{
	private $per_num;
	private $dep_num;
	private $div_num;
	private $vote_cit_nom; // Inutile
	private $vote_cit_num; // Inutile 


	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees) {
		foreach ($donnees as $attribut => $valeur) {

			switch ($attribut) {
				case 'per_num':
				$this->setPerNum($valeur);
				break;

				case 'dep_num':
				$this->setDepNum($valeur);
				break;

				case 'div_num':
				$this->setDivNum($valeur);
				break;

				default:
				break;
			}
		}
	}
	public function getPerNum(){
		return $this->per_num;
	}
	public function setPerNum($per){
		$this->per_num = $per;
	}

	public function getDepNum(){
		return $this->dep_num;
	}
	public function setDepNum($depnum){
		$this->dep_num = $depnum;
	}
	public function getDivNum(){
		return $this->div_num;
	}
	public function setDivNum($divnum){
		$this->div_num = $divnum;
	}


}
