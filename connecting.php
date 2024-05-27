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

if(isset($_POST['m'])){
    header('Location: messagerie.php?id='.$_SESSION["id"]);
    exit();
}

if(isset($_POST['p'])){
    header('Location: profil.php?pseudo='.$_SESSION['pseudo']);
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
    echo "Aucun ID trouvé.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connecting</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <img src="image/logo.png" class="icon"></img>
      <div class="logo_name">AniMate</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
          <i class='bx bx-search'></i>
          <input type="text" placeholder="Search...">
      </li>
      <li>
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Accueil</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-user'></i>
          <span class="links_name">Profile</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-chat'></i>
          <span class="links_name">Messages</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2'></i>
          <span class="links_name">Analytics</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
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
        </form>
      </li>
    </ul>
  </div>
  <a id="abo" href="page-abo.php">Abonnement</a>
  <div class="titre">
    <h1>Animate</h1>
    <img src="image/logo.png">
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
      window.location.href = "messagerie.php?id=" + userId;
    }
    document.getElementById('log_out').addEventListener('click', function() {
      document.getElementById('logout-form').submit();
    });
  </script>
</body>
</html>


<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins" , sans-serif;
}
.sidebar{
  position: fixed;
  left: 0;
  top: 0;
  height: 100%;
  width: 78px;
  background: radial-gradient(circle, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 90%);;
  padding: 6px 14px;
  z-index: 99;
  transition: all 0.5s ease;
}

.sidebar.open{
  width: 250px;
}

.sidebar .logo-details{
  height: 60px;
  display: flex;
  align-items: center;
  position: relative;
}

.sidebar .logo-details .icon{
  opacity: 0;
  width: 50px;
  transition: all 0.5s ease;
}

.sidebar .logo-details .logo_name{
  color: #fff;
  font-size: 20px;
  font-weight: 600;
  margin-left: 20px;
  opacity: 0;
  transition: all 0.5s ease;
}

.sidebar.open .logo-details .icon,
.sidebar.open .logo-details .logo_name{
  opacity: 1;
}

.sidebar .logo-details #btn{
  position: absolute;
  top: 50%;
  right: 0;
  transform: translateY(-50%);
  cursor: pointer;
  transition: all 0.5s ease;
}
.sidebar.open .logo-details #btn{
  text-align: right;
}

.sidebar i{
  color: #fff;
  min-width: 50px;
  font-size: 28px;
  text-align: center;
}

.sidebar li{
  position: relative;
  margin: 30px 0;
  list-style: none;
}

.sidebar input{
  font-size: 15px;
  color: white;
  font-weight: 400;
  height: 49px;
  width: 50px;
  border:none;
  border-radius: 12px;
  transition: all 0.5s ease;
}

.sidebar.open input{
  padding: 0 20px 0 50px;
  width: 100%;
  background:black;
}

.sidebar .bx-search{
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  font-size: 22px;
  background: rgba(253,187,45,1);
  color: #FFF;
}

.sidebar.open .bx-search:hover, .sidebar .bx-search:hover{
  background: white;
  color: black;
}

.sidebar li a{
  display: flex;
  border-radius: 12px;
  align-items: center;
  text-decoration: none;
  transition: all 0.4s ease;
  background: rgba(253,187,45,1);
}

.sidebar li a:hover{
  background: #FFF;
}

.sidebar li a .links_name{
  color: #fff;
  font-size: 15px;
  font-weight: 600;
  opacity: 0;
  transition: 0.4s;
}

.sidebar.open li a .links_name{
  opacity: 1;
}

.sidebar li a:hover .links_name,
.sidebar li a:hover i{
  transition: all 0.5s ease;
  color: #11101D;
}

.sidebar li i{
  height: 50px;
  line-height: 50px;
  font-size: 18px;
  border-radius: 12px;
}
.sidebar li.profile{
  position: fixed;
  height: 60px;
  width: 78px;
  left: 0;
  bottom: -30px;
  padding: 10px 14px;
  background: #1d1b31;
  transition: all 0.5s ease;
  overflow: hidden;
}

.sidebar.open li.profile{
  width: 250px;
}

.sidebar li .profile-details{
  display: flex;
  align-items: center;
  flex-wrap: nowrap;
}

.sidebar li img{
  height: 45px;
  width: 45px;
  object-fit: cover;
  border-radius: 6px;
  margin-right: 10px;
}
.sidebar li.profile .name{
  font-size: 15px;
  font-weight: 400;
  color: #fff;
  white-space: nowrap;
}

.sidebar .profile #log_out{
  position: absolute;
  top: 50%;
  right: 0;
  transform: translateY(-50%);
  background: #1d1b31;
  width: 100%;
  height: 60px;
  line-height: 60px;
  border-radius: 0px;
  transition: all 0.5s ease;
}
.sidebar.open .profile #log_out{
  width: 50px;
  background: none;
}
#abo {
background: skyblue;
border-radius:10px;
padding: 10px;
text-decoration: none;
color: black ;
 top:10px;   
 right:10px; 
position:fixed;

}
 

form {
margin-right:400px;

}
.titre h1, .titre img {
    display: inline-block;
    vertical-align: middle; /* Pour aligner verticalement le texte et l'image */
}
.titre h1{
margin-left:700px;
font-family:Ghibo;
font-size:100px;
}

.titre img {
width:60px;
margin-left:10px;
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
height:775px;
border:solid black 2px;

}
.pub img{
width:295px;
height:770px;

}
.contenue {
display:flex;
}


</style>



<script>
 let sidebar = document.querySelector(".sidebar");
let Texte=document.querySelector('.Texte');
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");
  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    Texte.classList.toggle("open");
  });
  searchBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    Texte.classList.toggle("open");
  });
  
  </script>




