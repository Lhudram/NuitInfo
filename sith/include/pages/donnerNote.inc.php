<h2> Noter une citation </h2>
<?php
if(!empty($_SESSION['connexion'])){
$pdo = new Mypdo();
$citationManager = new CitationManager($pdo);
$personneManager = new PersonneManager($pdo);
$voteManager = new VoteManager($pdo);

if (!empty($_GET['cit'])){

$cit_num = htmlspecialchars($_GET['cit']);
$citation = $citationManager->listerCitNum($cit_num);
$etu = $personneManager->RecupNum($_SESSION['connexion']);
$aVote = $citationManager->aVote(array($citation->getCitNum(),$etu->getNum()));


  ?>
  <form method="post">
    Noter la citation : <select name="noteCitation" id="noteCitation">

      <?php

      for($i = 0; $i <=20; $i++){
        echo "<option value ='".$i."'>".$i."</option>";
      }
        ?>
    <input type="submit" value="Valider">
  </form>
  <?php
  if(!empty($_POST['noteCitation'])){
    $note = htmlspecialchars($_POST['noteCitation']);
    if($note>=0 && $note<=20){
      $ajout = $voteManager->ajouterNote($citation,$etu,$note);
    }
    if($ajout && !$aVote){
      echo "<p> <img src='./image/valid.png' alt='Image validation'> Une note a été entrée dans la base !</p>";
      echo "<p>Redirection automatique dans 2 secondes.";
      header("Refresh:2,url='./index.php?page=6'");
    }
    else {
      echo "<p> <img src='./image/erreur.png' alt='Image validation'> Vous avez déjà voté !</p>";
      echo "<p>Redirection automatique dans 2 secondes.";
      header("Refresh:2,url='./index.php?page=6'");
    }

  }

}
else {
  echo "<p> <img src='./image/erreur.png' alt='Image validation'> Cette citation n'existe pas ou n'est pas valide !</p>";
  echo "<p>Redirection automatique dans 2 secondes.";
  header("Refresh:2,url='./index.php?page=6'");
}
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à donner une note ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
}
?>
