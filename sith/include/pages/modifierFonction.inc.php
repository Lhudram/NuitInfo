<h1> Modifier une personne </h1>
<!-- VERIF ADMIN A FAIRE-->
<?php
if(!empty($_SESSION['admin']) && !empty($_SESSION['connexion'])){
	$pdo = new Mypdo();
	$PM = new PersonneManager($pdo);
	$etudiantManager = new EtudiantManager($pdo);
	$salarieManager = new SalarieManager($pdo);
	$fonctionManager = new FonctionManager($pdo);
	$divisionManager = new DivisionManager($pdo);
	$departementManager = new DepartementManager($pdo);
  $num = $_SESSION['numModif'];
  $fonction = $PM->fonctionPersonne($num);

  if(!empty($_POST['annee']) && !empty($_POST['dep'])){

		$ajout = $PM->ajouter($_SESSION['ajout']);
		$PM->modifierPersonne($ajout,$num);
		$per_num = $num;
		$dep_num = $departementManager->listerDepNum($_POST['dep']);
		$div_num = $divisionManager->listerDivNum($_POST['annee']);
    if($fonction == $_SESSION['fct']){
      $etudiantManager->modifierEtudiant(array($per_num, $dep_num, $div_num));
    }
    else {
      $salarieManager->supprimerSalarie($per_num);
      $etudiantManager->ajouterEtudiantModif(array($per_num, $dep_num, $div_num));
    }


		echo "<p> <img src='./image/valid.png' alt='Image validation'> L'étudiant(e) vient d'être modifié ! </p>";
		echo "<p>Redirection automatique dans 2 secondes.";
		header("Refresh:2,url='./index.php?page=0'");
	}
	elseif(!empty($_POST['telPro']) && !empty($_POST['fct'])){

		$ajout = $PM->ajouter($_SESSION['ajout']);
		$PM->modifierPersonne($ajout,$num);
		$per_num = $num;
		$fon_num = $fonctionManager->listerFonNum($_POST['fct']);
		$sal = (array($per_num, htmlspecialchars($_POST['telPro']), $fon_num));
    if($fonction == $_SESSION['fct']){
      $salarieManager->modifierSalarie(array($per_num, htmlspecialchars($_POST['telPro']), $fon_num));
    }
    else {
      $etudiantManager->supprimerEtudiant($per_num);
      $salarieManager->ajouterSalarieModif(array($per_num, htmlspecialchars($_POST['telPro']), $fon_num));
    }


		echo "<p> <img src='./image/valid.png' alt='Image validation'> Le salarié a été modifié ! </p>";
		echo "<p>Redirection automatique dans 2 secondes.";
		header("Refresh:2,url='./index.php?page=0'");
	}
	else {
    echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Une erreur est survenue lors du traitement de l'ajout ! </p>";
		echo "<p>Redirection automatique dans 2 secondes.";
		header("Refresh:2,url='./index.php?page=0'");
	}
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à modifier une personne ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
}

?>
