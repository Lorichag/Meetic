<?php 

/*
session_start();
$bdd= new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=espace membres;charset=utf8;','root','');
if(isset($_POST["envoi"])){
    $age = date_diff(date_create($_POST['age']), date_create('now'))->y;
    $pseudo=htmlspecialchars($_POST['pseudo']);
    $verife = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
    $verife->execute(array($pseudo));
    if($verife->rowCount() == 0 && $_POST["password"]==$_POST["cpassword"] && $age>=18){
            $mdp=sha1($_POST['password']);
            $sexe=htmlspecialchars($_POST['sexe']);
            $espece=htmlspecialchars($_POST['espece']);
            $race=htmlspecialchars($_POST['race']);
            $insertUser = $bdd->prepare('INSERT INTO users(pseudo, mdp, age, sexe, espece, race) VALUES(?, ?, ?, ?, ?, ?)');
            $insertUser->execute(array($pseudo,$mdp,$age,$sexe,$espece,$race));

            $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
            $recupUser->execute(array($pseudo,$mdp));

            if($recupUser->rowCount()>0){
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $recupUser->fetch()['id'];
                header('Location: login.php');
            }
    }
}
*/
?>


</style>

<!DOCTYPE html>
<html>

<style type="text/css">

@font-face {
  font-family: "Ghibo";
  src:
    url("Ghibo Talk.otf") format("opentype");
}

body{
    margin: 0;
    padding: 0;
}

 html {
  background: radial-gradient(circle, rgba(34,193,195,1) 20%, rgba(253,187,45,1) 90%);
  font-family: Ghibo;
  font-size:20px;
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
  border-radius:50px;
  border:solid black 2px;
  box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
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
  border:solid grey 1px;
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
  transform:rotate(-30deg);
}

</style>


<head>
    <title>SIGING</title>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
</head>

<body>
<div class="Formulaire">
<div class="Interieur">
	<img class="Fox" src="logo.png">
    <form method="POST" action="" align="center">
    	<h3>S'inscrire</h3>
	    	<div class="Case">
	    		<span class="lnr lnr-user">
	    		</span>
	    		<input class="Custom" type="text" name="pseudo" placeholder="Pseudo"  autocomplete="off" required>
	    	</div>
	    		
		<div class="Case">
	    		<span class="lnr lnr-calendar-full"></span>
       			<input class="Custom" type="date" name="age" autocomplete="off" required>
       	</div>
      
      	<div class="Radio">
        			<input type="radio" name="sexe"  autocomplete="off" value="Male" required>Male
        			<input type="radio" name="sexe"  autocomplete="off" value="Femelle" required>Femelle
        	</div>	
        		
        		
        	<div class="Case">
	    		<span class="lnr lnr-user">
	    		</span>
        			<input class="Custom" type="text" name="espece" placeholder="Espèce"  autocomplete="off">
        	</div>
        	
        	<div class="Case">
	    		<span class="lnr lnr-user">
	    		</span>
        			<input class="Custom" type="text" name="race" placeholder="Race" autocomplete="off">
        	</div>
        	
        	<div class="Case">
	    		<span class="lnr lnr-user">
	    		</span>
        		<input class="Custom" type="password" name="password" placeholder="Mot de Passe" autocomplete="off" required>
        	</div>
        	<div class="Case">
	    		<span class="lnr lnr-user">
	    		</span>
        		<input class="Custom" type="password" name="cpassword" placeholder="Confirmer le MDP" autocomplete="off" required>
        	</div>
        <input class="button" type="submit" name="envoi" value="Confirmer">
    </form>
        </div>
    </div>
</body>
</html>
