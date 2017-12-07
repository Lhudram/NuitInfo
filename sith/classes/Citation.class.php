<?php
class Citation{
	private $cit_num;
	private $per_num;
	private $per_num_valide;
	private $per_num_etudiant;
	private $cit_libelle;
	private $cit_date;
	private $cit_valide;
	private $cit_date_valide;
	private $cit_date_depo;
	// Rajout -> Moyenne générale de la citation
	private $cit_moyenne;

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

				case 'cit_moyenne':
				$this->setCitMoy($valeur);
				break;

				case 'per_num':
				$this->setPerNum($valeur);
				break;

				case 'per_num_valide':
				$this->setPerNumValide($valeur);
				break;

				case 'cit_libelle':
				$this->setCitLib($valeur);
				break;

				case 'per_num_etu':
				$this->setPerNumEtu($valeur);
				break;

				case 'cit_date':
				$this->setCitDate($valeur);
				break;

				case 'cit_valide':
				$this->setCitVal($valeur);
				break;

				case 'cit_date_valide':
				$this->setCitDateVal($valeur);
				break;

				case 'cit_date_depo':
				$this->setCitDateDepo($valeur);
				break;

				default:
				break;
			}
		}
	}
	public function getCitNum(){
		return $this->cit_num;
	}
	public function setCitNum($val){
		$this->cit_num = $val;
	}

	public function getCitMoy(){
		return $this->cit_moyenne;
	}
	public function setCitMoy($val){
		$this->cit_moyenne = $val;
	}

	public function getPerNum(){
		return $this->per_num;
	}
	public function setPerNum($val){
		$this->per_num = $val;
	}

	public function getPerNumValide(){
		return $this->per_num_valide;
	}
	public function setPerNumValide($pernumval){
		$this->per_num_valide = $pernumval;
	}

	public function getPerNumEtu(){
		return $this->per_num_etudiant;
	}
	public function setPerNumEtu($pernumetu){
		$this->per_num_etudiant = $pernumetu;
	}

	public function getCitLib(){
		return $this->cit_libelle;
	}
	public function setCitLib($lib){
		$this->cit_libelle = $lib;
	}

	public function getCitDate(){
		return $this->cit_date;
	}
	public function setCitDate($date){
		$this->cit_date = $date;
	}

	public function getCitVal(){
		return $this->cit_valide;
	}
	public function setCitVal($val){
		$this->cit_valide = $val;
	}

	public function getCitDateVal(){
		return $this->cit_date_valide;
	}
	public function setCitDateVal($dav){
		$this->cit_date_valide = $dav;
	}

	public function getCitDateDepo(){
		return $this->cit_date_depo;
	}
	public function setCitDateDepo($da){
		$this->cit_date_depo = $da;
	}

}
