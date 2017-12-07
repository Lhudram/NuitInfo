<?php
class PersonneManager{

	public function __construct($db){
		$this->db = $db;
	}
	public function listerNomParNum($num){
		if(!empty($num)){
			$pers = NULL;
			$sql = "SELECT per_nom, per_prenom FROM personne WHERE per_num = '".$num."'";
			$req = $this->db->prepare($sql);
			$req->execute();

			while ($per = $req->fetch(PDO::FETCH_OBJ)){

				$pers = new Personne($per);

			}
			return $pers;
		}
	}
	public function listerPersonnes(){
		$listeProf = array();

		$sql = ('SELECT p.per_num, p.per_nom FROM personne p');
		$req = $this->db->prepare($sql);
		$req->execute();

		while ($pers = $req->fetch(PDO::FETCH_OBJ)){


			$listeProf[] = new Personne($pers);

		}

		return $listeProf;
	}
	public function RecupNum($login){

		$sql = ("SELECT per_num, per_login FROM personne WHERE per_login = '".$login."'");
		$req = $this->db->prepare($sql);
		$req->execute();

		$pers = $req->fetch(PDO::FETCH_OBJ);

			$etu = new Personne($pers);

		return $etu;
	}
	public function listerPersonne(){
		$listePersonne = array();

		$sql = ('SELECT per_num, per_prenom, per_nom FROM personne');
		$req = $this->db->prepare($sql);
		$req->execute();

		while ($pers = $req->fetch(PDO::FETCH_OBJ)){


			$listePersonne[] = new Personne($pers);

		}

		return $listePersonne;
	}
	public function listerNbrPersonnes(){

			$sql = "SELECT COUNT(*) as nbr FROM personne";

			$req = $this->db->prepare($sql);
			$req->execute();

			$nbr = $req->fetch(PDO::FETCH_OBJ);

			return $nbr->nbr;
	}
	public function listerLogin($login,$loginDifferent){

		$sql = "SELECT per_login FROM personne WHERE per_login <>'".$loginDifferent."'";

		$req = $this->db->prepare($sql);
		$req->execute();

		while ($nbr = $req->fetch()) {

			if($nbr[0] === $login){
				return true;
			}
		}

		return false;
	}
	public function listerMail($mail,$mailDifferent){

		$sql = "SELECT per_mail FROM personne WHERE per_mail <>'".$mailDifferent."'";

		$req = $this->db->prepare($sql);
		$req->execute();

		while ($nbr = $req->fetch()) {

			if($nbr[0] === $mail){
				return true;
			}
		}

		return false;
	}
	public function listerModif($num){
		$listeModif = array();
		$sql = "SELECT * FROM personne WHERE per_num = '".$num."'";

		$req = $this->db->prepare($sql);
		$req->execute();

		while ($nbr = $req->fetch()) {
			$listeModif[] = new Personne($nbr);

		}

		return $listeModif;
	}


	public function detailPersonne($num){
		$listePersonne = array();

		$sql = ('SELECT per_prenom, per_mail, per_tel FROM personne WHERE per_num ='.$num);
		$req = $this->db->prepare($sql);
		$req->execute();

		while ($pers = $req->fetch(PDO::FETCH_OBJ)){


			$listePersonne[] = new Personne($pers);

		}

		return $listePersonne;
	}

	public function verifAdmin($login){
		if(isset($login)){
			$sql = ('SELECT per_admin FROM personne WHERE per_login = "'.$login.'"');
			$req = $this->db->prepare($sql);
			$req->execute();

			$resultat = $req->fetch();

				if($resultat[0] != 0){

					return true;
				}

			return false;
		}
	}
	public function fonctionPersonne($num){
		if(isset($num)){
			$listePersonne = array();

			$sql = ('SELECT per_num FROM etudiant');
			$req3 = $this->db->prepare($sql);
			$req3->execute();

			$i = 0;
			$fonction = 'vide';
			while ($pers = $req3->fetch(PDO::FETCH_OBJ)){


				$listePersonne[] = new Personne($pers);

				if($num===$listePersonne[$i]->getNum()){
					$fonction = 'etudiant';
				}
				$i = $i+1;

			}

			$listePersonne2 = array();

			$sql2 = ('SELECT per_num FROM salarie');
			$req2 = $this->db->prepare($sql2);
			$req2->execute();

			$i = 0;
			while ($pers2 = $req2->fetch(PDO::FETCH_OBJ)){


				$listePersonne2[] = new Personne($pers2);

				if($num===$listePersonne2[$i]->getNum()){
					$fonction = 'salarie';
				}
				$i = $i +1;

			}

			return $fonction;


		}

	}

	public function info1Personne($num,$fonction){
		if(isset($fonction) && isset($num)){

			$listeInfo = array();
			$pdo = new Mypdo();
			if ($fonction === 'etudiant'){
				$departementManager = new DepartementManager($pdo);
				return $departementManager->listerDepNom($num);
			}
			else if($fonction === 'salarie'){
				$salarieManager = new SalarieManager($pdo);
				return $salarieManager->listerSalTelPro($num);


			}
			else{

				return;
			}
			$req = $this->db->prepare($sql);
			$req->execute();
			$pers = $req->fetch(PDO::FETCH_OBJ);

			return $pers;
		}
	}

	public function info2Personne($num,$fonction){
		if(isset($fonction) && isset($num)){

			$listeInfo = array();
			$pdo = new Mypdo();
			if ($fonction === 'etudiant'){
				$villeManager = new VilleManager($pdo);
				return $villeManager->listerVilNom($num);

			}
			else if($fonction === 'salarie'){
				$villeManager = new FonctionManager($pdo);
				return $villeManager->listerFonLib($num);

			}
			else{

				return;
			}
			$req = $this->db->prepare($sql);
			$req->execute();
			$pers = $req->fetch(PDO::FETCH_OBJ);

			return $pers;
		}
	}

	public function ajouterPersonne($personne){
		if(isset($personne)){

			$sql = ("INSERT INTO personne(per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd) VALUES (:n, :p, :t, :m, :a, :l, :pwd)");
			$r = $this->db->prepare($sql);
			$r->bindValue(':n', $personne->getNom());
			$r->bindValue(':p', $personne->getPrenom());
			$r->bindValue(':t', $personne->getTel());
			$r->bindValue(':m', $personne->getMail());
			$r->bindValue(':a', $personne->getAdmin());
			$r->bindValue(':l', $personne->getLogin());
			$r->bindValue(':pwd', $personne->getPwd());
			$r->execute();


		}
	}
	public function modifierPersonne($personne,$num){
		if(isset($personne) && isset($num)){

			$listePers = array();
			$sql = ("UPDATE personne SET per_nom = :n, per_prenom = :p, per_tel = :t, per_mail = :m, per_admin = :a, per_login = :l, per_pwd = :pwd WHERE per_num = :num");
			$r = $this->db->prepare($sql);
			$r->bindValue(':n', $personne->getNom());
			$r->bindValue(':p', $personne->getPrenom());
			$r->bindValue(':t', $personne->getTel());
			$r->bindValue(':l', $personne->getLogin());
			$r->bindValue(':m', $personne->getMail());
			$r->bindValue(':a', $personne->getAdmin());
			$r->bindValue(':num', $num);
			$r->bindValue(':pwd', $personne->getPwd());
			$r->execute();
		}
	}
/*
	public function supprimerPersonne($login){
		if(isset($login)){
			$r = Mypdo::prepare("DELETE FROM personne WHERE per_login = :l");
			$r->bindValue(':l', $login);
			$r->execute();
			return Mypdo::lastInsertId();

		}
		return -1;
	}
*/
	public function ajouter($personne) {
		if (isset($personne)){

			if(is_array($personne)){
				$reqVerification = $this->db->prepare("SELECT per_login FROM personne WHERE per_login= ?");
				$reqVerification->execute(array($personne[5]));

				$perso = $reqVerification->fetch(PDO::FETCH_OBJ);

					$nouvPers = new Personne();
					$nouvPers->setNom($personne[0]);
					$nouvPers->setPrenom($personne[1]);
					$nouvPers->setTel($personne[2]);
					$nouvPers->setMail($personne[3]);
					$nouvPers->setLogin($personne[5]);
					$nouvPers->setPwd($personne[6]);

					return $nouvPers;
				}
			else{
				$reqVerification = $this->db->prepare("SELECT per_login FROM personne WHERE per_login= '".$personne->getLogin()."' AND per_pwd = '".$personne->getPwd()."'");
				$reqVerification->execute();

				while ($pers = $reqVerification->fetch(PDO::FETCH_OBJ)){
					$infosPerso = new Personne($pers);

					if($infosPerso->getLogin() === $personne->getLogin()){
						return true;
					}
				}
				return false;


			$reqVerification->closeCursor();

		}
	}
}

public function supprimerPersonne($num){
	if(!empty($num)){
		$sql = ("DELETE FROM vote WHERE per_num = '".$num."'");
		$req = $this->db->prepare($sql);
		$req->execute();

		$sql3 = ("DELETE FROM etudiant WHERE per_num = '".$num."'");
		$req3 = $this->db->prepare($sql3);
		$req3->execute();

		$sql4 = ("DELETE FROM salarie WHERE per_num = '".$num."'");
		$req4 = $this->db->prepare($sql4);
		$req4->execute();

		$sql5 = ("DELETE FROM personne WHERE per_num = '".$num."'");
		$req5 = $this->db->prepare($sql5);
		$req5->execute();
	}
}
}

?>
