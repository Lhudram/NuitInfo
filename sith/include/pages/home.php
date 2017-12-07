<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="securite, sécurité, routiere, routière, prevention, prévention">
	<meta name="desc" content="Application web créée dans le cadre de la Nuit de l'Info par l'équipe Teletubbies. Ce site est un site préventif sur la sécurité routière. L'application web vous permet d'être notifié(e) des éventuels accidents ou autres évènements perturbants pour votre conduite dans votre secteur. Selon le support que vous utilisez, la priorité d'affichage change selon vos besoins.">
	<title>Prévention jeune - Sécurité routière</title>
	<link href="./app/css/style.css" rel="stylesheet" media="all" type="text/css">
	<script src="https://use.fontawesome.com/8d95560a8a.js"></script>
</head>
<body>
	<header>
		<h1>SAM'user</h1>
		<nav>
			<a href="#">Connexion</a> <!- Affichage espace de connexion ->
			<a href="#">Inscription</a> <!- Affichage espace de création de compte ->
		</nav>
	</header>
	<section id="events">
		<div>
			<h3>Rechercher des évènements... et un SAM !</h3>
			<input type="text" name="search" placeholder="Département...">
		</div>
		<div id="results">
			<?php
			//traitement affichant les résultats de recherche
			?>
			<a href="#">Participer</a>
		</div>
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