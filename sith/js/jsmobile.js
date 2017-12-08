$(document).ready ( function (){


 function toggleVisibility(elmt)
{
   if(typeof elmt == "string")
      elmt = document.getElementById(elmt);
     // $(document).find('span').css('visibility','hidden');
      elmt.style.visibility = "visible";
}

  $('#security').click(function(){
    toggleVisibility(etapes);
  });

 });