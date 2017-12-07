<h1> Rechercher une citation </h1>
<?php
if(!empty($_SESSION['connexion'])){
  $pdo = new Mypdo();
  $citationManager = new CitationManager($pdo);
  $etudiantManager = new EtudiantManager($pdo);
  $personneManager = new PersonneManager($pdo);
 ?>
 <form method="post">

Recherche par nom <input type="search" name="qNom" placeholder="Nom professeur" /><br>
Recherche par date <input type="search" name="qDate" placeholder="jj/mm/aaaa" /><br>
Recherche par note obtenue <input type="search" name="qNote" placeholder="0-20" /><br>

  <input type="submit" value="Valider">
 </form>


 <?php
if(!empty($_POST['qNote']) && ($_POST['qNote']>20 || $_POST['qNote']<0)){
  echo "<p> Il faut entrer une note entre 0 et 20 pour qu'elle soit valide. </p>";
}
else if(!empty($_POST['qDate']) && (!$citationManager->testDate($_POST['qDate']))){
  echo "<p> Il faut entrer une date valide. Exemple : 21/12/2012 </p>";
}
else {
 if(!empty($_POST['qNom']) ||!empty($_POST['qNote']) || !empty($_POST['qDate'])){

//Recherche par NOM ET DATE
   if(!empty($_POST['qNom']) && !empty($_POST['qDate'])){
     $rechercheNom = htmlspecialchars($_POST['qNom']);
     $rechercheDate = htmlspecialchars($_POST['qDate']);
     $date = explode("/", $rechercheDate);
     $rechercheDate= $date[2].'-'.$date[1].'-'.$date[0];
     $recherche = array($rechercheNom,$rechercheDate);

     $resultatRecherche = $citationManager->rechercherCitation($recherche);
     $resultatAvecMoy = $citationManager->listerMoyennes($resultatRecherche);
   }
//Recherche par NOM SEULEMENT
 else if(!empty($_POST['qNom'])){
   $rechercheNom = htmlspecialchars($_POST['qNom']);
   $recherche = array($rechercheNom,'');
   $resultatRecherche = $citationManager->rechercherCitation($recherche);
   $resultatAvecMoy = $citationManager->listerMoyennes($resultatRecherche);

 }
//Recherche par DATE SEULEMENT
 else if(!empty($_POST['qDate'])){
   $rechercheDate = htmlspecialchars($_POST['qDate']);
   $date = explode("/", $rechercheDate);
   $rechercheDate= $date[2].'-'.$date[1].'-'.$date[0];
   $recherche = array('',$rechercheDate);
   $resultatRecherche = $citationManager->rechercherCitation($recherche);
   $resultatAvecMoy = $citationManager->listerMoyennes($resultatRecherche);
 }
//Recherche par NOTE
 if(!empty($_POST['qNote'])){
   $rechercheNote = htmlspecialchars($_POST['qNote']);
 }
//Recherche NOTE sans date OU NOTE sans NOM
 if((!empty($_POST['qNote']) && empty($_POST['qDate'])) || (!empty($_POST['qNote']) && empty($_POST['qNom']))){
   $rechercheNote = htmlspecialchars($_POST['qNote']);
   $resultatRecherche = $citationManager->listerCitations();
   $resultatAvecMoy = $citationManager->listerMoyennes($resultatRecherche);
 }


 $etu = $personneManager->RecupNum($_SESSION['connexion']);

 $compteurNote = 0;
//On regarde s'il existe au moins un résultat pour une recherche par note.
 foreach ($resultatAvecMoy as $citation){
   if(!empty($rechercheNote) && $rechercheNote != $citation->getCitMoy()){

   }
   else {
     $compteurNote++;
   }
 }

 if($compteurNote===0){
   echo "<p> Aucun resultat ne correspond à votre recherche. </p>";
 }
 else if(!empty($resultatAvecMoy)){
     ?>
     <table class="table">
   	<thead>
   		<tr>
   			<th>Nom</th>
   			<th>Libellé</th>
   			<th>Date</th>
   			<th>Moyenne des notes</th>
   			<th>Noter</th>
   		</tr>
   	</thead>
   	<tbody>
   	<?php
   	foreach ($resultatAvecMoy as $citation){
      if(!empty($rechercheNote) && $rechercheNote != $citation->getCitMoy()){

      }
      else {

   		$date= $citation->getCitDate();
   		$date = explode("-", $date);
   		$newsdate= $date[2].'/'.$date[1].'/'.$date[0];
   		$estEtudiant = $etudiantManager->estUnEtudiant($etu->getNum());
   		$aVote = $citationManager->aVote(array($citation->getCitNum(), $etu->getNum()));

   		?>
      <?php $personne = $personneManager->listerNomParNum($citation->getPerNum()) ?>
   		<tr>

   			<td><?= $personne->getPrenom(), " ", $personne->getNom() ?></td>
   			<td><?= $citation->getCitLib() ?></td>
   			<td><?= $newsdate ?></td>
   			<td><?= $citation->getCitMoy() ?></td>
   			<td><?php if($estEtudiant && !$aVote){ ?>
   				<a href="./index.php?page=9&amp;cit=<?= $citation->getCitNum() ?>"><img src='./image/modifier.png' alt='Image modif'></a>
   				<?php
   			}
   			else{ ?>
   				<img src='./image/erreur.png' alt='Image erreur'>
   				<?php
   			} ?></td>

   		</tr>
   	<?php
    }
  }
   	}
    else {
      echo "<p> Aucun résultat ne correspond à votre recherche ! </p>";
    }

   	?>
   	</tbody>
   	</table>
    <?php
   }

   else{
     echo "Veuillez compléter au moins l'un des champs ci-dessus. </p>";
   }
 }
}
else {
	echo "<p> <img src='./image/erreur.png' alt='Image erreur'> Vous n'êtes pas autorisé à effectuer une recherche sur les citations ... </p>";
	header("Refresh:2,url='./index.php?page=0'");
}

  ?>
