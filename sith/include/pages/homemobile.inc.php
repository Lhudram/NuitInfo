<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title> Sécurité routière mobile </title>
    <link  href="css/stylemobile.css" rel="stylesheet" type='text/css'>
</head>
<header>
	<h1> Bienvenue sur le site de prévention de la nuit de l'info 2017 </h1>
</header>
<body>
	<section>
		<div>
			<h2> Vous êtes face à un accident ? </h2>
			<button class="pure-button pure-button-primary">Signaler un accident</button>
			<div class="result"></div>
		</div>
		<button id="security"> Voir les consignes de sécurité </button>
		<div id="etapes">
			<p>Suivez les étapes ci-après </p>
			<p>1 - Mettez votre <span>gilet jaune</span> et placez votre <span>triangle rouge</span> afin de prévenir du danger </p>
			<a href=#><span>2 - Appelez les secours en cliquant ici </span></a>
			<p>3 - Regardez si la ou les victimes sont <span>conscientes</span> (en les appelant, en leur demandant de serrer la main) ou au moins respirent.</p>
			<p>4 - <span>Ne bougez pas une victime sauf si il y a un danger immédiat.</span></p>
		</div>
	</section>
	<section>
	<form>
	<div>
		<h2> Signaler un autre problème</h2>
		<p> Type de problème </p>
		<textarea rows="4" cols="50" name="type" ></textarea>
		<button type="submit">Valider</button>
	</div>
	<div>
		<button> Problèmes près de vous </button>
		<div class="result2"></div>
	</div>
	</form>
	</section>
</body>
<footer>
	<a href=#> Voir la version ordinateur </a>
</footer>
<script src='js/jquery.js'></script>
<script src='js/jsmobile.js'></script>
<script src='js/geoloc.js'></script>
</html>
