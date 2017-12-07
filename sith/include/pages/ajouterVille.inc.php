<h1>Ajouter une ville</h1>
<?php
if(!empty($_SESSION['connexion'])){
	if(empty($_POST['nomVille'])){
?>
<form action="" method="post">
  	Nom : <input id="nomVille" type="text" name="nomVille" >
  <input type="submit" value="Valider">
</form>

<?php
}
else {
	$nomVille = htmlspecialchars($_POST['nomVille']);
	$pdo = new Mypdo();
	$villeManager = new villeManager($pdo);
	$ville = $villeManager->ajouter($nomVille);

	if($ville){
		echo "<p> <img src='./image/valid.png' alt='Image validation'>  La ville \"".htmlspecialchars($_POST['nomVille'])."\" a été ajoutée</p>";
	}
	else {
		echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Cette ville est déjà entrée dans la base ! </p>";
	}
}
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à ajouter une ville ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
}
?>
