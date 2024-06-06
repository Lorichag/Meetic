
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


<div class="position">
<div class="Foufou ">
<h2>Offre Foufou</h2>
<h1> 5.99€ </h1>
<h1>Pour 1 mois </h1>
<a href="#" id="contact-link1">Start Now</a>
<div id="modal1" class="modal1">
        <div class="modal1-content">
            <span class="close-button1">&times;</span>
            <form method="POST" action="">
	<input class="carte1" type="text" name="num-carte" autocomplete="off" placeholder="1234 1234 1234 1234" required maxlength="19">
	<input class="carte2" type="text" name="exp-carte"  autocomplete="off"  placeholder="MM/YY" required maxlength="5">
	<input class="carte3" type="text" name="CVC"  autocomplete="off"  placeholder="CVC" required maxlength="3">
	<input type="submit" value="Valider" name="fric">
	</form>
        </div>
    </div>
<BR>
<br>
<p>Acces au site à son plein potentiel pour rencontrer l'amseur de ton animal</p>

</div>
<div class="Sauvage">

<h2>Offre Sauvage</h2>
<h1>15.99€</h1>
<h1>Pour 3 mois !</h1>
<a href="#"  id="contact-link2">Start Now</a>
<div id="modal2" class="modal2">
        <div class="modal2-content">
            <span class="close-button2">&times;</span>
            <form method="POST" action="">
	<input class="carte1" type="text" name="num-carte" autocomplete="off" placeholder="1234 1234 1234 1234" required maxlength="19">
	<input class="carte2" type="text" name="exp-carte"  autocomplete="off"  placeholder="MM/YY" required maxlength="5">
	<input class="carte3" type="text" name="CVC"  autocomplete="off"  placeholder="CVC" required maxlength="3">
	<input type="submit" value="Valider" name="fric">
	</form>
        </div>
    </div>
<BR>
<br>
<p>Acces au site à son plein potentiel pour rencontrer l'amseur de ton animal</p>
<h2>Offre la plus populaire parmis nos utilisateurs</h2>
</div>


<div class="Roi">
<h2>Offre Roi</h2>
<h1>59.99€</h1>
<h1>Pour 1 ANS !!!</h1>
<a href="#" id="contact-link3">Start Now</a>
<div id="modal3" class="modal3">
        <div class="modal3-content">
            <span class="close-button3">&times;</span>
            <form method="POST" action="">
	<input class="carte1" type="text" name="num-carte" autocomplete="off" placeholder="1234 1234 1234 1234" required maxlength="19">
	<input class="carte2" type="text" name="exp-carte"  autocomplete="off"  placeholder="MM/YY" required maxlength="5">
	<input class="carte3" type="text" name="CVC"  autocomplete="off"  placeholder="CVC" required maxlength="3">
	<input type="submit" value="Valider" name="fric">
	</form>
        </div>
    </div>
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
z-index:1;
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
z-index:1;
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
z-index:1;
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
z-index:1;

}


.modal1 {
    display: none; 
    position: fixed;
    z-index:;
    left:0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modal1-content {
    z-index:99;
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px; 
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    animation: modal1open 0.4s; 
}

@keyframes modal1open {
    from { opacity: 0 }
    to { opacity: 1 }
}

.close-button1 {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-button1:hover,.close-button1:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}



.modal2 {
    display: none; 
    position: fixed;
    z-index: 99;
    left:0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modal2-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px; 
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    animation: modal1open 0.4s; 
}

@keyframes modal1open {
    from { opacity: 0 }
    to { opacity: 1 }
}

.close-button2 {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-button2:hover,.close-button2:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.modal3 {
    display: none; 
    position: fixed;
    z-index: 1;
    left:0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modal3-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px; 
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    animation: modal1open 0.4s; 
}

@keyframes modal1open {
    from { opacity: 0 }
    to { opacity: 1 }
}

.close-button3 {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-button3:hover,.close-button3:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>



</html>

<script>
 let sidebar = document.querySelector(".sidebar");
 let decaler = document.querySelector((".decaler"));
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
  
  document.addEventListener('DOMContentLoaded', (event) => {
    const modal1 = document.getElementById('modal1');
    const contactLink1 = document.getElementById('contact-link1');
    const closeButton1 = document.getElementsByClassName('close-button1')[0];

    contactLink1.onclick = function() {
        modal1.style.display = "block";
    }

    closeButton1.onclick = function() {
        modal1.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
    }
});
document.addEventListener('DOMContentLoaded', (event) => {
    const modal2 = document.getElementById('modal2');
    const contactLink2 = document.getElementById('contact-link2');
    const closeButton2 = document.getElementsByClassName('close-button2')[0];

    contactLink2.onclick = function() {
        modal2.style.display = "block";
    }

    closeButton2.onclick = function() {
        modal2.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }
});
document.addEventListener('DOMContentLoaded', (event) => {
    const modal3 = document.getElementById('modal3');
    const contactLink3 = document.getElementById('contact-link3');
    const closeButton3 = document.getElementsByClassName('close-button3')[0];

    contactLink3.onclick = function() {
        modal3.style.display = "block";
    }

    closeButton3.onclick = function() {
        modal3.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal3) {
            modal3.style.display = "none";
        }
    }
});
  </script>
