if (document.body)
{
var larg = (document.body.clientWidth);
var haut = (document.body.clientHeight);
}

else
{
var larg = (window.innerWidth);
var haut = (window.innerHeight);
}

if( larg < 800 && haut < 600)
{
document.location.href="mapagemobile.html";
}
else
{
document.location.href="mapageordinateur.html";
}