<html>
<head>
  <link href="./css/konami.css" rel="stylesheet" media="all" type="text/css">
</head>
  <script type="text/javascript">

    var num = 404;
    var NbEssais = 0;

    function Devine() {
      var choisi = document.getElementById('devine').value;
      NbEssais++;
      status = "Nombre d'essais : " + NbEssais;
      if (choisi < num){
          var original = document.getElementById('aide');
				    var modifie = 'Non, le nombre est plus grand.';
				    original.innerHTML = modifie;
          }
      if (choisi > num){
        var original = document.getElementById('aide');
        var modifie = 'Non, le nombre est plus petit.';
        original.innerHTML = modifie;
      }
      if (choisi == num) {
          var original = document.getElementById('aide');
          var modifie = 'Non, le nombre est plus petit.';
          original.innerHTML = modifie;
          window.alert("Correct ! Vous avez trouvé en " + NbEssais + "essais.");
          location.reload();
      }
    }

  </script>
<body>
  <h1>Trouver le bon nombre</h1>
  <hr>
  <b>Votre choix :</b>
  <input TYPE="text" id="devine" SIZE="5">
  <button VALUE="Essayer" onClick="Devine();">Cliquez sur moi :)</button>
  <p id="aide" ></p>

</body>
</html>
