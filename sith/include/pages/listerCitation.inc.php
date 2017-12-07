<?php
$pdo = new Mypdo();
$citationManager = new CitationManager($pdo);
$personneManager = new PersonneManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$citations = $citationManager->listerCitations();
$citations2 = $citationManager->listerMoyennes($citations);
$nbr = $citationManager->listerNbrCitations();
$voteManager = new VoteManager($pdo);
$etu = $personneManager->RecupNum($_SESSION['connexion']);

?>
<h1>Liste des citations déposées</h1>
<p> Actuellement <?= $nbr ?> citations sont enregistrées (valides et non nulles ! :)) </p>
<table class="table">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Libellé</th>
			<th>Date</th>
			<th>Moyenne des notes</th>
			<th>Noter</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($citations2 as $citation){
			$date= $citation->getCitDate();
			$date = explode("-", $date);
			$newsdate= $date[2].'/'.$date[1].'/'.$date[0];
			$estEtudiant = $etudiantManager->estUnEtudiant($etu->getNum());
			$aVote = $citationManager->aVote(array($citation->getCitNum(), $etu->getNum()));
			$pers = $personneManager->listerNomParNum($citation->getPerNum());
			?>
			<tr>
				<td><?php echo $pers->getPrenom(), " " , $pers->getNom() ?></td>
				<td><?= $citation->getCitLib() ?></td>
				<td><?= $newsdate ?></td>
				<td><?= $citation->getCitMoy() ?></td>
				<td><?php if($estEtudiant && !$aVote){ ?><a href="./index.php?page=9&amp;cit=<?= $citation->getCitNum() ?>"><img src='./image/modifier.png' alt='Image modif'></a><?php
				}
				else{ ?>
					<img src='./image/erreur.png' alt='Image erreur'>
					<?php
				} ?></td>

			</tr>
			<?php
		}
		?>
	</tbody>
</table>
