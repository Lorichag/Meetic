<?php 

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace membres;charset=utf8;', 'root', '');
if(isset($_POST["envoi"])){
            $pseudo=htmlspecialchars($_POST['pseudo']);
            $mdp=sha1($_POST['password']);
            $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
            $recupUser->execute(array($pseudo,$mdp));
            if($recupUser->rowCount()>0){
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $recupUser->fetch()['id'];
                header('Location: connecting.php?id='.$_SESSION['id']);
            }
            else{
            ?>
                <script> window.alert('Identifiant ou MDP incorrect');</script>
            <?php
            }
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniMate</title>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="part1">


    <div class="nav">
        <input type="checkbox">
        <span></span>
        <span></span>
        <div class="menu">
            <ul>
                <li><a href="login.php">Accueil</a></li>
                <li><a href="#" id="contact-link">A propos de nous</a></li>
                <li><a href="#" id="contact-link1">Nos contacts</a></li>
            </ul>
        </div>
    </div>
    <div id="modal1" class="modal1">
        <div class="modal1-content">
            <span class="close-button1">&times;</span>
            <h2>Site créé par</h2>
            <p>Loric Hagard, Mathis Lance-richardot, Alban Souppaya et Axel Guesdon</p>
        </div>
    </div>
 	<div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Qui somme nous ?</h2>
            <p>Des étudiants de Cy Tech ayant pour projet de créer un site de rencontres !</p>
            <p> Mais innovons un peu en créent quelque chose de different, un site de rencontres pour animaux !</p>
            <p>Vous voilà les bienvenues sur Animate l'endroit où vous pourrez trouver l'amour de votre animal <3 </p>
        </div>
    </div>


    <div class="Texte">
        <h1>
            Animate
        </h1>
        <h2>
            Your Life
        </h2>
    </div>

    <div class="Connect">
    <button id="formco">Connexion</button>
    <div id="form" class="modal" style="display: none;">
        <div class="Formulaire">
            <div class="Interieur">
                <img class="Fox" src="image/logo.png">
                <span id="close" class="close">&times;</span>
                <form method="POST" action="" align="center">
                    <h3>Connexion</h3>
                    <div class="Case">
                        <span class="lnr lnr-user"></span>
                        <input class="Custom" type="text" name="pseudo" autocomplete="off" placeholder="Pseudo" required>
                    </div>
                    <div class="Case">
                        <span class="lnr lnr-user"></span>
                        <input class="Custom" type="password" name="password" autocomplete="off" placeholder="Mot de passe" required>
                    </div>
                    <a href="signup.php" class="inscrip">Créer un compte</a>
                    <input type="submit" class="button" value="Connexion" name="envoi">
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

        <script>
            var opco = document.getElementById("form");
            var closeform = document.getElementById("close");
            var formco = document.getElementById("formco");
            
            formco.onclick= function(){
                opco.style.display="block";
            }

            closeform.onclick= function(){
                opco.style.display="none";
            }

            window.onclick = function(event){
                if(event.target == opco){
                    opco.style.display="none";
                }
            }
            
            document.addEventListener('DOMContentLoaded', (event) => {
    const modal1 = document.getElementById('modal1');
    const modal = document.getElementById('modal');
    const contactLink1 = document.getElementById('contact-link1');
    const contactLink = document.getElementById('contact-link');
    const closeButton1 = document.getElementsByClassName('close-button1')[0];
    const closeButton = document.getElementsByClassName('close-button')[0];
    const formco = document.getElementById('formco');
    const form = document.getElementById('form');

    contactLink1.onclick = function() {
        modal1.style.display = "block";
        modal.style.display = "none"; // Assurez-vous que l'autre modal est caché
    }

    closeButton1.onclick = function() {
        modal1.style.display = "none";
    }

    contactLink.onclick = function() {
        modal.style.display = "block";
        modal1.style.display = "none"; // Assurez-vous que l'autre modal est caché
    }

    closeButton.onclick = function(event) {
        if (!event.target.closest('#form')) {
            modal.style.display = "none";
        }
    }

    formco.onclick = function() {
        form.style.display = "block";
    }

    window.onclick = function(event) {
        if (event.target == modal1 && !event.target.closest('#form')) {
            modal1.style.display = "none";
        } else if (event.target == modal && !event.target.closest('#form')) {
            modal.style.display = "none";
        } else if (event.target == form) {
            form.style.display = "none";
        }
    }
});
        </script>
</body>
</html>
