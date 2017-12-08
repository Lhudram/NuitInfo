<?php

if (!empty($_GET["page"])) {
    $page = (int)$_GET["page"];
} else {
    $page = 1;
}
if (!empty($_GET["nom_utilisateur"]))
    $page = 2;

$random404 = rand(0,1);

switch ($page) {
    case $pages["devinette"]:
        include_once('include/pages/devinette.inc.php');
        break;
    case $pages["connexion"]:
        include_once("include/pages/connexion.inc.php");
        break;
    case $pages["home"]:
        include_once("include/pages/home.inc.php");
        break;

    default:
        include_once('include/pages/404.inc.php');
        break;
}

?>
