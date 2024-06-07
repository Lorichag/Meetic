<?php 
session_start();
if(!isset($_SESSION['pseudo'])){
    header('Location: login.php');
    exit();
}

$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');

$recupinfo = $bdd->prepare('SELECT * FROM users WHERE pseudo= ?');
$recupinfo->execute(array($_SESSION['pseudo']));
$info = $recupinfo->fetch();
$pseudo = $_SESSION['pseudo'];
$nom_dossier = "uploads";

if (!is_dir($nom_dossier)) {
    mkdir($nom_dossier);
}

if(isset($_POST['valider'])){
    $espece = $_POST['espece'];
    $race = $_POST['race'];
    $bio = $_POST['bio'];

    // Définir le nom du fichier de profil initialement à l'ancien nom
    $newProfilName = $info['profil'];

    if (isset($_FILES['profil']) && $_FILES['profil']['error'] == 0) {
        $profilFileType = strtolower(pathinfo($_FILES["profil"]["name"], PATHINFO_EXTENSION));
        $target1 = 'image/';
        $newProfilName = $_SESSION['pseudo'].'_profil.'.$profilFileType;
        $target_profil = $target1.$newProfilName;
        move_uploaded_file($_FILES["profil"]["tmp_name"], $target_profil);    
    }
    
    $verife = $bdd->prepare('SELECT * FROM image WHERE pseudo = ?');
    $verife->execute(array($pseudo));
    
    if($verife->rowCount() < 5){
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
            $target = 'uploads/';
            $newFileName = uniqid('image_', true) . '.'.$imageFileType;
            $target_file = $target.$newFileName;    
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                $insertImage = $bdd->prepare('INSERT INTO image(pseudo, nom_image) VALUES(?, ?)');
                $insertImage->execute(array($_SESSION['pseudo'], $newFileName));
            } else {
                echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
            }
        }
    }
    
    $updateUser = $bdd->prepare('UPDATE users SET espece = ?, race = ?, profil = ?, bio = ? WHERE pseudo = ?');
    $updateUser->execute(array($espece, $race, $newProfilName, $bio, $_SESSION['pseudo']));

    // Reload the page
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['unblock_user'])) {
    $userIdToUnblock = $_POST['user_id'];
    $deleteBlock = $bdd->prepare('DELETE FROM bloquer WHERE id_au = ? AND id_sig = ?');
    $deleteBlock->execute(array($info['id'], $userIdToUnblock));

    // Reload the page
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch blocked users
$blockedUsers = $bdd->prepare('SELECT users.id, users.pseudo, users.age, users.sexe, users.espece, users.race 
                               FROM bloquer 
                               JOIN users ON bloquer.id_sig = users.id 
                               WHERE bloquer.id_au = ?');
$blockedUsers->execute(array($info['id']));


$recupUser = $bdd->prepare('SELECT * FROM users WHERE id NOT IN 
    (SELECT id_sig FROM bloquer WHERE id_au = ?) 
    AND id NOT IN (SELECT id_au FROM bloquer WHERE id_sig = ?) 
    AND id != ? ORDER BY id DESC');
$recupUser->execute(array($_SESSION['id'], $_SESSION['id'], $_SESSION['id']));


if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = htmlspecialchars($_GET['q']);
    
    $recupUser = $bdd->prepare('SELECT id, pseudo, profil FROM users 
                                WHERE id NOT IN (SELECT id_sig FROM bloquer WHERE id_au = ?) 
                                AND id NOT IN (SELECT id_au FROM bloquer WHERE id_sig = ?) 
                                AND pseudo LIKE ? 
                                ORDER BY id DESC');
    $recupUser->execute(array($_SESSION['id'], $_SESSION['id'], "%$q%"));
} else {
    $recupUser = $bdd->prepare('SELECT id, pseudo, profil FROM users 
                                WHERE id NOT IN (SELECT id_sig FROM bloquer WHERE id_au = ?) 
                                AND id NOT IN (SELECT id_au FROM bloquer WHERE id_sig = ?) 
                                ORDER BY id DESC');
    $recupUser->execute(array($_SESSION['id'], $_SESSION['id']));
}




?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="messagerie.css">
    <link rel="stylesheet" href="NavBar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <img src="image/logo.png" class="icon">
        <a href="connecting.php?id=<?= $_SESSION['id']; ?>">
            <div class="logo_name">AniMate</div>
        </a>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
        <i class='bx bx-search' ></i>
            <form method="GET" action="connecting.php?id=<?= $_SESSION['id']; ?>">
                <input type="search" name="q" placeholder="Recherche..." />
            </form>
        </li>
        <li>
            <a href="connecting.php?id=<?= $_SESSION['id']; ?>">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Accueil</span>
            </a>
        </li>
        <li>
            <a href="profil.php?id=<?= $_SESSION['id']; ?>">
                <i class='bx bx-user'></i>
                <span class="links_name">Profil</span>
            </a>
        </li>
        <li>
            <a href="messagerie.php?id=<?= $_SESSION['id']; ?>">
                <i class='bx bx-chat'></i>
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
                <i class='bx bx-cog'></i>
                <span class="links_name">Paramètres</span>
            </a>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="image/<?= $info['profil']; ?>">
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

<div class="decaler">
<div class="contenue">

<div class="Formulaire">
<div class="Interieur">

    <?php 
    if(!isset($_GET["modifier"])){
    ?>
        <form align="center" class="te" >
        <h3>Informations Personnelles</h3>
        <div class="profile-image">
            <img src="image/<?= $info['profil']; ?>" alt="Profil Image" style="display:flex; justify-content:center;" width="150">
        </div>
        <div class="double">
            <div class="Case"> 
                <i class='bx bx-user-circle' id="test"></i>
                <input class="Custom" type="text" disabled="disabled" name="pseudo" value="<?= $info['pseudo']; ?>">
            </div>
            <div class="Case"> 
                <img src="image/courrier.png" id="test">
                <input class="Custom" type="text" disabled="disabled" name="mail" value="<?= $info['pseudo']; ?>">
            </div>
        </div>

        <div class="double">
            <div class="Case"> 
                <i class='bx bxs-calendar ' id="test" ></i>
                <input class="Custom" type="text" disabled="disabled" name="age" value="<?= $info['age']; ?> ans">
            </div>
            <div class="Case">
                <img src="image/sexe.png" id="test">
                <input class="Custom" type="text" disabled="disabled" name="sexe" value="<?= $info['sexe']; ?>">
            </div>
        </div>
        <div class="double">
            <div class="Case"> 
                <img src="image/dog.png"  id="test">
                <input class="Custom" type="text" disabled="disabled" name="espece" value="<?= $info['espece']; ?>">
            </div>
            <div class="Case"> 
                <img src="image/race.png"  id="test">
                <input class="Custom" type="text" disabled="disabled" name="race" value="<?= $info['race']; ?>">
            </div>
        </div>
        <div class="single">
            <p>Bio: <textarea name="bio"><?= $info['bio']; ?></textarea></p>
        </div>
        </br>
        <h3>Mes photos:</h3>
        <?php
            $recupImages = $bdd->prepare('SELECT nom_image FROM image WHERE pseudo = ?');
            $recupImages->execute(array($pseudo));
            while ($image = $recupImages->fetch()) {
                echo '<img src="uploads/'.$image['nom_image'].'" alt="" width="150">';
            }
        ?>
        
        <a href="?modifier=1"></a>
        <div class="button-container">
        <input class="button" value="Modifier" onclick="window.location.href = '?modifier=1';">
        </div>
        </form>

        <h3>Personnes bloquées:</h3>
        <ul>
        <?php
            while ($blocked = $blockedUsers->fetch()) {
                echo '<li>Pseudo: ' . $blocked['pseudo'] . ', Age: ' . $blocked['age'] . ', Sexe: ' . $blocked['sexe'] . ', Espece: ' . $blocked['espece'] . ', Race: ' . $blocked['race'];
                echo '<form method="POST" action="">
                        <input type="hidden" name="user_id" value="' . $blocked['id'] . '">
                        <input type="submit" name="unblock_user" value="Débloquer">
                      </form>
                      </li>';
            }
        ?>
        </ul>

    <?php 
    } 
    else { 
    ?>
        <form method="POST"  align="center" class="te" action="Paramètres.php" enctype="multipart/form-data">
        <h3>Informations Personnelles</h3>
        <div class="profile-image">
            <img src="image/<?= $info['profil']; ?>" alt="Profil Image" style="display:flex; justify-content:center;" width="150">
        </div>
        <div class="double">
            <div class="Case"> 
                <i class='bx bx-user-circle' id="test"></i>
                <input class="Custom" type="text" disabled="disabled" name="pseudo" value="<?= $info['pseudo']; ?>">
            </div>
            <div class="Case"> 
                <img src="image/courrier.png" id="test">
                <input class="Custom" type="text" disabled="disabled" name="mail" value="<?= $info['mail']; ?>">
            </div>
        </div>
        <div class="double">
            <div class="Case"> 
                <i class='bx bxs-calendar ' id="test" ></i>
                <input class="Custom" type="text" disabled="disabled" name="age" value="<?= $info['age']; ?>">
            </div>
            <div class="Case">
                <img src="image/sexe.png" id="test">
                <input class="Custom" type="text" disabled="disabled" name="sexe" value="<?= $info['sexe']; ?>">
            </div>
        </div>
        <div class="double">
            <div class="Case"> 
                <img src="image/dog.png"  id="test">
                <input class="Custom" type="text" name="espece" value="<?= $info['espece']; ?>">
            </div>
            <div class="Case"> 
                <img src="image/race.png"  id="test">
                <input class="Custom" type="text"name="race" value="<?= $info['race']; ?>">
            </div>
        </div>
        <div class="single">
            <p>Bio: <textarea name="bio"><?= $info['bio']; ?></textarea></p>
        </div>
        </br>

        <p>Photo de profil: <input type="file" name="profil"></p>
        <p>Ajouter une photo: <input type="file" name="image" id="fileToUpload"></p>
            <div class="button-container">
                <input class="button" type="submit" name="valider" value="Enregistrer les modifications">
            </div>
    <?php 
    } 
    ?>

</div>
</div>

<div class="pub">
        <img id="randomImage" class="t" src="" alt="Publicité">
    </div>

</div>
</div>
    
    </body>
</html>

<script>
        const images = ["image/Pub.png", "image/Pub1.png", "image/Pub2.png", "image/Pub3.png", "image/Pub4.png"];

        function getRandomImage() {
            const randomIndex = Math.floor(Math.random() * images.length);
            return images[randomIndex];
        }
        // Sélectionner l'élément img et définir son attribut src
        document.getElementById('randomImage').src = getRandomImage();
    </script>
<style>

@font-face {
  font-family: "Ghibo";
  src:
    url("Ghibo Talk.otf") format("opentype");
}

body{
background: radial-gradient(circle, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 90%);;
}

.contenue {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

.Formulaire{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin:auto;
}

* {
  box-sizing: border-box;
}

.Interieur{
  position: relative;
  width: 900px;
  margin-left:150px;
}


.te {
  width: 100%;
  position: relative;
  z-index: 9;
  padding: 77px 61px 66px;
  background: #fff;
  border-radius:50px;
  border:solid black 2px;
  box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
}

h3 {
  text-transform: uppercase;
  font-size: 50px;
  font-family: Ghibo;
  margin-bottom:40px;
  color: #333;
  letter-spacing: 3px;
  text-align: center;
}

.double .Case{
    margin-right:20px;
    margin-left:20px;
}

.Case {
  position: relative;
  margin-bottom: 30px;
  border-radius: 50px;
  border:solid grey 1px;
}

.Case:last-child {
  margin-right: 0;
}

.Case:first-child {
  margin-left: 0;
}


.Case #test {
  position: absolute;
  left: 5%;
  top: 50%;
  transform: translateY(-50%);
  font-size: 20px;
  width:20px;
  color: #333;
}



.Custom {
  border: none;
  display: block;
  width: 100%;
  height: 38px;
  background: 0 0;
  padding: 3px 42px 0;
  color: #666;
  font-family: muli-semibold;
  font-size: 16px;
  text-align: center;
}

.Radio{
	border: none;
	height: 100px;
	display: block;
	width: 100%;
  	background: 0 0;
  	padding: 30px 70px 0;
  	font-size: 16px;
  	color: #666;
  	font-family: muli-semibold;
}


.button {
  border: none;
  width: 50%;
  height: 49px;
  border-radius:10px;
  margin-top: 50px;
  cursor: pointer;
  display:flex;
  align-items: center;
  text-align:center;
  padding: 0;
  background: #9cf;
  color: #fff;
  text-transform: uppercase;
  font-family: muli-semibold;
  font-size: 15px;
  letter-spacing: 2px;
  transition: all .5s;
  position: relative;
}


.button-container {
  display: flex;
  justify-content: center;
}

.single, .double {
  display: flex;
  justify-content: center;
}

.pub {
margin-left:125px;
width:300px;
float:right;
height:775px;
border:solid black 2px;

}
.pub img{
width:295px;
height:770px;

}

.profile-image {
  display: flex;
  justify-content: center;
  margin-bottom: 30px;
}

</style>

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

    function redirectMessagerie(userId) {
        window.location.href = "profil.php?id=" + userId;
    }
    document.getElementById('log_out').addEventListener('click', function() {
        document.getElementById('logout-form').submit();
    });
  </script>