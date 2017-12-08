<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="securite, sécurité, routiere, routière, prevention, prévention">
	<meta name="desc" content="Application web créée dans le cadre de la Nuit de l'Info par l'équipe Teletubbies. Ce site est un site préventif sur la sécurité routière. L'application web vous permet d'être notifié(e) des éventuels accidents ou autres évènements perturbants pour votre conduite dans votre secteur. Selon le support que vous utilisez, la priorité d'affichage change selon vos besoins.">
	<title>Prévention jeune - Sécurité routière</title>
	<link href="css/style.css" rel="stylesheet" media="all" type="text/css">
	<script src="https://use.fontawesome.com/8d95560a8a.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light|Ubuntu" rel="stylesheet">
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<link href="./css/konami.css" rel="stylesheet" media="all" type="text/css">
	<script src='js/geoloc.js'></script>
</head>
<body>
	<?php
		$db = new Mypdo();
		$evenementManager = new EvenementManager($db);
		$lieuManager = new LieuManager($db);
		$accidentManager = new AccidentManager($db);
    $lattitude=45;
    $longitude=1;
    $accidents = $accidentManager->getAllFromLocation($lattitude,$longitude);
	?>
	<header>
		<div id="logo"><img src="img/logo.png" alt="logo"></div>
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
		<form id="liste"  action="#" method="POST">
				<div>
					<h3>Rechercher des évènements... et un SAM !</h3>
					<input type="text" name="search" placeholder="Département (16, 75...)">
					<button action=""><i class="fa fa-search" aria-hidden="true"></i></button>
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
	</section>
	<section id="image">
		<h3>Accident près de vous : </h3>
	<?php if(!empty($accidents)){ ?>
	<img src="https://maps.googleapis.com/maps/api/staticmap?&size=1000x1000&maptype=roadmap<?php foreach($accidents as $accident) {
								echo "&markers=color:red%7C".$accident->getLattitude().",".$accident->getLongitude();
						}
							echo "&sensor=false";
						?>">
	<?php } ?>
</section>
	<section id="prev">
		<h3>En voyage...</h3>
		<div class="post">
			<h4>Attache ta ceinture !</h4>
			<p>Ouais je sais, on te le dit depuis que t'es gosse mais ce truc peut retenir 3 tonnes askip donc c'est plutôt utile.</p>
		</div>
		<div class="post">
			<h4>Ne dérange pas le conducteur !</h4>
			<p>Bah ouais, il est dans une école d'ingé mais il a besoin de se concentrer sur la route.</p>
		</div>
		<div class="post">
			<h4>Pose ton téléphone !</h4>
			<p>Le dernier snap de <s>ce 95D</s> cette fille peut attendre que tu sois à l'arrêt et en sécurité.</p>
		</div>
		<div class="post">
			<h4>Evite de conduire quand t'as bu...</h4>
			<p>Sérieux mec. Les SAM ça existe. C'est même pour ça que ce site existe aussi. Ou alors pionce dans ta bagnole.</p>
		</div>
		<div class="post">
			<h4>N'accélère pas quand tu es en retard !</h4>
			<p>Vaut mieux arriver en retard à ton entretien d'embauche qu'en avance à la morgue, non ?</p>
		</div>
		<div id="quote">
			<b>Et si tu trouves qu'on te parle comme un bébé, imagine comment on te parlera quand tu seras plus qu'un légume parce que t'as pas respecté ces règles...</b>
		</div>
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
		<p>© Team Teletubbies - Nuit de l'Info 2017</p>
		<div id="socials">
			<a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube"></i></a>
		</div>
	</footer>
</body>
</html>
