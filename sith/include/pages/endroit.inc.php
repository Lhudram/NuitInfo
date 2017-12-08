<html>
<head>
  <link href="./css/konami.css" rel="stylesheet" media="all" type="text/css">
  <?php
    $db = new Mypdo();
    $accidentManager = new AccidentManager($db);
    $lattitude=45;
    $longitude=1;
    $accidents = $accidentManager->getAllFromLocation($lattitude,$longitude);
   ?>
</head>
<body>
    <img src="https://maps.googleapis.com/maps/api/staticmap?&size=1000x1000&maptype=roadmap
              <?php foreach($accidents as $accident) {
                  echo "&markers=color:red%7C".$accident->getLattitude().".714728,".$accident->getLongitude().".714728";
              }
                echo "&sensor=false";
              ?>">
</body>
</html>
