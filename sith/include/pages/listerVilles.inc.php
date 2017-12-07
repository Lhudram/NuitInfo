<?php
	require_once("classes/Mypdo.class.php");
	require_once("classes/Ville.class.php");
	require_once("classes/VilleManager.class.php");

	$pdo = new Mypdo();
	$villeManager = new VilleManager($pdo);
	$villes = $villeManager->lister();
	$nbr = $villeManager->listerNbrVilles();
	?>

	<h1>Liste des villes</h1>
	<p> Actuellement <?= $nbr ?> villes sont enregistrées </p>
	<table class="table">
	<thead>
		<tr>
			<th>Numéro</th>
			<th>Nom</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	foreach ($villes as $ville){
		?>
		<tr>
			<td><?= $ville->getVilleNum() ?></td>
			<td><?= $ville->getVilleNom() ?></td>

		</tr>
	<?php
	}
	?>
	</tbody>
	</table>	