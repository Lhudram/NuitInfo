<?php
class CitationManager {
	public function __construct($db){
		$this->db = $db;
	}

	public function listerCitations(){
		$listeCitation = array();

		$sql = "SELECT p.per_nom, p.per_prenom, c.cit_libelle, c.cit_date, c.per_num, c.cit_num FROM citation c JOIN personne p ON c.per_num = p.per_num WHERE c.cit_valide = 1 AND c.cit_date_valide <> 'NULL' ORDER BY c.cit_date_valide ";

		$req = $this->db->prepare($sql);
		$req->execute();

		while ($citation = $req->fetch(PDO::FETCH_OBJ)){


			$listeCitation[] = new Citation($citation);

		}

		return $listeCitation;
	}
	//A retirer
	public function listerToutesCitations(){
		$listeCitation = array();

		$sql = "SELECT p.per_nom, p.per_prenom, c.cit_libelle, c.cit_date, c.per_num, c.cit_num FROM citation c JOIN personne p ON c.per_num = p.per_num WHERE c.cit_valide = 1 AND c.cit_date_valide <> 'NULL' ORDER BY c.cit_date_valide ";

		$req = $this->db->prepare($sql);
		$req->execute();

		while ($citation = $req->fetch(PDO::FETCH_OBJ)){


			$listeCitation[] = new Citation($citation);

		}

		return $listeCitation;
	}
	public function listerCitNonVal(){
		$listeCitation = array();

		$sql = "SELECT p.per_nom, p.per_prenom, c.cit_libelle, c.cit_date, c.per_num, c.cit_num FROM citation c JOIN personne p ON c.per_num = p.per_num WHERE c.cit_valide = 0";

		$req = $this->db->prepare($sql);
		$req->execute();

		while ($citation = $req->fetch(PDO::FETCH_OBJ)){


			$listeCitation[] = new Citation($citation);

		}

		return $listeCitation;
	}

	public function listerNbrCitations(){

		$sql = "SELECT COUNT(*) as nbr FROM citation WHERE cit_valide = 1 AND cit_date_valide <> 'NULL' ORDER BY cit_date_valide";

		$req = $this->db->prepare($sql);
		$req->execute();

		$nbr = $req->fetch(PDO::FETCH_OBJ);

		return $nbr->nbr;
	}
	public function listerNbrCitNonVal(){

		$sql = "SELECT COUNT(*) as nbr FROM citation WHERE cit_valide = 0";

		$req = $this->db->prepare($sql);
		$req->execute();

		$nbr = $req->fetch(PDO::FETCH_OBJ);

		return $nbr->nbr;
	}

	public function listerMoyennes($citations){
		if (isset($citations)){
			$listeMoy = array();
			foreach ($citations as $cit => $valeur) {


				$sql2 = "SELECT AVG(vot_valeur) as cit_moyenne FROM vote WHERE cit_num = ? ";
				$req2 = $this->db->prepare($sql2);

				$req2->execute(array($valeur->getCitNum()));

				while ($citation = $req2->fetch(PDO::FETCH_OBJ)){
					$listeMoy[$cit] = new Citation();
					$valeur->setCitMoy($citation->cit_moyenne);
					$listeMoy[$cit] = $valeur;
				}

			}

			return $listeMoy;
		}
	}
	public function testDate($value){
		return (preg_match("^[0-3][0-9]/[0-1][0-9]/[0-9]{4}$^",$value));
	}
	public function aVote($tableau){
		if (isset($tableau)){

			$sql = ("SELECT per_num FROM vote WHERE cit_num =".$tableau[0]." AND per_num = ".$tableau[1]."");
			$r = $this->db->prepare($sql);
			$r->execute();
			$resultat = $r->fetch();

			if (!empty($resultat)){
				return true;
			}
			return false;
		}
	}
	public function ajouterCitation($tab){
		if(isset($tab)){

			$sql = ("INSERT INTO citation(per_num, per_num_valide, per_num_etu, cit_libelle, cit_date, cit_valide, cit_date_valide, cit_date_depo) VALUES (:pn, :pnv, :pne, :cl, :cd, 0, :cdv, NOW())");
			$r = $this->db->prepare($sql);

			$membres = explode('/', $tab[1]);
			if(isset($membres[2])){
				$membres = explode('/', $tab[1]);
				$tab[1] = $membres[2]."-".$membres[1]."-".$membres[0];
			}else{
				$membres = explode('-', $tab[1]);
				$tab[1] = $membres[0]."-".$membres[1]."-".$membres[2];
			}
			//print_r($tab);
			$r->bindValue(':pn', $tab[0]);
			$r->bindValue(':pnv', NULL);
			$r->bindValue(':pne', $tab[3]->getNum());
			$r->bindValue(':cl', $tab[2]);
			$r->bindValue(':cd', $tab[1]);
			$r->bindValue(':cdv', NULL);

			$r->execute();

		}
	}

	public function listerCitNum($num){
		if (isset($num)){
			$sql = ("SELECT cit_num, per_num, per_num_etu, cit_libelle, cit_date FROM citation WHERE cit_num ='".$num."' AND cit_valide = 1 AND per_num_valide <> 'NULL' AND cit_date_valide <> 'NULL' ");

			$req = $this->db->prepare($sql);
			$req->execute();

			$resultat = $req->fetch(PDO::FETCH_OBJ);

			if (!empty($resultat)){
				$citation = new Citation($resultat);
				return $citation;
			}

		}
	}
	public function listerCitNumSansVerif($num){
		if (isset($num)){
			$sql = ("SELECT cit_num, per_num, per_num_etu, cit_libelle, cit_date FROM citation WHERE cit_num ='".$num."'");

			$req = $this->db->prepare($sql);
			$req->execute();

			$resultat = $req->fetch(PDO::FETCH_OBJ);

			if (!empty($resultat)){
				$citation = new Citation($resultat);
				return $citation;
			}

		}
	}
	public function rechercherCitation($rec){
		if(isset($rec) && !empty($rec)){
			$resultat = array();
			$sql = ("SELECT p.per_nom, p.per_prenom, c.cit_libelle, c.cit_date, c.per_num, c.cit_num FROM citation c JOIN personne p ON c.per_num = p.per_num WHERE c.cit_valide = 1 AND c.cit_date_valide <> 'NULL' AND p.per_nom LIKE  '%".$rec[0]."%' AND c.cit_date LIKE '%".$rec[1]."%' ORDER BY c.cit_num");

			$req = $this->db->prepare($sql);
			$req->execute();

			while($citation = $req->fetch()){
				$resultat[] = new Citation($citation);
			}

			return $resultat;

		}
	}
	public function verifCitNonVal($cit){
		if(isset($cit) && !empty($cit)){
			$resultat = array();
			$sql = ("SELECT * FROM citation WHERE cit_valide = 0 AND cit_num ='".$cit->getCitNum()."'");

			$req = $this->db->prepare($sql);
			$req->execute();

			while($citation = $req->fetch()){
				$resultat[] = new Citation($citation);
			}

			return $resultat;

		}
	}

	public function validerCitation($cit,$pernum){
		if(isset($cit) && !empty($cit) && isset($pernum) && !empty($pernum)){
			$resultat = array();
			$sql = ("UPDATE citation SET per_num_valide = '".$pernum."', cit_date_valide = NOW(), cit_valide = 1 WHERE cit_num = '".$cit[0]->getCitNum()."' ");

			$req = $this->db->prepare($sql);
			$req->execute();

			return $resultat;
		}
	}
	public function supprimerCitation($cit){
		if(isset($cit) && !empty($cit)){

			$sql = ("DELETE FROM vote WHERE cit_num = '".$cit->getCitNum()."'");
			$req = $this->db->prepare($sql);
			$req->execute();

			$sql2 = ("DELETE FROM citation WHERE cit_num = '".$cit->getCitNum()."'");
			$req2 = $this->db->prepare($sql2);
			$req2->execute();

		}
	}
	public function listerCitPerNum($pernum){
		if (isset($pernum)){
			$citation = array();
			$sql = ("SELECT cit_num, per_num, per_num_etu, cit_libelle, cit_date FROM citation WHERE per_num ='".$pernum."'");

			$req = $this->db->prepare($sql);
			$req->execute();

			$resultat = $req->fetch(PDO::FETCH_OBJ);

			if (!empty($resultat)){
				$citation[] = new Citation($resultat);
				return $citation;
			}

		}
	}
}
