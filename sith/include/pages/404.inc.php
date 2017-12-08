<?php
$random404 = rand(0,1);
?>
<html>
<head>
	<link href="./css/konami.css" rel="stylesheet" media="all" type="text/css">
</head>
<body>
<h1>Oups... la page est introuvable !</h1>
<?php
if($random404<0.5) {
	include_once('include/pages/pong.inc.php');
} else {
	include_once('include/pages/devinette.inc.php');
}
?>
</body>
</html>
