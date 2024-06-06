<?php 

session_start();
$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');
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


</style>

<!DOCTYPE html>
<html>

<style>

@font-face {
  font-family: "Ghibo";
  src:
    url("Ghibo Talk.otf") format("opentype");
}

body{
    margin: 0;
    padding: 0;
}

.part1 {
    margin: 0;
    padding: 0;
    background: radial-gradient(circle, rgba(34,193,195,1) 20%, rgba(253,187,45,1) 90%);
    font-size:20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Assurez-vous que le body prend toute la hauteur de la fenêtre */
}

.nav {
    position: fixed; /* Position fixe pour rester en haut à gauche */
    top: 20px;
    left: 20px;
    background-color: #fff;
    padding: 20px;
    transition: 0.5s;
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 8px 15px rgba(0,0,0,.2);
    display: flex;
    align-items: center;
    border: 2px solid #666;
}

.menu {
    display: flex;
    margin: 0;
    padding: 0;
    width: 0;
    height: 50px;
    overflow: hidden;
    transition: 0.5s;
    font-family: Ghibo;
}

.nav input:checked ~ .menu {
    width: 500px;
    height: 25px;
}

.menu ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.menu li {
    list-style: none;
    margin: 0 15px;
}

.menu li a {
    text-decoration: none;
    color: #666;
    text-transform: uppercase;
    font-weight: 600;
    transition: 0.5s;
}

.menu li a:hover {
    color: black;
}

.nav input {
    width: 40px;
    max-height: 40px;
    cursor: pointer;
    opacity: 0;
}

.nav span {
    position: absolute;
    left: 30px;
    width: 30px;
    height: 4px;
    border-radius: 50px;
    background-color: #666;
    pointer-events: none;
    transition: 0.5s;
}

.nav input:checked ~ span {
    background-color: #f974a1;
}

.nav span:nth-child(2) {
    transform: translateY(8px);
}

.nav input:checked ~ span:nth-child(2) {
    transform: translateY(0) rotate(-45deg);
}

.nav span:nth-child(3) {
    transform: translateY(-8px);
}

.nav input:checked ~ span:nth-child(3) {
    transform: translateY(0) rotate(45deg);
}

.Texte {
    display: flex;
    position:fixed;
    z-index:0 ;
    flex-direction: column;
    justify-content: center;
    align-items: center; 
    text-align: center; 
    font-size: 60px;
    font-family: Ghibo;
    text-transform: uppercase;
    max-width: 800px;
    margin: auto;
}

.Texte h1, .Texte h2 {
    margin: 5px 0;
    padding: 0;
}

#formco {
    position: fixed;
    top: 30px;
    right: 20px;
    padding: 15px 40px;
    background-color: #fff;
    border: 2px solid #666;
    border-radius: 50px;
    font-family: Ghibo;
    font-size: 25px;
    font-weight: 600;
    cursor: pointer;
    
}

//////////////////////////////////////////////////////////////////////////////////////////////////


.Formulaire{
  	min-height: 100vh;
  	align-items: center;
    flex-direction: column;
  	justify-content: center;
    position:fixed;
    z-index: -5;
    display: flex;
    margin:auto;
    
}

* {
  box-sizing: border-box;
}

.Interieur{
  position: relative;
  width: 400px;
}

form {
  width: 100%;
  position: relative;
  z-index: 9;
  border-radius:50px;
  border:solid black 2px;
  padding: 20px 61px 66px;
  background: #fff;
  box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
  
}
h2 {
    font-family: Ghibo;
}
h3 {
  text-transform: uppercase;
  font-size: 50px;
  font-family: Ghibo;
  color: #333;
  letter-spacing: 3px;
  text-align: center;
}

.Case {
  position: relative;
  margin-bottom: 21px;
  border-radius: 50px;
  border:solid black 1px;
}

.Case span {
  position: absolute;
  left: 5%;
  top: 50%;
  transform: translateY(-50%);
  font-size: 15px;
  color: #333;
}

.lnr {
  font-family: linearicons-free;
  font-style: normal;
  font-weight: 400;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
  
}


.Custom {
  border: none;
  display: block;
  width: 100%;
  height: 40px;
  background: 0 0;
  padding: 3px 42px 0;
  color: #666;
  font-family: muli-semibold;
  font-size: 16px;
}

.button {
  border: none;
  width: 100%;
  height: 49px;
  margin-top: 50px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
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

.Fox {
  position: absolute;
  top:-80px;
  left: -100px;
  width: 50%;
  z-index: 99;
  transform:rotate(-20deg);
}

.close {
  position: absolute;
  top: 30px;
  right:30px;
  z-index: 99;
}

.inscrip{

    font-family:muli-semibold;
    font-size:15px;
    vertical-align:middle;
}


.modal1 {
    display: none; 
    position: fixed;
    z-index: 1;
    left:0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modal1-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px; 
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    animation: modal1open 0.4s; 
}

@keyframes modal1open {
    from { opacity: 0 }
    to { opacity: 1 }
}

.close-button1 {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-button1:hover,.close-button1:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


/*                                                   */

.modal {
    display: none; 
    position: fixed;
    z-index: 1;
    left:0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px; 
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    animation: modalopen 0.4s; 
}

@keyframes modalopen {
    from { opacity: 0 }
    to { opacity: 1 }
}

.close-button {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-button:hover,.close-button:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniMate</title>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="styles.css">
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
            <div id="form" style="display:none;">
        	<div class="Formulaire">
		    <div class="Interieur">
                <img class="Fox" src="image/logo.png">
                <span id='close' class="close">X</span>
                </span>
                <form method="POST" action="" align="center">
            	    <h3>Connexion</h3>
                
                    <div class="Case">
	    			    <span class="lnr lnr-user">
	    			    </span>
                        <input class="Custom" type="text" name="pseudo"  autocomplete="off"  placeholder="Pseudo" required>
                    </div>
        
                    <div class="Case">
	    			    <span class="lnr lnr-user">
	    			    </span>
                	    <input class="Custom" type="password" name="password" autocomplete="off" placeholder="Mot de passe" required>
                    </div>
                
                    <a href="signup.php" class="inscrip">Crée un compte</a>
                    <input type="submit" class="button" value="Connexion" name="envoi">
                </form>
            </div>
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
    const contactLink = document.getElementById('contact-link1');
    const closeButton = document.getElementsByClassName('close-button1')[0];

    contactLink.onclick = function() {
        modal1.style.display = "block";
    }

    closeButton.onclick = function() {
        modal1.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
    }
});

document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById('modal');
    const contactLink = document.getElementById('contact-link');
    const closeButton = document.getElementsByClassName('close-button')[0];

    contactLink.onclick = function() {
        modal.style.display = "block";
    }

    closeButton.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
        </script>
</body>
</html>
