<style>
.Messagerie {
  display: flex;
  height: 100vh; /* Utilisez vh (viewport height) au lieu de hv */
}

.Liste {
    width: 300px;
    margin-left: 78px;
    text-align: center;
    display: flex;
    flex-direction: column; /* Align items vertically */
    border: solid black;
    overflow-y:auto;
}

.bouton {
    width: 100%;
    height: 50px;
}

.icon1 {
    margin-left: 10px;
}

.case {
    display: flex;
}

.ChatConteneur {
    flex-grow: 1;
  width:100%;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
}

.message-container {
    display: flex;
    flex-direction: column;
    flex-grow: 1; /* Pour que la zone de messages prenne tout l'espace vertical */
    overflow-y: auto; /* Pour permettre le défilement si le contenu dépasse */
}

.messages {
    padding: 10px;
    margin: 10px;
    border-radius: 5px;
    max-width: 100%;
    word-wrap: break-word;
    display: flex;
    align-items: center;
}

.envoyeur {
    background-color: #e0e0e0;
    color: #000;
    align-self: flex-start;
}

.receveur {
    background-color: #4CAF50;
    color: #fff;
    align-self: flex-end;
}

.avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}

.messages input {
    width: calc(100% - 10px);
    padding: 8px;
    margin: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.messages button {
    padding: 8px;
    margin: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.contain{
  display:flex;
  width:100%;
}

.header{
  padding:20px;
  background:red;
}

</style>




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

$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');

if(!isset($_SESSION['pseudo'])){
    header('Location: login.php');
    exit();
}

$pseudoUtilisateurCible = "Utilisateur inconnu"; // Valeur par défaut au cas où l'ID n'est pas trouvé ou n'est pas fourni

if(isset($_GET['id']) && !empty($_GET['id'])){
    $getid = intval($_GET['id']); // Assurez-vous que c'est un entier
    $recupUser = $bdd->prepare('SELECT pseudo FROM users WHERE id = ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() > 0){
        $user = $recupUser->fetch();
        $pseudoUtilisateurCible = htmlspecialchars($user['pseudo']); // Récupérer et sécuriser le pseudo
        if(isset($_POST["envoyer"])){
            $message = htmlspecialchars($_POST['message']);
            $inseremessage = $bdd->prepare('INSERT INTO messages(message, id_des, id_au) VALUES (?, ?, ?)');
            $inseremessage->execute(array($message, $getid, $_SESSION['id']));
        }
    } else {
        echo "Aucun utilisateur trouvé";
    }
} else {
    echo "Aucun id trouvé";
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="NavBar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
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

    <div class="Messagerie">
        <div class="Liste">
            <?php 
            $recupUser = $bdd->query('SELECT * FROM users');
            while($user = $recupUser->fetch()){
                if($user['id'] != $_SESSION['id']){
            ?>
            <button class="bouton" onclick="redirectMessagerie(<?= $user['id']; ?>)">
                <div class="case">
                    <img src="omg.png" class="icon1">
                    <p class="ut"><?= htmlspecialchars($user['pseudo']); ?></p>
                </div>
            </button>
            <?php
                }
            }
            ?>
        </div>

        <div class="ChatConteneur"> 
            <div class="header">
                <p><?= $pseudoUtilisateurCible; ?></p> <!-- Afficher le pseudo de l'utilisateur à qui on parle -->
            </div>

            <div class="message-container" id="message">  
                <?php 
                $recupMessage = $bdd->prepare('SELECT * FROM messages WHERE (id_au = ? AND id_des = ?) OR (id_au = ? AND id_des = ?)');
                $recupMessage->execute(array($_SESSION['id'], $getid, $getid, $_SESSION['id']));
                while($message = $recupMessage->fetch()){
                    $classeMessage = ($message['id_au'] == $_SESSION['id']) ? 'receveur' : 'envoyeur';
                ?>
                <div class="messages <?= $classeMessage ?>"> 
                    <img src="logo.png" class="avatar"> 
                    <p><?= htmlspecialchars($message['message']); ?></p>
                </div> 
                <?php
                }
                ?>
            </div>
            
            <div class="messages">
                <form method="POST" action="" class="contain">
                <?php
                if($_SESSION["id"] != $getid){
                ?>
                    <input type="text" name="message" placeholder="Type your message..."> 
                    <button type="submit" name="envoyer">Send</button>
                <?php
                }
                ?>
                </form>
            </div>
        </div> 
    </div>
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