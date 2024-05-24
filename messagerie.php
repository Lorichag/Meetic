



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
$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');
if(!$_SESSION['pseudo']){
    header('Location: login.php');

}

if(isset($_GET['id']) and !empty($_GET['id'])){
    $getid = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM users WHERE id= ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount()>0){
        if(isset($_POST["envoyer"])){
            $message=htmlspecialchars($_POST['message']);
            $inseremessage = $bdd->prepare('INSERT INTO messages(message, id_des, id_au)VALUES(?,?,?)');
            $inseremessage->execute(array($message, $getid, $_SESSION['id']));

        }
    }
    else{
        echo " aucun utilisateur";
    }
}
else{
    echo "Aucun id trouvé";
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
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Accueil</span>
        </a>
      </li>
      <li>
       <a href="#">
         <i class='bx bx-user' ></i>
         <span class="links_name">Profile</span>
       </a>
     </li>
     <li>
       <a href="#">
         <i class='bx bx-chat' ></i>
         <span class="links_name">Messages</span>
       </a>
     </li>
     <li>
       <a href="#">
         <i class='bx bx-pie-chart-alt-2' ></i>
         <span class="links_name">Analytics</span>
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
             <div class="name">Soup</div>
           </div>
         </div>
         <i class='bx bx-log-out' id="log_out" ></i>
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
            <p class="ut"><?= $user['pseudo']; ?></p>
        </div>
        </button>
    <?php
            }
        }
    ?>
</div>


  <div class="ChatConteneur"> 
    <div class="header">
      <p>Mathis</p> <!-- Faut mettre le nom de l'utilisateur à qui on parle -->
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
        <p><?= $message['message']; ?></p>
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
</div>
  
  

 
</body>
        </html>

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

<script>
    function redirectMessagerie(userId) {
        if(userId) {
            window.location.href = "messagerie.php?id=" + userId;
        }
    }

</script>

