<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="securite, sécurité, routiere, routière, prevention, prévention">
	<meta name="desc" content="Application web créée dans le cadre de la Nuit de l'Info par l'équipe Teletubbies. Ce site est un site préventif sur la sécurité routière. L'application web vous permet d'être notifié(e) des éventuels accidents ou autres évènements perturbants pour votre conduite dans votre secteur. Selon le support que vous utilisez, la priorité d'affichage change selon vos besoins.">
	<title>Prévention jeune - Sécurité routière</title>
	<link href="./css/style.css" rel="stylesheet" media="all" type="text/css">
	<link href="./css/konami.css" rel="stylesheet" media="all" type="text/css">
	<script src="https://use.fontawesome.com/8d95560a8a.js"></script>

</head>
<body>
	<?php
	$db = new Mypdo();
	$evenementManager = new EvenementManager($db);
	$lieuManager = new LieuManager($db);
	?>
	<header>
		<h1>SAM'user</h1>
		<nav>
			<a href="#">Connexion</a> <!- Affichage espace de connexion ->
			<a href="#">Inscription</a> <!- Affichage espace de création de compte ->
		</nav>
	</header>
	<section id="events">
		  <form id="liste"  action="#" method="POST">
				<div>
					<h3>Rechercher des évènements... et un SAM !</h3>
					<input type="text" name="search" placeholder="Département...">
					<input type="submit" value="rechercher">
				</div>
				<div id="results">
					<?php
					if(!empty($_POST["search"])){
					$evenements = $evenementManager->getAllFromDepartement($_POST["search"]);
					$lieus=$lieuManager->getAll();
					foreach ($evenements as $evenement) {
							echo '<p ';
							echo 'value="';
							echo $evenement->getIdevenement();
							echo '">';
							echo $evenement->getNomevent() . " " . $evenement->getDescevent()
							. " " . $evenement->getDateevent();
							foreach ($lieus as $lieu) {
								if($evenement->getIdlieu()==$lieu->getIdlieu())
								echo " ". $lieu->getAdresse() .'</p>';
							}
							?>
							<?php
					}
				}
					?>
					</div>
				</form>
		<a href="./app/Controllers/OrgAdd.php" id="createEvent"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> <!- Formulaire de création d'un évènement si utilisateur connecté = organisateur ->
	</section>
	<section id="prev">
		<div id="advices">

		</div>
		<div id="assistance"></div>
		<div>

		</div>
	</section>
	<section id="map">

	</section>
	<footer>
		<div id="socials">
		</div>
	</footer>
</body>
</html>
