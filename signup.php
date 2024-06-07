<?php 


session_start();
$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'lancericha', 'neingee8kialohB');
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
            $abo=0;
            $fin_abo='vide';
            $profil='crabe.jpg';
            $mail=htmlspecialchars($_POST['mail']);
            $bio = 'vide';
            $insertUser = $bdd->prepare('INSERT INTO users(pseudo, mdp, age, sexe, espece, race, abo, fin_abo, profil, mail, bio) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
            $insertUser->execute(array($pseudo,$mdp,$age,$sexe,$espece,$race, $abo,$fin_abo,$profil,$mail,$bio));
                
                header('Location: login.php');
    }
}

?>


<!DOCTYPE html>
<html>

<style type="text/css">

body{
    margin: 0;
    padding: 0;
}

@font-face {
  font-family: "Ghibo";
  src:
    url("Ghibo Talk.otf") format("opentype");
}


.nav {
    position: fixed; /* Position fixe pour rester en haut à gauche */
    top: 20px;
    left: 20px;
    z-index:99;
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
    margin-top:50px;
    margin-bottom:50px;
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
  padding: 20px 61px 66px;
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

    <div class="nav">
        <input type="checkbox">
        <span></span>
        <span></span>
        <div class="menu">
            <ul>
                <li><a href="login.php">Accueil</a></li>
                <li><a href="">A propos de nous</a></li>
                <li><a href="contact.php">Nos contacts</a></li>
            </ul>
        </div>
    </div>


<div class="Formulaire">
<div class="Interieur">
	<img class="Fox" src="image/logo.png">
    <form method="POST" action="signup.php" align="center">
    	<h3>S'inscrire</h3>
	    	<div class="Case">
	    		<span class="lnr lnr-user">
	    		</span>
	    		<input class="Custom" type="text" name="pseudo" placeholder="Pseudo"  autocomplete="off" required>
	    		

	    	</div>
	    	<div class="Case">
	    	<span class="lnr lnr-user">
	    		</span>
	    	<input class="Custom" type="text" name="mail" placeholder="Adresse-mail"  autocomplete="off" required>
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
