<?php
if(isset($_SESSION['admin'])){?>
	<div id="menu">
	<div id="menuInt">
		<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
		<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
		<ul>
			<li><a href="index.php?page=2">Lister</a></li>
			<li><a href="index.php?page=1">Ajouter</a></li>
			<li><a href="index.php?page=3">Modifier</a></li>
			<li><a href="index.php?page=4">Supprimer</a></li>
		</ul>
		<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
		<ul>
			<li><a href="index.php?page=5">Ajouter</a></li>
			<li><a href="index.php?page=6">Lister</a></li>
			<li><a href="index.php?page=10">Rechercher</a></li>
			<li><a href="index.php?page=18">Valider</a></li>
			<li><a href="index.php?page=19">Supprimer</a></li>
		</ul>
		<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
		<ul>
			<li><a href="index.php?page=8">Lister</a></li>
			<li><a href="index.php?page=7">Ajouter</a></li>
			<li><a href="index.php?page=11">Modifier</a></li>
			<li><a href="index.php?page=17">Supprimer</a></li>
		</ul>
	</div>
</div>
<?php
}
else if(isset($_SESSION['connexion'])){
?>
<div id="menu">
<div id="menuInt">
	<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
	<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
	<ul>
		<li><a href="index.php?page=2">Lister</a></li>
		<li><a href="index.php?page=1">Ajouter</a></li>
	</ul>
	<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
	<ul>
		<li><a href="index.php?page=5">Ajouter</a></li>
		<li><a href="index.php?page=6">Lister</a></li>
		<li><a href="index.php?page=10">Rechercher</a></li>
	</ul>
	<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
	<ul>
		<li><a href="index.php?page=8">Lister</a></li>
		<li><a href="index.php?page=7">Ajouter</a></li>
		<li><a href="index.php?page=11">Modifier</a></li>
	</ul>
</div>
</div>
<?php
} else {
	?>
	<div id="menu">
		<div id="menuInt">
			<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
			<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
			<ul>
				<li><a href="index.php?page=2">Lister</a></li>
			</ul>
			<p><img class="icone" src="image/citation.gif"  alt="Citation"/>Citations</p>
			<ul>
				<li><a href="index.php?page=6">Lister</a></li>
			</ul>
			<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
			<ul>
				<li><a href="index.php?page=8">Lister</a></li>
			</ul>
		</div>
	</div>
	<?php
}
?>
