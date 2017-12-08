<?php
$random404 = rand(0,1);
?>
<h1>Oups...</h1>
<?php
if($random404<0.5)
include_once('include/pages/404.inc.php');
else
include_once('include/pages/devinette.inc.php');
?>

<p>Page introuvable</p>
