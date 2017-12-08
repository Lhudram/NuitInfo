

function getLocation(){
  var msg;


  if('geolocation' in navigator){
    requestLocation();
  }else{
    msg = "Votre navigateur ne supporte pas la géolocalisation, entrez-la à la main.";
    outputResult(msg);
    $('.pure-button').removeClass('pure-button-primary').addClass('pure-button-success'); // change button style
  }


  function requestLocation(){

    navigator.geolocation.getCurrentPosition(success);

    function success(pos){
      // recup lng lat
      var lng = Math.round((pos.coords.longitude)*1000)/1000;
      var lat = Math.round((pos.coords.latitude)*1000)/1000;
      $('.pure-button').removeClass('pure-button-primary').addClass('pure-button-success'); // change button style
    }
  }

//affichage DOM
  function outputResult(msg){
    $('.result').addClass('result').html(msg);
  }
}

//
$('.pure-button').on('click', function(){
  $('.result').html('<i class="fa fa-spinner fa-spin"></i>');
  getLocation();
});
