<h1> Ajouter une personne </h1>
<?php
	if(!empty($_SESSION['connexion'])){
	$pdo = new Mypdo();
	$PM = new PersonneManager($pdo);
	$etudiantManager = new EtudiantManager($pdo);
	$salarieManager = new SalarieManager($pdo);
	$fonctionManager = new FonctionManager($pdo);
	$divisionManager = new DivisionManager($pdo);
	$departementManager = new DepartementManager($pdo);

	if(!empty($_POST['annee']) && !empty($_POST['dep'])){

		$ajout = $PM->ajouter($_SESSION['ajout']);
		$PM->ajouterPersonne($ajout);
		$per_num = $etudiantManager->listerPerNum($ajout);
		$dep_num = $departementManager->listerDepNum($_POST['dep']);
		$div_num = $divisionManager->listerDivNum($_POST['annee']);
		$etudiantManager->ajouterEtudiant(array($per_num, $dep_num, $div_num));

		echo "<p> <img src='./image/valid.png' alt='Image validation'> L'étudiant(e) vient d'être ajouté ! </p>";
		echo "<p>Redirection automatique dans 2 secondes.";
		header("Refresh:2,url='./index.php?page=0'");
	}
	elseif(!empty($_POST['telPro']) && !empty($_POST['fct'])){

		$ajout = $PM->ajouter($_SESSION['ajout']);
		$PM->ajouterPersonne($ajout);
		$per_num = $salarieManager->listerPerNum($ajout);
		$fon_num = $fonctionManager->listerFonNum($_POST['fct']);
		$sal = (array($per_num, htmlspecialchars($_POST['telPro']), $fon_num));
		$salarieManager->ajouterSalarie(array($per_num, htmlspecialchars($_POST['telPro']), $fon_num));

		echo "<p> <img src='./image/valid.png' alt='Image validation'> Le salarié a été ajouté ! </p>";
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
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à ajouter une personne ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
}

?>
