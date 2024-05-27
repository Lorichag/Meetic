

<?php
session_start();

?>

<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="page-abo.css">



<div class="Foufou ">
<h2>Offre Foufou</h2>
<h1> 5.99€ </h1>
<h1>Pour 1 mois </h1>
<a href="paiement.php?offre=foufou">Start Now</a>
<BR>
<br>
<p>Acces au site à son plein potentiel pour rencontrer l'amseur de ton animal</p>


</div>
<div class="Sauvage">

<h2>Offre Sauvage</h2>
<h1>15.99€</h1>
<h1>Pour 3 mois !</h1>
<a href="paiement.php?offre=sauvage">Start Now</a>
<BR>
<br>
<p>Acces au site à son plein potentiel pour rencontrer l'amseur de ton animal</p>
<h2>Offre la plus populaire parmis nos utilisateurs</h2>
</div>


<div class="Roi">
<h2>Offre Roi</h2>
<h1>59.99€</h1>
<h1>Pour 1 ANS !!!</h1>
<a href="paiement.php?offre=roi">Start Now</a>
<BR>
<br>
<p>Acces au site à son plein potentiel pour rencontrer l'amseur de ton animal</p>

</div>
</body>



<style type="text/css">

body {
background:radial-gradient(circle,rgba(34,193,195,1) 20%, rgba(253,187,45,1)90%);
height:97vh;
}

.Foufou{
 text-align:center;
 position:fixed;
 float:left;
 width:300px;
 height:400px;
 background-color: #200802 ;
 background-size: cover;
 margin-top: 175px ;
 margin-right: 10px ;
 margin-left:400px;
 border-radius:10px;
}

.Foufou h2 {
color:Yellow;
}


.Foufou h1 {
color:white;
}

.Foufou a {
background: yellow;
padding: 10px;
text-decoration: none;
color: black ;
transition: background-color 0.3s ease;
}
.Foufou a:hover {
    background: #b7950b ;
}
.Foufou p{
color:white;

}




.Sauvage {
text-align:center;
position:fixed;
float:left;
 width:300px;
 height:550px;
 background-color: #200802 ;
  background-size: cover;
 margin-top: 7% ;
 margin-right: 1% ;
 margin-left:800px;
  border-radius:10px;
}

.Sauvage h1 {
color:white;
}
.Sauvage h2 {
color:Yellow;
}
.Sauvage a {
background: #200802 ;
padding: 10px;
text-decoration: none;
color: yellow ;
border: 2px solid yellow;
transition: background-color 0.3s ease;
}

.Sauvage a:hover {
    background: #b7950b ;
}
.Sauvage p{
color:white;

}
.Roi {
text-align:center;
position:fixed;
float:left;
 width:300px;
 height:450px;
 background-color: #200802 ;
  background-size: cover;
 margin-top: 8% ;
 margin-right: 1% ;
 margin-left:1200px;
  border-radius:10px;
}

.Roi h1 {
color:white;
}
.Roi h2 {
color:Yellow;
}

.Roi a {
background: yellow;
padding: 10px;
text-decoration: none;
color: black ;
transition: background-color 0.3s ease;
}

.Roi a:hover {
    background: #b7950b ;
}
.Roi p{
color:white;

}
</style>



</html>
