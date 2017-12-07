<h1> Modifier le nom d'une ville </h1>

<?php
if(!empty($_SESSION['connexion'])){
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->lister();
?>
<form method="post">
  Ancien Nom : <select name="nomVille" id="nomVille">
    <?php
    //Liste coulissante avec tous les professeurs.
    foreach ($villes as $vil){
      ?>
      <option value="<?= $vil->getVilleNom() ?>"><?= $vil->getVilleNom() ?></option>
      <?php
    }
    ?>
  </select><br>
  Nouveau Nom : <input type="text" name="nouveauNom" placeholder="Limoges" size="10"><br>

  <input type="submit" value="Valider">
</form>

<?php
if(isset($_POST['nouveauNom']) && !empty($_POST['nouveauNom'])){
  if($villeManager->existeAvecNom(htmlspecialchars($_POST['nouveauNom']))){
    echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Ce nom de ville est déjà attribué !</p>";
    header("Refresh:2,url='./index.php?page=11'");
  }
  else {
    $villeManager->modifier($_POST['nomVille'], htmlspecialchars($_POST['nouveauNom']));
    echo "<p> <img src='./image/valid.png' alt='Image validation'> Vous avez bien modifié une ville !</p>";
    header("Refresh:2,url='./index.php?page=11'");
  }
}
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à modifier une ville ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
}?>
