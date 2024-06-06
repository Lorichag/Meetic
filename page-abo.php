

<?php
session_start();

?>

<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="page-abo.css">
<link rel="stylesheet" type="text/css" href="NavBar.css">

<!DOCTYPE html>

  <html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="NavBar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <img src="logo.png" class="icon"></img>
        <div class="logo_name">AniMate</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
          <i class='bx bx-search' ></i>
         <input type="text" placeholder="Search...">
      </li>
      <li>
        <a href="connecting.php?id=<?= $_SESSION['id']; ?>">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Accueil</span>
        </a>
      </li>
      <li>
       <a href="profil.php?id=<?= $_SESSION['id']; ?>">
         <i class='bx bx-user' ></i>
         <span class="links_name">Profile</span>
       </a>
     </li>
     <li>
       <a href="messagerie.php?id=<?= $_SESSION['id']; ?>">
         <i class='bx bx-chat' ></i>
         <span class="links_name">Messages</span>
       </a>
     </li>
     <li>
     <li>
        <a href="page-abo.php?id=<?= $_SESSION['id']; ?>">
          <i class='bx bxl-paypal'></i>
          <span class="links_name">Abonnement</span>
        </a>
      </li>
    <li>
       <a href="Paramètres.php?id=<?= $_SESSION['id']; ?>">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Paramètres</span>
       </a>
     </li>
     <li class="profile">
         <div class="profile-details">
           <img src="profile.jpg">
           <div class="name_job">
             <div class="name"><?= $_SESSION['pseudo']; ?></div>
           </div>
         </div>
         <form method="POST" action="" id="logout-form" style="display: inline;">
          <input type="hidden" name="d" value="logout">
          <i class='bx bx-log-out' id="log_out" style="cursor: pointer;"></i>
     </li>
    </ul>
  </div>

<div class="decaler">

<div class="position">
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
</div>


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
 margin-right: 750px ;
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
 
 margin-left: 750px ;
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
.position {
display:flex;
justify-content:center;
}


</style>



</html>

<script>
 let sidebar = document.querySelector(".sidebar");
 let decaler = document.querySelector((".decaler"))
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");
  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    decaler.classList.toggle("open");
  });
  searchBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    decaler.classList.toggle("open");
  });
  
  </script>