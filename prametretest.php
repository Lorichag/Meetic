<style>

@font-face {
  font-family: "Ghibo";
  src:
    url("Ghibo Talk.otf") format("opentype");
}

.Formulaire{
  	min-height: 100vh;
    margin-left:10%;
  	display: flex;
  	align-items: center;
  	justify-content: center;
}

* {
  box-sizing: border-box;
}

.Interieur{
  position: relative;
  width: 900px;
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

.Case {
  position: relative;
  margin-bottom: 30px;
  border-radius: 50px;
  border:solid grey 1px;
  margin-right:50px;
  margin-left:50px;
}

.Case:last-child {
  margin-right: 0;
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
  padding: 0;
  background: #9cf;
  color: #fff;
  text-transform: uppercase;
  font-family: muli-semibold;
  font-size: 15px;
  letter-spacing: 2px;
  transition: all .5s;
  position: relative;
  overflow: hidden;
}


.button-container {
  display: flex;
  justify-content: center;
}

.double{
  display: flex;
}

.single {
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

label{
    position:relative;
}

</style>



<?php 

session_start();
if(!$_SESSION['pseudo']){
    header('Location: login.php');
}

$bdd= new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');

$recupinfo = $bdd->prepare('SELECT * FROM users WHERE pseudo= ?');
$recupinfo->execute(array($_SESSION['pseudo']));
$info = $recupinfo->fetch();

if(isset($_POST['valider'])){
    $espece = $_POST['espece'];
    $race = $_POST['race'];

    $updateUser = $bdd->prepare('UPDATE users SET espece = ? , race = ? WHERE pseudo = ?');
    $updateUser->execute(array($espece,$race,$_SESSION['pseudo']));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="NavBar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="logo.png" class="icon">
            <div class="logo_name">AniMate</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
            </li>
            <li>
                <a href="connecting.php?id=<?= $_SESSION['id']; ?>">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Accueil</span>
                </a>
            </li>
            <li>
                <a href="profile.php?id=<?= $_SESSION['id']; ?>">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Profile</span>
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

    <div class="pub">
      <img src="https://nuostore.com/wp-content/uploads/2023/11/IBANEZ-AE295WK-300x775.jpg">
    </div>



<div class="Formulaire">
<div class="Interieur">
    <form method="POST"  align="center" class="te" action="profile.php">
    	<h3>Informations Personnelles</h3>
        <div class="single">
            <div class="Case">
                <i class='bx bx-user-circle' id="test"></i>
	    		<input class="Custom" input disabled="disabled" name="pseudo">
	        </div>
        </div>
        <div class="double">
	    	<div class="Case">
                <i class='bx bxs-calendar ' style='color:#da2f18' id="test" ></i>
	    		<input class="Custom" input disabled="disabled" name="pseudo">
	    	</div>
            <div class="Case">  
                <i class='bx bx-female-sign' id="test"></i>
	    		<input class="Custom" input disabled="disabled" name="pseudo">
	    	</div>
            
        </div>
        <div class="double">
        	<div class="Case">
                    <img src="dog.png" id="test">
                    <input class="Custom" input disabled="disabled" name="race">
        	</div>
        	
        	<div class="Case">
                    <input class="Custom" input disabled="disabled" name="pseudo">
        	</div>
        </div>
        <div class="button-container">
        <input class="button" type="submit" name="valider" value="Enregistrer les modifications">
      </div>

    </form>
        </div>
    </div>




    <?php 
    if(!isset($_GET["modifier"])){
    ?>
    <div class="info1">
        <p>Pseudo: <?= $info['pseudo']; ?></p>
        <p>Age: <?= $info['age']; ?> ans</p>
        <p>Sexe: <?= $info['sexe']; ?></p>
        <p>Espece: <?= $info['espece']; ?></p>
        <p>Race: <?= $info['race']; ?></p>
        <a href="?modifier=1">Modifier</a>
    </div>
    <?php 
    }
    else { 
    ?>
        <form method="POST" action="profile.php">
            <p>Pseudo:<input disabled="disabled" name="pseudo" value="<?= $info['pseudo']; ?>"></p>
            <p>Age: <input disabled="disabled" name="age" value="<?= $info['age']; ?>"></p>
            <p>Sexe: <input disabled="disabled" name="sexe" value="<?= $info['sexe']; ?>"></p>
            <p>Espece: <input type="text" name="espece" value="<?= $info['espece']; ?>"></p>
            <p>Race: <input type="text" name="race" value="<?= $info['race']; ?>"></p>
            <input type="submit" name="valider" value="Enregistrer les modifications">
        </form>
    </div>
    <?php 
    } 
    ?>


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

    function redirectMessagerie(userId) {
        if(userId) {
            window.location.href = "messagerie.php?id=" + userId;
        }
    }

    document.getElementById('log_out').addEventListener('click', function() {
        document.getElementById('logout-form').submit();
    });
</script>