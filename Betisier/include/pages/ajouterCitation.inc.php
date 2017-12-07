<h1>Ajouter une citation</h1>
<?php
if(!empty($_SESSION['connexion'])){
$pdo = new Mypdo();
$personneManager = new PersonneManager($pdo);
$listePersonnes = $personneManager->listerPersonnes();
$etu = $personneManager->recupNum($_SESSION['connexion']);
$citationManager = new CitationManager($pdo);
$motManager = new MotManager($pdo);

//Si la date est vide on supprimer la citation en session (cas où on revient sur ajouter Citation)
if(empty($_POST['dateCit'])){
  unset($_SESSION['citation']);
}

?>

<!-- Formulaire Citation -->
<form action="./index.php?page=5" method="post">
  Personne : <select name="personne" id="personne">
    <?php
    //Liste coulissante avec tous les professeurs.
    foreach ($listePersonnes as $pers){
      if($pers->getNum() == htmlspecialchars($_POST['personne'])){
        ?>
        <option value="<?= $pers->getNum() ?>" selected="<?= $pers->getNum() ?>"><?= $pers->getNom() ?></option>
        <?php
      }else {
        ?>

        <option value="<?= $pers->getNum() ?>"><?= $pers->getNom() ?></option>
        <?php
      }
    }
    ?>
 </select><br>
  Date Citation : <input type="text" name="dateCit" placeholder="jj/mm/aaaa" value="<?php if(isset($_POST['dateCit']) && $citationManager->testDate($_POST['dateCit'])){ echo htmlspecialchars($_POST['dateCit']); } ?>" size="10"><br>
  Citation : <textarea name="citation" placeholder="La truite remonte le ruisseau pas à pas !"><?php if(!empty($_POST['citation']) && isset($_POST['dateCit']) && $citationManager->testDate($_POST['dateCit'])){
    $citationOk = $motManager->verifCit(htmlspecialchars($_POST['citation']));
    $cit = htmlspecialchars($_POST['citation']);

    if (!empty($citationOk)){
      foreach ($citationOk as $mot) {
        if (stripos($cit, $mot->getMotInterdit()) !== FALSE) {
          $cit = str_ireplace($mot->getMotInterdit(), '---', $cit);
        }
      }
      echo $cit;
    }
  }
  ?>
</textarea><br>
<input type="submit" value="Valider">
</form>
<?php

//Si il existe une personne, et que la date ainsi que la citation sont bien remplies. (+vérif Format Date)
if(isset($_POST['personne']) && !empty($_POST['dateCit']) && !empty($_POST['citation']) && $citationManager->testDate($_POST['dateCit'])){
  $citationOk = $motManager->verifCit(htmlspecialchars($_POST['citation']));
  $cit = htmlspecialchars($_POST['citation']);

  if (empty($citationOk)){

    $citationManager->ajouterCitation(array(htmlspecialchars($_POST['personne']), htmlspecialchars($_POST['dateCit']),htmlspecialchars($_POST['citation']),$etu));

    unset($_POST['personne']);
    unset($_POST['dateCit']);
    unset($_POST['citation']);
    unset($_SESSION['citation']);

    echo "<p> <img src='./image/valid.png' alt='Image validation'> Vous avez bien ajouté une citation!</p>";
    header("Refresh:2,url='./index.php?page=5'");
  }
  else {
    foreach ($citationOk as $mot) {
      if (stripos($cit, $mot->getMotInterdit()) !== FALSE) {
        $cit = str_ireplace($mot->getMotInterdit(), '---', $cit);
        $_SESSION['citation']=$cit;
      }
      echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Le mot ".$mot->getMotInterdit()." est interdit ! </p>";

    }
  }

}

else if(!empty($_POST['dateCit']) && !$citationManager->testDate($_POST['dateCit'])){
  echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Le format de la date n'est pas bon ! Exemple valide : 31/12/2017</p>";
}
}
else {
  echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à ajouter une citation ... </p>";
  header("Refresh:2,url='./index.php?page=0'");
}?>
