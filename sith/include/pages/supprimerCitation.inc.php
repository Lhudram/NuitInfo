<?php
if(!empty($_SESSION['admin']) && !empty($_SESSION['connexion'])){
$pdo = new Mypdo();
$citationManager = new CitationManager($pdo);
$personneManager = new PersonneManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$citations = $citationManager->listerCitations();
$nbr = $citationManager->listerNbrCitations();

if(empty($_GET['cit'])){
  ?>
  <h1>Liste des citations à supprimer</h1>

  <?php if($nbr != 0) {
    ?>
    <p> Actuellement <?= $nbr ?> citations sont validées ! </p>
    <table class="table">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Libellé</th>
          <th>Date</th>
          <th>Supprimer</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($citations as $citation){
          $date= $citation->getCitDate();
          $date = explode("-", $date);
          $newsdate= $date[2].'/'.$date[1].'/'.$date[0];
          $pers = $personneManager->listerNomParNum($citation->getPerNum());
          ?>
          <tr>
            <td><?= $pers->getPrenom(), $pers->getNom() ?></td>
            <td><?= $citation->getCitLib() ?></td>
            <td><?= $newsdate ?></td>
            <td>

              <a href="./index.php?page=19&amp;cit=<?= $citation->getCitNum() ?>"><img src='./image/erreur.png' alt='Image suppression'></a>
            </td>

          </tr>
          <?php
        }
      }
      else {
        echo "<p><img src='./image/erreur.png' alt='Image erreur'> Aucune citation à supprimer ! </p>";
        echo "<p> Vous allez être redirigé dans 2 secondes ! </p>";
        header("Refresh:2,url='./index.php?page=6'");
      }
    }
    else {
      $num = htmlspecialchars($_GET['cit']);
      $citExiste = $citationManager->listerCitNumSansVerif($num);

      if(!empty($citExiste)){

        $citationManager->supprimerCitation($citExiste);
        echo "<p><img src='./image/valid.png' alt='Image validation'> Cette citation vient d'être supprimée ! </p>";
        echo "<p> Vous allez être redirigé dans 2 secondes ! </p>";
        header("Refresh:2,url='./index.php?page=19'");

      }
      else {
        echo "<p><img src='./image/erreur.png' alt='Image erreur'> Cette citation n'existe pas ! </p>";
        echo "<p> Vous allez être redirigé dans 2 secondes ! </p>";
        header("Refresh:2,url='./index.php?page=19'");
      }

    }
  }
  else {
  	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à supprimer une citation ... </p>";
  	header("Refresh:2,url='./index.php?page=0'");
  }
    ?>
  </tbody>
</table>
