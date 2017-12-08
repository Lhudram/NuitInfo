<?php

if (!empty($_GET["page"])) {
    $page = (int)$_GET["page"];
} else {
    $page = 1;
}
if (!empty($_GET["nom_utilisateur"]))
    $page = 2;
switch ($page) {
    case $pages["main_page"]:
        include_once('include/pages/main_page.inc.php');
        break;
    case $pages["connexion"]:
        include_once("include/pages/connexion.inc.php");
        break;
    case $pages["autreslulz"]:
        include_once("include/pages/autreslulz.inc.php");
        break;
	  case $pages["404"]:
  		 include_once("include/pages/404.inc.php");
  		 break;

    default:
        include_once('include/pages/main_page.inc.php');
        break;
}

?>
