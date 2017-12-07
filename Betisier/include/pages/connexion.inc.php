<?php

if(empty($_SESSION['connexion'])){
if (empty($_POST['utilisateur']) || empty($_POST['password']) || empty($_POST['verif'])){
	echo "<h2> Pour vous connecter </h2>";
	$_SESSION['nb1'] = rand(1, 9);
	$_SESSION['nb2'] = rand(1, 9);

	?>
	<form action="#" id="insert" method="post">

		Nom d'utilisateur :  <input type="text" name="utilisateur"  id="utilisateur" size="10">
		<br /><br />
		Mot de passe : <input type="password" name="password"  id="password" size="10">
		<br /><br />
		<img src="./image/nb/<?= $_SESSION['nb1'] ?>.jpg" alt="Nombre1"> + <img src="./image/nb/<?= $_SESSION['nb2'] ?>.jpg" alt="Nombre2"> = <input type="text" name="verif"  id="verif" size="10">
		<br /><br />
		<input type="submit" value="Allons-y !"/>
		<?php
	} else if(!empty($_POST['utilisateur']) && !empty($_POST['password']) && !empty($_POST['verif'])){
		$pdo = new Mypdo();
		$login = htmlspecialchars($_POST['utilisateur']);
		$mdp = htmlspecialchars($_POST['password']);
		$salt = '!$1?;3';
		$mdp = md5(md5($mdp).$salt);
		$personne = new Personne(array("per_login" => $login, "per_pwd" => $mdp));
		$personneManager = new PersonneManager($pdo);
		$estAjoute = $personneManager->ajouter($personne);

			if((($_POST['verif']) === htmlspecialchars($_SESSION['nb1'] + $_SESSION['nb2'])) && ($estAjoute === true)){
				$_SESSION['connexion'] = $login;
				if ($personneManager->verifAdmin(htmlspecialchars($login))){
					$_SESSION['admin'] = "admin";
				}
				echo "<p> <img src='./image/valid.png' alt='Image validation'> Vous avez bien été connecté!</p>";
				echo "<p>Redirection automatique dans 2 secondes.";
				header("Refresh:2,url='./index.php?page=0'");

			}

			else {
				if(($_POST['verif']) !== htmlspecialchars($_SESSION['nb1'] + $_SESSION['nb2'])){

					echo "<p> Un incident est survenu lors de la saisie du captcha </p>";
				}
				elseif($estAjoute === false){
					echo "<p> L'identifiant ou le mot de passe est incorrect </p>";
				}

			}

	}
	?>
</form>
<?php
}
else{
	echo "<p><img src='./image/erreur.png' alt='Image erreur'> Vous êtes déjà connecté ! <p>";
	header("Refresh:2,url='./index.php?page=0'");
} ?>
