<?php 
session_start();

if(!isset($_SESSION['mdp'])){
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
$query = $bdd->prepare('SELECT profil, abo FROM users WHERE id = ?');
$query->execute(array($_SESSION['id']));
$userData = $query->fetch();
$photo = $userData['profil']; 
$abo = $userData['abo'];

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
        <img src="image\logo.png" class="icon"></img>
        <div class="logo_name">AniMate</div>
        <i class='bx bx-menu' id="btn" ></i>
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
                <i class='bx bx-user' ></i>
                <span class="links_name">Profile</span>
            </a>
        </li>
        <li>
            <?php if($abo==1){?>
            <a href="messagerie.php?id=<?= $_SESSION['id']; ?>">
                <i class='bx bx-chat' ></i>
                <span class="links_name">Messages</span>
            </a>
            <?php }
            ?>
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
                <img src="image/<?=$photo?>">
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
        <div class="profil">
            <div class="titre">
                <h1>Animate</h1>
            </div>

            <div class="Tableau">
                    <?php
                    while ($user = $recupUser->fetch()) {
                        if($user['id']!=$_SESSION['id']){
                        ?>
                        <button class="bouton" onclick="redirectMessagerie(<?= $user['id']; ?>)">
                            <div class="case">
                                <img src="image/<?= $user['profil']; ?>" class="icon1"> <!-- Utilisez la colonne photo_profil pour l'URL de l'image -->
                                <p class="ut"><?= $user['pseudo']; ?></p>
                            </div>
                        </button>
                        <?php
                        }
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
    body{
        background: radial-gradient(circle, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 90%);;
    }

    @font-face {
        font-family: "Ghibo";
        src:
        url("Ghibo Talk.otf") format("opentype");
    }

    .contenue {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .profil {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        height: 100vh;
        margin:auto;
    }

    .titre h1{
        font-family:Ghibo;
        font-size:100px;
        color:brown;
    }

    .Tableau{
        box-sizing: border-box;
        width:1000px;
        height:80vh;
        display:flex;
        border:solid;
        flex-wrap: wrap;
        overflow-y:auto;
    }

    .Tableau button{
        width:50%;
        margin:0;
        height:50%;
        padding:0;
        background: radial-gradient(circle, rgba(207,229,245,1) 35%, rgba(51,204,255,1) 67%, rgba(255,153,204,1) 89%);
    }

    .Tableau img{
        width:50%;
        border-radius:10px;
    }

    .Tableau p{
        font-size:25px;
        font-family:Ghibo;
        margin-top:10px;
    }

    .pub {
        margin-top: 25px;
        float: right;
        width: 300px;
        height: 800px;
        border: solid black 2px;

    }
    .pub img {
        width: 295px;
        height: 100%;
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



