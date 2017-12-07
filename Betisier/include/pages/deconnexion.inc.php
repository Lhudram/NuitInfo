<?php
if (!empty($_SESSION['connexion'])){
	unset($_SESSION['connexion']);
	if (!empty($_SESSION['admin'])){
		unset($_SESSION['admin']);
	}
	echo "<h2> Deconnexion en cours </h2>";
	echo "<p> <img src='./image/valid.png' alt='Image validation'> Vous avez bien été déconnecté.</p>";
	echo " <p> Redirection automatique dans 2 secondes.</p>";
	header("Refresh:2,url=./index.php?page=13");
}
else {
		echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas connecté ... </p>";
		header("Refresh:2,url='./index.php?page=0'");
	}
?>
