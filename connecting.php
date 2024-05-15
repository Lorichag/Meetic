<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="connecting.css">
<head>
    <title>Connecting</title>
</head>
 
<body>
 
<div id="bande">
 
 
<p id="connarddelogodemerdemaldimensionné"><img src="image/logo.png"></p> 
<div><img id="p1" src="image/home.png" ></div>
<div><img id="p2" src="image/loupe.png"></div>
<a href="message.php"><img id="p3" src="image/message.png"></a>
<a href="profil.php"><img id="p4" src="image/profil.png"></a>
 
<div><img id="p5" src="image/parametre.png"></div>
</div>
 
<div>
    <form method="post">
        <input type="submit" name="d" value="Déconnexion">
    </form>
</div>
 
 
 
 
<a id="abo" href="page-abo.php">Abonnement</a>
<p><img id="p6" src="image/exit.png"></p>
 
 
 
</body>
</html>
 
<style type="text/css">


#bande {
    position: absolute;
    float: left;
    width: 5%;
    height: 100vh;
    background-color: gray;
    margin-right: 1%;
}
 
#bande div {
    margin-top: 10px;
}
 
#bande img {
    width: 50%;
    height:5%;
    padding-left:25%;
    padding-top:30%;
    display: block;
}
 
#p6 {
    width: 50px;
    height: 50px;
    position: fixed;
    bottom: 0;
    right: 0;
    padding: 10px;
}
#p5 {
 margin-top:400%;
}

#abo {
background: skyblue;
border-radius:10px;
padding: 10px;
text-decoration: none;
color: black ;
top:20px;    
right:50px;
position:fixed;



}

</style>
