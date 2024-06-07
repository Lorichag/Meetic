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


$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'lancericha', 'neingee8kialohB');


if(!$_SESSION['pseudo']){
    header('Location: login.php');
    exit();
}

if(isset($_GET['id']) and !empty($_GET['id'])){
  $recupinfo = $bdd->prepare('SELECT * FROM users WHERE id= ?');
  $recupinfo->execute(array($_GET['id']));
  $user = $recupinfo->fetch();
  $profil= htmlspecialchars($user["profil"]);
} 
else {
  header('Location: connecting.php?id='.$_SESSION['id']);
}

if(isset($_POST['signaler'])) {
  $messageId = $_POST['message'];
  $motif = $_POST['motif'];
  $date = date('Y-m-d H:i:s');
  $utilisateur_signaler = $getid;
  $type=$_POST['type'];
  $insertDemande = $bdd->prepare('INSERT INTO demandes(utilisateur, dates, types, motif, descriptions, utilisateur_signaler) VALUES(?, ?, ?, ?, ?, ?)');
  $insertDemande->execute(array($_SESSION['id'], $date, $type, $motif, $messageId, $utilisateur_signaler)); 
}

if(isset($_POST['block_user'])) {
  $blockid = $_POST['user_id'];
  $date = date('Y-m-d H:i:s');
  $insertDemande = $bdd->prepare('INSERT INTO bloquer(id_au, id_sig, date) VALUES(?, ?, ?)');
  $insertDemande->execute(array($_SESSION['id'],$_GET['id'],$date));
}

if(isset($_POST['ecrire_user'])) {
  $écrireid = $_POST['user_name'];
  $verife = $bdd->prepare('SELECT * FROM conv WHERE id_des = ? and id_au = ? or id_au = ? and id_des = ?' );
  $verife->execute(array($écrireid, $_SESSION['id'], $_SESSION['id'],$écrireid));
  if($verife->rowCount() == 0){
  $insertDemande = $bdd->prepare('INSERT INTO conv(id_au, id_des) VALUES(?, ?)');
  $insertDemande->execute(array($_SESSION['id'],$_GET['id']));
  }
}

$query = $bdd->prepare('SELECT profil, abo FROM users WHERE id = ?');
$query->execute(array($_SESSION['id']));
$userData = $query->fetch();
$photo = $userData['profil']; 
$abo = $userData['abo'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="NavBar.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
      <img src="image/logo.png" class="icon"></img>
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
           <img src="image/<?= $profil ?>">
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

<div id="signalement" class="modal">
    <div class="modal-content">
        <span id="close" class="close" onclick="closeModal()">&times;</span>  
          <p>Signalement</p>
          <br>
          <button class="signalement" data-button="Arnaqueur">Arnaqueur</button>
          <br>
          <button class="signalement" data-button="Usurpation">Usurpation</button>
        </div>
    </div>
<div class="overlay" onclick="closeModal()"></div>

  <div class="contenue">
    <div class="profil">
      <div class="profileImg">
        <img src="image/<?= $profil ?>" class="profileImg1">
      </div>
      <div class="Nom">
        <h1 style="font-family:Ghibo; font-size:100px; color:brown;"><?= $user['pseudo']; ?></h1>
        <?php if($_SESSION['id']==$_GET['id']){?>
          <a href="prametretest.php?<?=$_SESSION['id']?>" id="modo">Modifier</a>
        <?php }else{?>
          <button class="report-btn" data-profil-id="<?= $user['id']; ?>">Signaler</button>
          <button class="block-btn" data-user-id="<?= $user['id']; ?>">Bloquer</button>
          <?php if($userData['abo']==1){?>
          <button class="message-btn" data-profil-name="<?= $user['id']; ?>">Ecrire</button>
        <?php
          }
        }?>

      </div>
      <div class="Informations">
          <div class="détail">
            <p>Age : <?= $user['age']; ?> </p>
            <p>Race : <?= $user['race']; ?> </p>
            <p>Espèce : <?= $user['espece']; ?> </p>
          </div>
          <div class="Apropos">
            <h3 style="font-weight:bold; text-decoration:underline; text-align:center;">A propos de moi : </h3>
            <p><?=$user['description']?></p>
          </div>
      </div>
      <div class="Galerie">
        <img src="https://img.freepik.com/photos-gratuite/vue-forme-coeur-montagnes-paysage-lacustre_23-2150825103.jpg">
        <img src=" https://static.vecteezy.com/ti/photos-gratuite/p2/26498142-une-magnifique-paysage-avec-une-etourdissant-le-coucher-du-soleil-plus-de-une-tranquille-lac-ai-generatif-photo.jpg">
        <img src="https://images.unsplash.com/photo-1617634667039-8e4cb277ab46?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bmF0dXJlJTIwcGF5c2FnZXxlbnwwfHwwfHx8MA%3D%3D">
      </div>
    </div>

    <div class="pub">
      <img src="https://nuostore.com/wp-content/uploads/2023/11/IBANEZ-AE295WK-300x775.jpg">
    </div>
  </div>

  <style>
#modo {
  display:flex;
  justify-content:center;
  text-decoration:none;
  color:black;
  border: solid black 2px;
}
 .profil {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      height: 100vh;
      padding-top: 20px;
      margin:auto;
    }

    .profileImg1 {
      border-radius: 50%;
      width: 250px;
      height: 250px;
      border: solid;
    }

    .contenue {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    .Informations {
      border: 2px solid red;
      padding: 20px;
      margin-top: 20px;
      width: 100%;
      max-width:700px;
      box-sizing: border-box;
    }

    .détail{
      display:flex;
      justify-content:center;
      border:solid;
    }

    .détail p{
      padding:10px;
    }

    .Apropos, .Galerie{
      margin-top:15px;
    }
    
    .Galerie img{
      width:310px;
      height:470px;
      margin-bottom:30px;
      margin-right:5px;
      margin-left:5px;
      border:solid;
    }

    .pub {
      margin-top: 50px;
      float: right;
      width: 300px;
      height: 800px;
      border: solid black 2px;
    }

    .pub img {
      width: 295px;
      height: 100%;
    }

    body {
      background: radial-gradient(circle, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 90%);
    }

    @font-face {
      font-family: "Ghibo";
      src: url("Ghibo Talk.otf") format("opentype");
    }
    .modal {
    display: none;
    height: 20%;
    width: 20%;
    position: fixed;
    z-index: 1000;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.modal-content {
    position: relative;
    text-align: center;
    font-size: 125%;
}

.modal-content button {
    background-color: white;
    width: 100%;
    size: 40%;
    border: none;
    margin-top: 10px;
    font-size: 100%;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

.overlay {
    display: none;
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.close{
    color: #aaa;
    float: right;
    font-size: 25px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.modal-content button:focus,
.modal-content button:hover {
    background-color: gray;
    border: none;
}
  </style>
</body>
</html>

<script>
    function closeModal() {
            var signalementDiv = document.getElementById('signalement');
            signalementDiv.style.display = 'none';
            var overlay = document.querySelector('.overlay');
            overlay.style.display = 'none';
    }

    let sidebar = document.querySelector(".sidebar");
    let decaler = document.querySelector(".decaler");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        decaler.classList.toggle("open");
    });

    searchBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        decaler.classList.toggle("open");
    });

    $(document).ready(function() {

        var profil;

        function reportProfil(category) {
            if (profil) {
                $.ajax({
                    type: "POST",
                    url: "profil.php?id=<?= $_GET['id']; ?>",
                    data: {
                        signaler: true,
                        message: profil,
                        motif: category,
                        type: 'profil',
                    },
                    success: function(response) {
                        console.log("Message signalé avec succès");
                        var signalementDiv = document.getElementById('signalement');
                        signalementDiv.style.display = 'none';
                    },
                    error: function(xhr, status, error) {
                        console.error("Erreur lors du signalement du message :", error);
                    }
                });
            }
        }

        $(document).on('click', '.report-btn', function() {
            profil = $(this).data('profil-id');
            Signalement();
        });

        $(document).on('click', '.signalement', function() {
            var type = $(this).data('button');
            reportProfil(type);
        });

        function Signalement() {
            var signalementDiv = document.getElementById('signalement');
            signalementDiv.style.display = 'block';
            var overlay = document.querySelector('.overlay');
            overlay.style.display = 'block';
        }

        $('.signalement').click(function() {
            closeModal();
        });
    });

    $(document).on('click', '.block-btn', function() {
        var userName = $(this).data('user-id');
        blockUser(userName);
    });

    function blockUser(userName) {
        $.ajax({
            type: "POST",
            url: "profil.php?id=<?= $_GET['id']; ?>",
            data: {
                block_user: true,
                user_name: userName,
            },
            success: function(response) {
                console.log("Utilisateur bloqué avec succès :", userName);
                window.location.href = "connecting.php?id=<?= $_SESSION['id']; ?>";
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors du blocage de l'utilisateur :", error);
            }
        });
    }

    $(document).on('click', '.message-btn', function() {
        var userid = $(this).data('profil-name');
        Ecrire(userid);
    });

    function Ecrire(userid) {
        $.ajax({
            type: "POST",
            url: "profil.php?id=<?= $_GET['id']; ?>",
            data: {
                ecrire_user: true,
                user_name: userid,
            },
            success: function(response) {
                console.log("Utilisateur bloqué avec succès :", userid);
                window.location.href = "messagerie.php?id=<?= $_GET['id'] ?>";
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors du blocage de l'utilisateur :", error);
            }
        });
    }
</script>