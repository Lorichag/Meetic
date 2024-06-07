<?php 
session_start();
$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'lancericha', 'neingee8kialohB');
if(!$_SESSION['pseudo']){
    header('Location: login.php');
    exit();
}

$getid = $_GET['id'];

if(isset($getid) && !empty($getid)){
    $recupUser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() > 0){
        $user = $recupUser->fetch();
        $cible = htmlspecialchars($user['pseudo']);
        $photo = htmlspecialchars($user['profil']);
        if(isset($_POST['message'])) {
            $date = date('Y-m-d H:i:s');
            $message = htmlspecialchars($_POST['message']);
            if (!empty($message)) {
                $inseremessage = $bdd->prepare('INSERT INTO messages(message, id_des, id_au, date) VALUES(?, ?, ?, ?)');
                $inseremessage->execute(array($message, $getid, $_SESSION['id'], $date));
            }
        }
    } else {
        echo "Aucun utilisateur trouvé";
    }
} else {
    echo "Aucun id trouvé";
}

if(isset($_POST['supprimer'])) {
error_log("bon");
  $messagesupp = $_POST['supprimer'];
  $supprimerMessage = $bdd->prepare('DELETE FROM messages WHERE id = ?');
  $supprimerMessage->execute(array($messagesupp));
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
?>

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
      <img src="image\logo.png" class="icon"></img>
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
         <img src="image\<?=$_SESSION['id']['profil']?>" class="icon1">
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
            <button class="signalement" data-button="Acte sexuel">Acte sexuel</button>
            <br>
            <button class="signalement" data-button="Racisme">Racisme</button>
            <br>
            <button class="signalement" data-button="Antisémite">Antisémite</button>
            <br>
            <button class="signalement" data-button="Violence textuelle">Violence textuelle</button>
            <br>
        </div>
    </div>

    <div class="overlay" onclick="closeModal()"></div>


<div class="Messagerie">
<div class="Liste">
    <?php 
        $recupConversations = $bdd->prepare('SELECT id_des FROM conv WHERE id_au = ?');
        $recupConversations->execute(array( $_SESSION['id']));
        while($conversation = $recupConversations->fetch()){
            $recupUser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
            $recupUser->execute(array($conversation['id_des']));
            $user = $recupUser->fetch();
            if($user['id'] != $_SESSION['id']){
    ?>
        <button class="bouton" onclick="redirectMessagerie(<?= $user['id']; ?>)">
            <div class="case">
                <img src="Image\<?=$user['profil']?>" class="icon1">
                <p class="ut"><?= $user['pseudo']; ?></p>
            </div>
        </button>
    <?php
            }
        }
    ?>
</div>

    <div class="ChatConteneur">
    <?php if($getid != $_SESSION['id']){?>
        <div class="header">
            <img src="image\<?=$photo?>" class="icon2">
            <a href="profil.php?id=<?= $getid ?>"><?= $cible ?></a>
        </div>
        <div class="message-container" id="message">  
            <?php 
            $recupMessage = $bdd->prepare('SELECT * FROM messages WHERE (id_au = ? AND id_des = ?) OR (id_au = ? AND id_des = ?) ORDER BY date ASC');
            $recupMessage->execute(array($_SESSION['id'], $getid, $getid, $_SESSION['id']));            
                while($message = $recupMessage->fetch()){
                    $classeMessage = ($message['id_au'] == $_SESSION['id']) ? 'receveur' : 'envoyeur';
            ?>
                <div class="messages <?= $classeMessage ?>">
                    <div class="message-content">
                        <?php if ($classeMessage == 'envoyeur') { ?>
                            <div class="options-container gauche">
                                <span class="options-icon" onclick="showOptions(this)">...</span>
                                <div class="option" style="display: none;">
                                    <p><?= date_format(date_create($message['date']), 'd/m/Y H:i');?></p>
                                    <button class="report-btn" data-message-id="<?= $message['message']; ?>">Signaler</button>
                                </div>
                            </div>
                            <img src="Image\<?=$photo?>" class="icon3">
                            <p><?= $message['message']; ?></p>
                        <?php } else { ?>
                            <p><?= $message['message']; ?></p>
                            <div class="options-container droite">
                                <span class="options-icon" onclick="showOptions(this)">...</span>
                                <div class="option" style="display: none;">
                                    <p><?= date_format(date_create($message['date']), 'd/m/Y H:i');?></p>
                                    <button class="delete-btn" data-message-id="<?= $message['id']; ?>">Supprimer</button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div> 
            <?php
                }
            ?>
        </div>

        <div class="messages">
            <input type="text" id="messageInput" autocomplete="off" placeholder="Tapez votre message..."> 
            <button id="envoyerMessage">Envoyer</button>
            <?php
            }
            else{?>
                <div><p>Choisis une conversation</p></div>
            <?php
            }?>
        </div>
    </div> 
</div>
<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
    });

    searchBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
    });

    function redirectMessagerie(userId) {
        if (userId) {
            window.location.href = "messagerie.php?id=" + userId;
        }
    }

    function showOptions(element) {
    let options = element.nextElementSibling;
    if (options && (options.style.display === "none" || options.style.display === "")) {
        options.style.display = "block";
    } else if (options) {
        options.style.display = "none";
    }
    }

    function Signalement() {
    var signalementDiv = document.getElementById('signalement');
    signalementDiv.style.display = 'block';
    signalementDiv.style.position = 'fixed';
    signalementDiv.style.top = '50%';
    signalementDiv.style.left = '50%';
    signalementDiv.style.transform = 'translate(-50%, -50%)';
    }


window.onclick = function(event) {
    let options = document.querySelectorAll('.option');
    let clickOptions = false;
    if (event.target.classList.contains('options-icon')) {
        clickOptions = true;
    }

    if (!clickOptions) {
        options.forEach(option => {
            option.style.display = "none";
        });
    }
};

$(document).ready(function() {

var messageReport;
var profil;

    function sendMessage(message, recipientId) {
        console.log(messageReport);
    if(messageReport){
        messageReport = undefined;
    }
    $.ajax({
        type: "POST",
        url: "messagerie.php?id=<?= $getid; ?>",
        data: { 
            message: message
        },
        success: function(response) {
            console.log(messageReport);
            console.log("Message envoyé avec succès");
            $('#messageInput').val('');
            refreshMessages();
        },
        error: function(xhr, status, error) {
            console.error("Erreur lors de l'envoi du message :", error);
        }
    });
}

function reportMessage(category) {
    if (messageReport) {
        $.ajax({
            type: "POST",
            url: "messagerie.php?id=<?= $getid; ?>",
            data: {
                signaler: true,
                message: messageReport,
                motif: category,
                type: 'message',
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

function deleteMessage(messageId) {
        $.ajax({
            type: "POST",
            url: "messagerie.php?id=<?= $getid; ?>",
            data: { 
                supprimer: messageId 
            },
            success: function(response) {
                console.log("Message supprimé avec succès");
                $('#message').html($(response).find('#message').html());
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors de la suppression du message :", error);
            }
        });
    }

    function refreshMessages() {
        $.ajax({
            type: "GET",
            url: "messagerie.php?id=<?= $getid; ?>",
            success: function(response) {
                $('#message').html($(response).find('#message').html());
            },
            error: function(xhr, status, error) {
                console.error("Erreur lors de l'actualisation des messages :", error);
            }
        });
    }

    $(document).on('click', '.delete-btn', function() {
        var messageId = $(this).data('message-id');
        deleteMessage(messageId);
    });

    
    $(document).on('click', '.report-btn', function() {
        messageReport = $(this).data('message-id');
        Signalement();
    });

    var type;
    $(document).on('click', '.signalement', function() {
        var messageId = $(this).data('button');
        reportMessage(type);
    });

    $('#messageInput').keypress(function(event) {
        if (event.which == 13) { 
            event.preventDefault(); 
            var message = $('#messageInput').val();
            var recipientId = <?php echo $getid; ?>;
            sendMessage(message, recipientId);
        }
    });

    $('#envoyerMessage').click(function() {
        var message = $('#messageInput').val();
        var recipientId = <?php echo $getid; ?>;
        sendMessage(message, recipientId);
    });

});

        function Signalement() {
            var signalementDiv = document.getElementById('signalement');
            signalementDiv.style.display = 'block';
            var overlay = document.querySelector('.overlay');
            overlay.style.display = 'block';
        }

        // Fonction pour fermer le modal
        function closeModal() {
            var signalementDiv = document.getElementById('signalement');
            signalementDiv.style.display = 'none';
            var overlay = document.querySelector('.overlay');
            overlay.style.display = 'none';
        }

        $('.signalement').click(function() {
            closeModal();
    });

</script>
</body>
</html>