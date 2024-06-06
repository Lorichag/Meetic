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

$bdd = new PDO('mysql:host=localhost;dbname=rencontres;charset=utf8', 'root');

$recupinfo = $bdd->prepare('SELECT age, espece, race FROM users WHERE pseudo= ?');
$recupinfo->execute(array($_SESSION['pseudo']));
$info = $recupinfo->fetch();

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
        </form>
      </li>
    </ul>
  </div>

  <div class="contenue">
    <div class="profil">
      <div class="profileImg">
        <img src="logo.png" class="profileImg1">
      </div>
      <div class="Nom">
        <h1 style="font-family:Ghibo; font-size:100px; color:brown;"><?= $_SESSION['pseudo']; ?></h1>
      </div>
      <div class="Informations">
          <div class="Détail">
            <p>Age : <?= $info['age']; ?> </p>
            <p>Race : <?= $info['race']; ?> </p>
            <p>Espèce : <?= $info['espece']; ?> </p>
          </div>
          <div class="Apropos">
            <h3 style="font-weight:bold; text-decoration:underline; text-align:center;">A propos de moi : </h3>
            <p>Le Lorem Ipsum est simplement du
               faux texte employé dans la composition et la mise en page avant impression.
                Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un
                 imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.
                  Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu
                   n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du 
                   Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>
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

  </style>
</body>
</html>

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
