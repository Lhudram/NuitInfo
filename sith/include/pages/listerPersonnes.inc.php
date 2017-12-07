	<?php
		require_once("classes/Mypdo.class.php");
		require_once("classes/Personne.class.php");
		require_once("classes/PersonneManager.class.php");
		$pdo = new Mypdo();
		$personneManager = new PersonneManager($pdo);
		$liste = $personneManager->listerPersonne();
		$nbr = $personneManager->listerNbrPersonnes();
	?>

	<h1>Liste des personnes enregistrées</h1>
	<p> Actuellement <?= $nbr ?> personnes sont enregistrées </p>
	<table class="table">
	<thead>
		<tr>
			<th>Num</th>
			<th>Nom</th>
			<th>Prénom</th>
			<?php
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
			<td><a href="./index.php?page=14&amp;num=<?=$pers->getNum()?>&amp;nom=<?=$pers->getNom()?>"><?= $pers->getNum() ?></a></td>
			<td><?= $pers->getNom() ?></td>
			<td><?= $pers->getPrenom() ?></td>
			<?php
			if(isset($_SESSION['admin'])){
				echo "<td><a href='./index.php?page=12&amp;num=".$pers->getNum()."'><img src='./image/modifier.png' alt='Image modification'></a></td>";
				$nbr = $personneManager->listerNbrPersonnes($pers->getNum());

			} ?>

		</tr>
	<?php
	}
	?>
	</tbody>
	</table>
