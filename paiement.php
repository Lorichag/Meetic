

<?php
if (isset($_GET["offre"])) {
    echo "Offre: " . htmlspecialchars($_GET["offre"]) . "<br>";
} else {
    echo "Le paramètre 'offre' n'est pas défini dans l'URL.<br>";
}
$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');
session_start();
if(isset($_POST["fric"])){
$abo = 1;
$id = $_SESSION["id"];
$fin_abo = 2004;
$updateUser = $bdd->prepare('UPDATE users SET abo = ?, fin_abo = ? WHERE id = ?');
$updateUser->execute(array($abo, $fin_abo, $id));


}


?>

<!DOCTYPE html>
<html>
<body>


<div class="paye">
<h1>Paiement</h1>
<p>Numéro de carte <span id="p1">Expiration</span><span id="p2">CVC</span></p>
<form method="POST" action="">
<input class="carte1" type="text" name="num-carte"  autocomplete="off"  placeholder="1234 1234 1234 1234" required>
<input class="carte2" type="text" name="exp-carte"  autocomplete="off"  placeholder="MM/YY" required>
<input class="carte3" type="text" name="CVC"  autocomplete="off"  placeholder="CVC" required>
<input type="submit" value="Valider" name="fric">
</form>
</div>


<style type="text/css">
#p1 {
margin-left:50px;
}
#p2 {
margin-left:40px;
margin-right:70px;

}

.paye {
text-align:center;
}
.carte2 {
width:100px;
}
.carte3 {
width:100px;
}

</style>







</body>
</html>
