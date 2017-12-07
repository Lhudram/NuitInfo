<h1> Supprimer une ville </h1>

<?php
if(!empty($_SESSION['admin']) && !empty($_SESSION['connexion'])){
$pdo = new Mypdo();
$villeManager = new VilleManager($pdo);
$villes = $villeManager->lister();
?>
<form method="post">
  Ville à supprimer : <select name="nomVille" id="nomVille">
    <?php
    //Liste coulissante avec tous les professeurs.
    foreach ($villes as $vil){
      ?>
      <option value="<?= $vil->getVilleNom() ?>"><?= $vil->getVilleNom() ?></option>
      <?php
    }
    ?>
  </select><br>
  <input type="submit" value="Supprimer">
</form>

<?php
if(isset($_POST['nomVille']) && !empty($_POST['nomVille'])){
  if($villeManager->existeAvecNom(htmlspecialchars($_POST['nomVille']))){
    $vilNum = $villeManager->recupNum(htmlspecialchars($_POST['nomVille']));
    $villeManager->supprimer($vilNum);
    echo "<p> <img src='./image/valid.png' alt='Image validation'> Vous avez bien supprimé cette ville !</p>";
    echo "<p> <img src='./image/valid.png' alt='Image validation'> Les départements associés à cette ville ont été associés à 'Non associé'. </p>";
    header("Refresh:2,url='./index.php?page=17'");
  }
  else {
    echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Cette ville n'existe pas / est impossible à supprimer !</p>";
    header("Refresh:2,url='./index.php?page=17'");
  }
}
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à supprimer une ville ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
} ?>
