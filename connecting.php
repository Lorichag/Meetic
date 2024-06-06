<?php 
session_start();

if(!$_SESSION['mdp']){
    header('Location: login.php');
    exit();
}

if(isset($_POST['d'])){
    $_SESSION = array();
    session_destroy();
    header('Location: login.php');
    exit();
}


echo $_SESSION["pseudo"];

$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');
if(!$_SESSION['pseudo']){
    header('Location: login.php');
    exit();
}

if(isset($_GET['id']) and !empty($_GET['id'])){
    $getid = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM users WHERE id= ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() > 0){
        if(isset($_POST["envoyer"])){
            $message = htmlspecialchars($_POST['message']);
            $inseremessage = $bdd->prepare('INSERT INTO messages(message, id_des, id_au) VALUES(?,?,?)');
            $inseremessage->execute(array($message, $getid, $_SESSION['id']));
        }
    } else {
        echo "Aucun utilisateur trouvé.";
    }
} else {
}
?>

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
       <a href="#">
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

  
  <div class="titre">
    <h1>Animate</h1>
  </div>
  <div class="contenue">
    <div class="pro">
      <?php 
      $recupUser = $bdd->query('SELECT * FROM users');
      while($user = $recupUser->fetch()){
          if($user['id'] != $_SESSION['id']){
      ?>
      <button class="bouton" onclick="redirectMessagerie(<?= $user['id']; ?>)">
        <div class="case">
          <img src="https://www.garnelio.de/media/image/26/df/9a/IMG-9764-2tdyWLzPLu4mlB.jpg" class="icon1">
          <p class="ut"><?= $user['pseudo']; ?></p>
        </div>
      </button>
      <?php
          }
      }
      ?>
    </div>
    <div class="pub">
      <img src="https://nuostore.com/wp-content/uploads/2023/11/IBANEZ-AE295WK-300x775.jpg">
    </div>
  </div>
  
  <script>
    function redirectMessagerie(userId) {
      window.location.href = "profile.php?id=" + userId;
    }
    document.getElementById('log_out').addEventListener('click', function() {
      document.getElementById('logout-form').submit();
    });
  </script>
</body>
</html>


<style>

 

form {
margin-right:400px;

}
.titre h1, .titre img {
    display: flex;
    justify-content:center;
}
.titre h1{
text-align:center;
font-family:Ghibo;
font-size:100px;
}

body{
background: radial-gradient(circle, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 90%);;
}
@font-face {
  font-family: "Ghibo";
  src:
    url("Ghibo Talk.otf") format("opentype");
}

.pro {
margin-left:300px;
width:1200px;
height:80vh;
border:solid black 2px;
}

.pro button {
display:flex;
width:600px;
height:175px;

}
.pro img {
margin-left:10px;
margin-top:40px;
display:flex;
width:75px;
height:75px;
border-radius:100%;
}
.pro p{
font-family:Ghibo;
margin-left:20px;
margin-top:8px;
display:flex;
font-size:25px;
}

.pub {
margin-left:125px;
width:300px;
height:80vh;
border:solid black 2px;

}
.pub img{
width:295px;
height:80vh;

}
.contenue {
display:flex;
}


</style>



<script>
 let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");
  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
  });
  searchBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
  });
  
  </script>




