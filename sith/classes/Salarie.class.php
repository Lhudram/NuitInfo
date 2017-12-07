<?php
Class Salarie{
	private $per_num;
	private $sal_telprof;
	private $fon_num;

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

				case 'sal_telprof':
				$this->setSalTel($valeur);
				break;

				case 'fon_num':
				$this->setFonNum($valeur);
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

	public function getSalTel(){
		return $this->sal_telprof;
	}
	public function setSalTel($tel){
		$this->sal_telprof = $tel;
	}

	public function getFonNum(){
		return $this->fon_num;
	}
	public function setFonNum($fon){
		$this->fon_num = $fon;
	}


}
