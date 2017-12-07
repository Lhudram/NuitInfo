<?php
	Class EtudiantManager{
		public function __construct($db){
			$this->db = $db;
		}

		public function estUnEtudiant($num){
			$sql = "SELECT per_num FROM etudiant WHERE per_num = '".$num."'";
			$req = $this->db->prepare($sql);
			$req->execute();

			$div = $req->fetch();
			if (!empty($div)){
				return true;
			}
			return false;
		}
		public function listerPerNum($pers){
			if(!empty($pers)){
			$sql = "SELECT per_num FROM personne WHERE per_mail = '".$pers->getMail()."'";
			$req = $this->db->prepare($sql);
			$req->execute();

			$div = $req->fetch(PDO::FETCH_OBJ);

			return $div;
			}
		}

		public function ajouterEtudiant($etu){
			if(isset($etu)){
			$sql = ("INSERT INTO etudiant(per_num, dep_num, div_num) VALUES (:p, :dep, :div)");
			$r = $this->db->prepare($sql);
			$r->bindValue(':p', $etu[0]->per_num);
			$r->bindValue(':dep', $etu[1]['dep_num']);
			$r->bindValue(':div', $etu[2]['div_num']);
			$r->execute();
			}
		}

		public function ajouterEtudiantModif($etu){
			if(isset($etu)){
			$sql = ("INSERT INTO etudiant(per_num, dep_num, div_num) VALUES (:p, :dep, :div)");
			$r = $this->db->prepare($sql);
			$r->bindValue(':p', $etu[0]);
			$r->bindValue(':dep', $etu[1]['dep_num']);
			$r->bindValue(':div', $etu[2]['div_num']);
			$r->execute();
			}
		}

		public function modifierEtudiant($etu){
			if(isset($etu)){

			$sql = ("UPDATE etudiant SET dep_num = :dep, div_num = :div WHERE per_num = :p");
			$r = $this->db->prepare($sql);
			$r->bindValue(':p', $etu[0]);
			$r->bindValue(':dep', $etu[1]['dep_num']);
			$r->bindValue(':div', $etu[2]['div_num']);
			$r->execute();
			}
		}

		public function supprimerEtudiant($num){
			if(!empty($num)){
			$sql = ("DELETE FROM etudiant WHERE per_num = '".$num."'");
			$r = $this->db->prepare($sql);
			$r->execute();

			$sql2 = ("DELETE FROM vote WHERE per_num = '".$num."'");
			$r2 = $this->db->prepare($sql2);
			$r2->execute();
			}
		}
	}
