	<?php
	if(!empty($_SESSION['connexion'])){
		$num = htmlspecialchars($_GET['num']);
		$nom = htmlspecialchars($_GET['nom']);

		$pdo = new Mypdo();
		$personneManager = new PersonneManager($pdo);
		$liste = $personneManager->detailPersonne($num);
		$fonction = $personneManager->fonctionPersonne($num);
		$liste2 = $personneManager->info1Personne($num,$fonction);
		$liste3 = $personneManager->info2Personne($num,$fonction);


		switch ($fonction) {
			case 'etudiant':
				$type = "l'étudiant(e) ";
				$info1 = "Département";
				$info2 = "Ville";
				$afficher = true;
				break;

			case 'salarie':
				$type = "le salarié ";
				$info1 = "Tel pro";
				$info2 = "Fonction";
				$afficher = true;
				break;

			default:
				$afficher = false;
				break;
		}

		if ($afficher === true){
	?>
	<h1> Détail sur <?=$type, $nom?> </h1>

	<table class="table">
	<thead>
		<tr>
			<th>Prénom</th>
			<th>Mail</th>
			<th>Tel</th>
			<th><?= $info1 ?></th>
			<th><?= $info2 ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
	foreach ($liste as $pers){
		?>
		<tr>
			<td><?= $pers->getPrenom() ?></td>
			<td><?= $pers->getMail() ?></td>
			<td><?= $pers->getTel() ?></td>
			<td><?php if($fonction === 'etudiant'){ echo $liste2[0]; } else { echo $liste2[0]; } ?></td>
			<td><?php if($fonction === 'etudiant'){ echo $liste3[0]; } else { echo $liste3[0]; } ?></td>

		</tr>
	<?php
	}
	?>
	</tbody>
	</table>

	<?php
}else {
	echo "<h1>Le numéro de la personne n'apparaît pas dans la base de données </h1>";
}
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à afficher les détails d'une personne ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
} ?>
