<h1>Supprimer une personne </h1>

<?php
if(!empty($_SESSION['connexion']) && !empty($_SESSION['admin'])){
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$citationManager = new CitationManager($pdo);
$listePersonnes = $personneManager->listerPersonnes();
$etu = $personneManager->recupNum($_SESSION['connexion']);

if(!empty($listePersonnes)){
  if(empty($_POST['personne'])){
?>
<p> ! ATTENTION ! </p>
<p> Cette action est irréversible et supprimera aussi les votes de cette personne ainsi que ses citations et les votes qui y sont associés ! </p>
<form action="" method="post">
  Personne : <select name="personne" id="personne">
    <?php
    //Liste coulissante avec tous les professeurs
    foreach ($listePersonnes as $pers){
      if($pers->getNum() != $personneManager->RecupNum($_SESSION['connexion'])){
      ?>
        <option value="<?= $pers->getNum() ?>"><?= $pers->getNom() ?></option>
        <?php
      }
    }
    ?>
</textarea><br>
<input type="submit" value="Supprimer">
</form>

<?php
}else{
if(!empty($_POST['personne'])){
  $pernum = htmlspecialchars($_POST['personne']);
  $citations = $citationManager->listerCitPerNum($pernum);

  if(!empty($citations)){
    foreach ($citations as $citation) {
      $citationManager->supprimerCitation($citation);
    }
  }

  $personneManager->supprimerPersonne($pernum);
  echo "<p><img src='./image/valid.png' alt='Image validation'> Cette personne vient d'être supprimée ! </p>";
  echo "<p> Vous allez être redirigé dans 2 secondes ! </p>";
  header("Refresh:2,url='./index.php?page=4'");
}
}
}

else {
  echo "<p> Il n'y aucune personne à supprimer ... </p>";
}
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à supprimer une personne ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
}
?>
