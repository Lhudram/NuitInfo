<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="securite, sécurité, routiere, routière, prevention, prévention">
	<meta name="desc" content="Application web créée dans le cadre de la Nuit de l'Info par l'équipe Teletubbies. Ce site est un site préventif sur la sécurité routière. L'application web vous permet d'être notifié(e) des éventuels accidents ou autres évènements perturbants pour votre conduite dans votre secteur. Selon le support que vous utilisez, la priorité d'affichage change selon vos besoins.">
	<title>Prévention jeune - Sécurité routière</title>
	<link href="./../../css/style.css" rel="stylesheet" media="all" type="text/css">
	<script src="https://use.fontawesome.com/8d95560a8a.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>
<body>
	<header>
		<div id="logo"><img src="" alt="logo"></div>
		<nav>
			<a href="#">Connexion</a> <!- Affichage espace de connexion ->
			<a href="#">Inscription</a> <!- Affichage espace de création de compte ->
		</nav>
	</header>
	<section id="banner">
		<div id="announce">
			<p>Appli Web préventive</p>
		</div>
		<div>
			<a href="#events"><i id="arrow" class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
		</div>
	</section>
	<section id="events">
		<div>
			<h3>Rechercher des évènements... et un SAM !</h3>
			<input type="text" name="search" placeholder="Département (16, 75...)">
			<button action=""><i class="fa fa-search" aria-hidden="true"></i></button>
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
		<!- Affichage des messages préventifs à partir de la BDD->
	</section>
	<section id="map" style="width:100%;height:700px">
	<!- Affichage de la map, j'ai pas réussi, enfin ça a bugué d'un coup->
	</section>
	<div id="assistance">
		<p>Vous êtes témoin d'un accident ? Assistez les victimes en appelant les secours !</p>
		<div id="calls">
			<a href="tel:17"><i class="fa fa-phone-square" aria-hidden="true"></i> Appeler la police</a>
			<a href="tel:18"><i class="fa fa-phone-square" aria-hidden="true"></i> Appeler les pompiers</a>
			<a href="tel:15"><i class="fa fa-phone-square" aria-hidden="true"></i> Appeler le SAMU</a>
		</div>
	</div>
	<footer>
		<p>© Team Teletubbies - 2017</p>
		<div id="socials">
			<a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube"></i></a>
		</div>
	</footer>
	<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
</body>
</html>