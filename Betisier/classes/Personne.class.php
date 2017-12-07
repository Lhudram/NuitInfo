<?php
	class Personne extends PDO{
		private $per_num;
		private $per_nom;
		private $per_prenom;
		private $per_tel;
		private $per_mail;
		private $per_admin = 0;
		private $per_login;
		private $per_pwd;

		public function __construct($valeurs = array()){
			if(!empty($valeurs)){
				$this->affecte($valeurs);
			}
		}

		public function affecte($donnees) {
			foreach ($donnees as $attribut => $valeur) {

				switch ($attribut) {
					case 'per_nom':
						$this->setNom($valeur);
						break;
					case 'per_num':
						$this->setNum($valeur);
						break;
					case 'per_prenom':
						$this->setPrenom($valeur);
						break;
					case 'per_tel':
						$this->setTel($valeur);
						break;
					case 'per_mail':
						$this->setMail($valeur);
						break;
					case 'per_admin':
						$this->setAdmin($valeur);
						break;
					case 'per_login':
						$this->setLogin($valeur);
						break;
					case 'per_pwd':
						$this->setPwd($valeur);
						break;

					default:

						break;
				}
			}
		}

		public function setNom($per_nom) {
			$this->per_nom = $per_nom;
		}
		public function getNom() {
			return $this->per_nom;
		}

		public function setNum($per_num) {
			$this->per_num = $per_num;
		}
		public function getNum() {
			return $this->per_num;
		}

		public function setPrenom($per_prenom) {
			$this->per_prenom = $per_prenom;
		}

		public function getPrenom() {
			return $this->per_prenom;
		}

		public function setTel($tel) {
			$this->per_tel = $tel;
		}

		public function getTel() {
			return $this->per_tel;
		}

		public function setMail($mail) {
			$this->per_mail = $mail;
		}

		public function getMail() {
			return $this->per_mail;
		}

		public function setAdmin($admin) {
			$this->per_admin = $admin;
		}

		public function getAdmin() {
			return $this->per_admin;
		}

		public function setLogin($log) {
			$this->per_login = $log;
		}

		public function getLogin() {
			return $this->per_login;
		}

		public function setPwd($pwd) {
			$this->per_pwd = $pwd;
		}

		public function getPwd() {
			return $this->per_pwd;
		}

	}

?>
