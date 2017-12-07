<?php
	class VilleManager {
	public function __construct($db){
		$this->db = $db;
	}

	public function lister(){
			$listeVille = array();

			$sql = "SELECT vil_num, vil_nom FROM ville  WHERE vil_num <> 0 ORDER BY vil_num";

			$req = $this->db->prepare($sql);
			$req->execute();

			while ($ville = $req->fetch(PDO::FETCH_OBJ)){

				$listeVille[] = new Ville ($ville);

			}

			$req->closeCursor();

			return $listeVille;
		}
	public function listerVilNom($num){
		if (!empty($num)){
			$sql = ("SELECT v.vil_nom FROM ville v, departement d, etudiant e WHERE d.vil_num = v.vil_num AND d.dep_num = e.dep_num AND e.per_num = '".$num."'");
			$req = $this->db->prepare($sql);
			$req->execute();

			$ville_nom = $req->fetch();

			return $ville_nom;
		}
	}
	public function listerNbrVilles(){

			$sql = "SELECT COUNT(*) as nbr FROM ville";

			$req = $this->db->prepare($sql);
			$req->execute();

			$nbr = $req->fetch();

			return $nbr[0];
	}

	public function ajouter($nom){
		$listeVille = array();

		$sql = "SELECT vil_nom FROM ville WHERE vil_nom = '".$nom."'";

		$req = $this->db->prepare($sql);
		$req->execute();

		$ville = $req->fetch();
			if(!empty($ville)){
				return false;
			}

		$req->closeCursor();


		$sql = "INSERT INTO ville(vil_nom) VALUES (:vn)";
		$req = $this->db->prepare($sql);
		$req->bindValue(':vn', $nom);
		$req->execute();
		return true;
	}
	public function existeAvecNom($nom){
		$sql = "SELECT vil_nom FROM ville WHERE vil_nom = '".$nom."'";
		$req = $this->db->prepare($sql);
		$req->execute();

		$res = $req->fetch();
		if(!empty($res)){
			return true;
		}
		return false;

	}
	public function recupNum($nom){
		if (isset($nom)){
			$sql = ("SELECT vil_num FROM ville WHERE vil_nom = '".$nom."'");
			$req = $this->db->prepare($sql);
			$req->execute();

			$resultat = $req->fetch();

			return $resultat[0];
		}
	}
	public function modifier($ancienNom,$nouveauNom){
		if(!empty($ancienNom) && !empty($nouveauNom)){

			$sql = "UPDATE ville SET vil_nom = '".$nouveauNom."' WHERE vil_nom = '".$ancienNom."'";
			$req = $this->db->prepare($sql);
			$req->execute();

		}
	}
	public function supprimer($num){
		if(!empty($num)){
			$sql = "UPDATE departement SET vil_num = '0' WHERE vil_num = '".$num."'";
			$req = $this->db->prepare($sql);
			$req->execute();

			$sql2 = "DELETE FROM ville WHERE vil_num = '".$num."'";
			$req2 = $this->db->prepare($sql2);
			$req2->execute();
		}
	}
}
