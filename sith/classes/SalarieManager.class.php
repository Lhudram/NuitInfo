<?php
	Class SalarieManager{
		public function __construct($db){
		$this->db = $db;
	}
		public function listerTel(){
			$liste = array();

			$sql = "SELECT sal_telprof FROM salarie";

			$req = $this->db->prepare($sql);
			$req->execute();

			while ($tel = $req->fetch(PDO::FETCH_OBJ)){

				$liste[] = new Salarie($tel);

			}

			return $liste;
		}

		public function listerPerNum($pers){
			if(isset($pers)){

			$sql = "SELECT per_num FROM personne WHERE per_mail = '".$pers->getMail()."'";
			$req = $this->db->prepare($sql);
			$req->execute();

			$div = $req->fetch();

			return $div;
			}
		}
		public function listerSalTelPro($num) {
			if(isset($num)){
				$sql = ("SELECT sal_telprof FROM salarie WHERE per_num = '".$num."'");
				$req = $this->db->prepare($sql);
				$req->execute();

				$tel = $req->fetch();

				return $tel;
			}
		}

		public function ajouterSalarie($sal){
			if(isset($sal)){

			$sql = ("INSERT INTO salarie(per_num, sal_telprof, fon_num) VALUES (:p, :tel, :fon)");
			$r = $this->db->prepare($sql);
			$r->bindValue(':p', $sal[0]["per_num"]);
			$r->bindValue(':tel', $sal[1]);
			$r->bindValue(':fon', $sal[2]->fon_num);
			$r->execute();
			}
		}
	public function ajouterSalarieModif($sal){
			if(isset($sal)){

			$sql = ("INSERT INTO salarie(per_num, sal_telprof, fon_num) VALUES (:p, :tel, :fon)");
			$r = $this->db->prepare($sql);
			$r->bindValue(':p', $sal[0]);
			$r->bindValue(':tel', $sal[1]);
			$r->bindValue(':fon', $sal[2]->fon_num);
			$r->execute();
			}
		}

		public function modifierSalarie($sal){
			if(isset($sal)){

			$sql = ("UPDATE salarie SET sal_telprof = :tel, fon_num = :fon WHERE per_num = :p");
			$r = $this->db->prepare($sql);
			$r->bindValue(':p', $sal[0]["per_num"]);
			$r->bindValue(':tel', $sal[1]);
			$r->bindValue(':fon', $sal[2]->fon_num);
			$r->execute();
			}
		}

		public function supprimerSalarie($num){
			if(!empty($num)){
			$sql = ("DELETE FROM salarie WHERE per_num = '".$num."'");
			$r = $this->db->prepare($sql);
			$r->execute();
			}
		}
	}
