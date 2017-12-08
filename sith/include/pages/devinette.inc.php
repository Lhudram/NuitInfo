
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

  <h2>Une petite partie ?</h2>
  <p>Trouve le bon nombre</p>
  <hr>
  <b>Votre choix :</b>
  <input TYPE="text" id="devine" SIZE="5">
  <button VALUE="Essayer" onClick="Devine();">Cliquez sur moi :)</button>
  <p id="aide" ></p>
