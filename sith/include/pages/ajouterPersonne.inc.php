	<h1>Ajouter une personne</h1>

	<?php
	if(!empty($_SESSION['connexion'])){
	//Formulaire pour ajouter une nouvelle personne
	if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['fonction']) || empty($_POST['tel']) || empty($_POST['mail']) || empty($_POST['login']) || empty($_POST['mdp']) || empty($_POST['mdp_conf'])) {

 ?>
	<form action="" method="post">
		Nom : <input id="nom" type="text" name="nom" placeholder="Dupont" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>"><br>
		Prénom : <input id="prenom" type="text" name="prenom" placeholder="Jean" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>"><br>
		Téléphone : <input id="tel" name="tel" pattern="[0-9]{10}" placeholder="0601020304" value="<?php if(isset($_POST['tel'])) echo $_POST['tel']; ?>"><br>
		Mail : <input id="mail" type="email" name="mail" placeholder="exemple@exemple.fr" value="<?php if(isset($_POST['mail'])) echo $_POST['mail']; ?>"><br>
		Login : <input id="login" type="text" name="login" placeholder="jeandupont1" value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>"><br>
		Mot de passe : <input id="mdp" type="password" placeholder="*******" name="mdp" ><br>
		Confirmer mdp : <input id="mdp_conf" type="password" placeholder="*******" name="mdp_conf" ><br>
		<input type="radio" id="Etudiant" name="fonction" value="Etudiant">
		<label for="Etudiant">Etudiant</label>

		<input type="radio" id="Salarie" name="fonction" value="Salarie">
		<label for="Salarie">Personnel</label><br>
		<input type="submit" value="Valider">
	</form>
	<?php
}
else{
	// Mdp et Mdp de vérification correspondent
	if($_POST['mdp'] == $_POST['mdp_conf'] && $_POST['mdp'] !== ''){
		$pdo = new Mypdo();
		$PM = new PersonneManager($pdo);
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$mail = htmlspecialchars($_POST['mail']);
		$tel = htmlspecialchars($_POST['tel']);
		$login = htmlspecialchars($_POST['login']);
		$mdp = htmlspecialchars($_POST['mdp']);
		$salt = '!$1?;3';
		$mdp = md5(md5($mdp).$salt);
		$_SESSION['ajout'] = (array($nom, $prenom, $tel, $mail, 0, $login, $mdp));
		$ajout = $_SESSION['ajout'];
		$mail1 = $PM->listerMail($_POST['mail'], "");
		$testAjout = $PM->listerLogin($ajout[5], "");

		// Login déjà utilisé
		if($testAjout){
			echo "<p> <img src='./image/erreur.png' alt='Image validation'> Ce login est déjà utilisé !</p>";
			echo "<p>Redirection automatique dans 2 secondes.";
			header("Refresh:2,url='./index.php?page=1'");
			unset($_POST['mdp']);
			unset($_POST['mdp_conf']);

		// Nouvelle personne à ajouter
		}elseif($mail1 === true){
			echo "<p> <img src='./image/erreur.png' alt='Image validation'> Ce mail est déjà utilisé !</p>";
			echo "<p>Redirection automatique dans 2 secondes.";
			header("Refresh:10,url='./index.php?page=1'");
			unset($_POST['mail']);
		}
		else {

			$etudiantManager = new EtudiantManager($pdo);
			$salarieManager = new SalarieManager($pdo);
			$fonctionManager = new FonctionManager($pdo);
			$departementManager = new DepartementManager($pdo);
			$divisionManager = new DivisionManager($pdo);

			$listerDep = $departementManager->listerDep();
			$listerDiv = $divisionManager->listerDiv();
			$listerTel = $salarieManager->listerTel();
			$listerFct = $fonctionManager->listerFct();

			// Si la personne est un étudiant
			if($_POST['fonction'] === 'Etudiant'){

				?><form method="post" action="./index.php?page=16">

					Année :
					<select name="annee" id="annee">

						<?php

						foreach ($listerDiv as $div){
							?>
							<option value="<?= $div->getDivNom() ?>"><?= $div->getDivNom() ?></option>
							<?php

						}

						?>
					</select>

					Département :
					<select name="dep" id="dep">

						<?php

						foreach ($listerDep as $dep){
							?>
							<option value="<?= $dep->getDepNom() ?>"><?= $dep->getDepNom() ?></option>
							<?php

						}

						?>

					</select>
					<input type="submit" value="Valider">
				</form>
				<?php


			// Si la personne est un salarié
			}elseif ($_POST['fonction'] === 'Salarie'){
				?>
				<form method="post" action="./index.php?page=16">

					Tel. Pro :
					<input id="telPro" type="tel" name="telPro" pattern="[0-9]{10}" ><br>

					Fonction :
					<select name="fct" id="fct">

						<?php

						foreach ($listerFct as $fct){
							?>
							<option value="<?= $fct->getFonLib()?>"><?= $fct->getFonLib() ?></option>
							<?php

						}

						?>

					</select>
					<input type="submit"  value="Valider" />


		<?php


	}


}

}
// Mdp et Mdp de vérification ne correspondent pas
else{
	echo "<p> <img src='./image/erreur.png' alt='Image validation'> Les mots de passes ne correspondent pas ! </p>";
	unset($_POST['mdp']);
	unset($_POST['mdp_conf']);
}

}
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à ajouter une personne ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
}

?>
