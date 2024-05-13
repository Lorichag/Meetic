<?php 
/*
session_start();
$bdd= new PDO('mysql:host=localhost;dbname=espace membres;charset=utf8;','root','');
if(isset($_POST["envoi"])){
            $pseudo=htmlspecialchars($_POST['pseudo']);
            $mdp=sha1($_POST['password']);
            $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
            $recupUser->execute(array($pseudo,$mdp));
            if($recupUser->rowCount()>0){
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $recupUser->fetch()['id'];
                header('Location: connecting.php');
            }
            else{
                echo 'y a une erreur dans le mot de passe ou l"utilisateur';
            }
}
*/
?>


</style>

<!DOCTYPE html>
<html>

<style type="text/css">

body{
  font-family: muli-regular;
  font-size: 14px;
  margin: 0;
  color: #999;
}

 html {
 	background-image: url('https://img.freepik.com/vecteurs-premium/fond-couleur-degrade-pastel-abstrait-style-multicolore-lisse-flou-blanc_120819-616.jpg');
 	height:100vh;
 	background-repeat:no-repeat;
  	background-position: center;
  	background-size: cover;
}

.Formulaire{
  	min-height: 100vh;
  	display: flex;
  	align-items: center;
  	justify-content: center;
}

* {
  box-sizing: border-box;
}

.Interieur{
  position: relative;
  width: 435px;
}

form {
  width: 100%;
  position: relative;
  z-index: 9;
  padding: 77px 61px 66px;
  background: #fff;
  box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
}

h3 {
  text-transform: uppercase;
  font-size: 25px;
  font-family: muli-semibold;
  color: #333;
  letter-spacing: 3px;
  text-align: center;
  margin-bottom: 33px;
}

.Case {
  position: relative;
  margin-bottom: 21px;
}

.Case span {
  position: absolute;
  left: 0;
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
  border-bottom: 1px solid #e6e6e6;
  display: block;
  width: 100%;
  height: 38px;
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
  top:-90px;
  left: -120px;
  z-index: 99;
  transform:rotate(-10deg);
}
</style>

<!DOCTYPE html>
<html>

<head>
    <title>LOGIN</title>
</head>

<body>
    <h1 align="center">Nom du site</h1>
        <button align="right" id="formco">Connexion</button>
    
        <div id="form" style="display:none;">
        	<div class="Formulaire">
		<div class="Interieur">
            <form method="POST" action="" align="center">
            	<h3>Se connecter</h3>
            	
                <span id='close'>X</span>
                </span>
                
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
                
                <a href="signup.php">Crée un compte</a>
                <input type="submit" class="button" value="Connexion" name="envoi">
            </form>
        </div>
        </div>
        </div>

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
        </script>
</body>
</html>
