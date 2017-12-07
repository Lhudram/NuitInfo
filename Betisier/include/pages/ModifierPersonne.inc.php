<h1>Modifier une personne enregistrées</h1>
<!-- VERIF ADMIN A FAIRE -->
<?php
if(!empty($_SESSION['admin']) && !empty($_SESSION['connexion'])){
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
if(!empty($_GET['num'])){
	$num = htmlspecialchars($_GET['num']);
	$testExiste = $personneManager->listerNomParNum($num);

	if(!empty($testExiste)){
		$infos = $personneManager->listerModif($num);

		if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['fonction']) || empty($_POST['tel']) || empty($_POST['mail']) || empty($_POST['login']) || empty($_POST['mdp'])) {
			?>
			<form action="" method="post">
				Nom : <input id="nom" type="text" name="nom" placeholder="Dupont" value="<?= $infos[0]->getNom() ?>"><br>
				Prénom : <input id="prenom" type="text" name="prenom" placeholder="Jean" value="<?= $infos[0]->getPrenom() ?>"><br>
				Téléphone : <input id="tel" type="tel" name="tel" pattern="[0-9]{10}" placeholder="0601020304" value="<?= $infos[0]->getTel() ?>"><br>
				Mail : <input id="mail" type="email" name="mail" placeholder="exemple@mail.fr" value="<?= $infos[0]->getMail() ?>"><br>
				Login : <input id="login" type="text" name="login" placeholder="JeanDupont123" value="<?= $infos[0]->getLogin() ?>"><br>
				Mot de passe : <input id="mdp" type="password" placeholder="*********" name="mdp"><br>
				<input type="radio" id="Etudiant" name="fonction" value="etudiant">
				<label for="etudiant">Etudiant</label>

				<input type="radio" id="Salarie" name="fonction" value="salarie">
				<label for="salarie">Personnel</label><br>
				<input type="submit" value="Valider">
			</form>
		<?php }
		else {

			$testAjout = $personneManager->listerLogin(htmlspecialchars($_POST['login']), $infos[0]->getLogin());
			$testAjoutMail = $personneManager->listerMail(htmlspecialchars($_POST['mail']), $infos[0]->getMail());
			$mdp = htmlspecialchars($_POST['mdp']);
			$salt = '!$1?;3';
			$mdp = md5(md5($mdp).$salt);
			$ajout = array(htmlspecialchars($_POST['nom']),htmlspecialchars($_POST['prenom']),htmlspecialchars($_POST['tel']),htmlspecialchars($_POST['mail']),0,htmlspecialchars($_POST['login']),$mdp);
			$_SESSION['numModif'] = $num;
			$_SESSION['ajout'] = $ajout;
			//Si login déjà utilisé
			if($testAjout){
				echo "<p> <img src='./image/erreur.png' alt='Image validation'> Ce login est déjà utilisé !</p>";
				echo "<p>Redirection automatique dans 2 secondes.";
				header("Refresh:2,url='./index.php?page=12&num=".$infos[0]->getNum()."'");
				unset($_POST['mdp']);
			}

			//Si mail déjà utilisé
			else if ($testAjoutMail){
				echo "<p> <img src='./image/erreur.png' alt='Image validation'> Ce mail est déjà utilisé !</p>";
				echo "<p>Redirection automatique dans 2 secondes.";
				header("Refresh:2,url='./index.php?page=12&num=".$infos[0]->getNum()."'");
				unset($_POST['mdp']);
			}

			//Sinon -> Salarié / Etudiant
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

				$fonction = htmlspecialchars($_POST['fonction']);
				$_SESSION['fct'] = $fonction;
				$mdp = htmlspecialchars($_POST['mdp']);
				$salt = '!$1?;3';
				$mdp = md5(md5($mdp).$salt);

				//Si la personne ne change pas de fonction (Salarié / Etudiant)

				if($fonction == "etudiant"){
					?><form method="post" action="./index.php?page=20">

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
				}
				else if($fonction == "salarie"){
					?>
					<form method="post" action="./index.php?page=20">

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
		}else {
			echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Ce numéro ne correspond à personne !</p>";
			echo "<p>Redirection automatique dans 2 secondes.";
			header("Refresh:2,url='./index.php?page=3");
		}
	}
	else {
		$liste = $personneManager->listerPersonne();
		$nbr = $personneManager->listerNbrPersonnes();
		?>

		<h1>Liste des personnes enregistrées</h1>
		<p> Actuellement <?= $nbr ?> personnes sont enregistrées </p>
		<table class="table">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<?php
					$_SESSION['admin'] = 'admin';
					if(isset($_SESSION['admin'])){
						echo "<th>Modifier</th>";
					} ?>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($liste as $pers){
					?>
					<tr>
						<td><?= $pers->getNom() ?></td>
						<td><?= $pers->getPrenom() ?></td>
						<?php
						echo "<td><a href='./index.php?page=3&amp;num=".$pers->getNum()."'><img src='./image/modifier.png' alt='Image modification'></a></td>";
						?>

					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
	}
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à modifier une personne ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
}?>
