<?php
session_start();
//Redirige vers connexion si la personne essaye de tricher :)
$monUrl = $_SERVER['REQUEST_URI'];
if(empty($_SESSION['connexion']) && $monUrl != '/Betisier/index.php?page=0' && $monUrl != '/Betisier/index.php?page=13' && $monUrl != '/Betisier/index.php?page=15' && $monUrl != '/Betisier/index.php?page=2' && $monUrl != '/Betisier/index.php?page=6' && $monUrl != '/Betisier/index.php?page=8'){
	header("Refresh:0,url='./index.php?page=13'");
}
// FAIRE LA MEME CHOSE POUR LE MODE NON ADMIN ET ADMIN (quand toutes les pages seront faites (il ne faut pas en oublier))
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />

</head>
	<body>
	<div id="header">
		<div id="connect">
			<?php
			if (isset($_SESSION['admin'])) {
				$admin = " Admin : ".htmlspecialchars($_SESSION['connexion'])."  <a href='./index.php?page=15'>Deconnexion</a>";
				echo $admin;
			}

			else if(isset($_SESSION['connexion'])) {
				$connexion = "Utilisateur : ".htmlspecialchars($_SESSION['connexion'])."  <a href='./index.php?page=15'>Deconnexion</a>";
				echo $connexion;
			}
			else {
				echo "<a href='./index.php?page=13' name='connexion' id='connexion'>Connexion</a>";
			}
			?>

		</div>
		<div id="entete">
			<div id="logo">

			</div>
			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
		</div>
	</div>
