
<h1>Liste des citations à valider</h1>
<?php

if(!empty($_SESSION['connexion']) && !empty($_SESSION['admin'])){
$pdo = new Mypdo();
$citationManager = new CitationManager($pdo);
$personneManager = new PersonneManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$citations = $citationManager->listerCitNonVal();
$nbr = $citationManager->listerNbrCitNonVal();

if(empty($_GET['cit']) || empty($_GET['do'])){
	?>


	<?php if($nbr != 0) {
		?>
		<p> Actuellement <?= $nbr ?> citations ne sont pas encore validées ! </p>
		<table class="table">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Libellé</th>
					<th>Date</th>
					<th>Valider</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($citations as $citation){
					$date= $citation->getCitDate();
					$date = explode("-", $date);
					$newsdate= $date[2].'/'.$date[1].'/'.$date[0];
					$pers = $personneManager->listerNomParNum($citation->getPerNum());
					?>
					<tr>
						<td><?= $pers->getPrenom(), " ",$pers->getNom() ?></td>
						<td><?= $citation->getCitLib() ?></td>
						<td><?= $newsdate ?></td>
						<td>
							<a href="./index.php?page=18&amp;do=v&amp;cit=<?= $citation->getCitNum() ?>"><img src='./image/valid.png' alt='Image valid'></a>
						</td>
						<td>
							<a href="./index.php?page=18&amp;do=s&amp;cit=<?= $citation->getCitNum() ?>"><img src='./image/erreur.png' alt='Image suppression'></a>
						</td>

					</tr>
					<?php
				}
			}
			else {
				echo "<p><img src='./image/erreur.png' alt='Image erreur'> Aucune citation à valider ! </p>";
				echo "<p> Vous allez être redirigé dans 2 secondes ! </p>";
				header("Refresh:2,url='./index.php?page=6'");
			}
		}
		else {
			$num = htmlspecialchars($_GET['cit']);
			$todo = htmlspecialchars($_GET['do']);
			if($todo=="v"){

				$citExiste = $citationManager->listerCitNumSansVerif($num);
				$pernum = $personneManager->RecupNum($_SESSION['connexion']);

				if(!empty($citExiste)){
					$citNonVal = $citationManager->verifCitNonVal($citExiste);
					if(!empty($citNonVal)){
						$citationManager->validerCitation($citNonVal,$pernum->getNum());
						echo "<p><img src='./image/valid.png' alt='Image validation'> Cette citation vient d'être validé ! </p>";
						echo "<p> Vous allez être redirigé dans 2 secondes ! </p>";
						header("Refresh:2,url='./index.php?page=18'");
					}
					else {
						echo "<p><img src='./image/erreur.png' alt='Image erreur'> Cette citation est déjà validée ! </p>";
						echo "<p> Vous allez être redirigé dans 2 secondes ! </p>";
						header("Refresh:2,url='./index.php?page=18'");
					}
				}
			}
			else if($todo=="s"){
				$citExiste = $citationManager->listerCitNumSansVerif($num);
				$citationManager->supprimerCitation($citExiste);
				echo "<p><img src='./image/valid.png' alt='Image validation'> Cette citation vient d'être supprimée ! </p>";
				echo "<p> Vous allez être redirigé dans 2 secondes ! </p>";
				header("Refresh:2,url='./index.php?page=19'");
			}
			else {
				echo "<p><img src='./image/erreur.png' alt='Image erreur'> Cette citation n'existe pas ! </p>";
				echo "<p> Vous allez être redirigé dans 2 secondes ! </p>";
				header("Refresh:2,url='./index.php?page=18'");
			}

		}

		?>
	</tbody>
</table>
<?php
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à valider une citation ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
} ?>
