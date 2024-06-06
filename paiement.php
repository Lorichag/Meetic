

<?php
if (isset($_GET["offre"])) {
    $offre = htmlspecialchars($_GET["offre"]);
    echo "Offre: " . $offre . "<br>";
} else {
    echo "Le paramètre 'offre' n'est pas défini dans l'URL.<br>";
    $offre = null;
}

$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');
session_start();

if (isset($_POST["fric"])) {
    $abo = 1;
    $id = $_SESSION["id"];
    switch ($offre) {
        case 'foufou':
            $fin_abo = 2678400; //offre pour 1 mois en seconde
            break;
        case 'sauvage':
            $fin_abo = 8035200; //offre pour 3 mois en seconde
            break;
        case 'roi':
            $fin_abo = 32140800; //offre pour 1 ans en seconde
            break;
        default:
            $fin_abo = 0;
            break;
    }
    if ($fin_abo > 0) {
        $updateUser = $bdd->prepare('UPDATE users SET abo = ?, fin_abo = ? WHERE id = ?');
        $updateUser->execute(array($abo, $fin_abo, $id));
        echo "Mise à jour réussie.<br>";
        ?>
        <a href="connecting.php">Retour</a>
        <?php
        
    } else {
        echo "Offre invalide.<br>";
    }
}
?>


<!DOCTYPE html>
<html>
<body>


<div class="paye">
<h1>Paiement</h1>
<p>Numéro de carte <span id="p1">Expiration</span><span id="p2">CVC</span></p>
<form method="POST" action="">
<input class="carte1" type="text" name="num-carte" autocomplete="off" placeholder="1234 1234 1234 1234" required maxlength="19">
<input class="carte2" type="text" name="exp-carte"  autocomplete="off"  placeholder="MM/YY" required maxlength="5">
<input class="carte3" type="text" name="CVC"  autocomplete="off"  placeholder="CVC" required maxlength="3">
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

<script>

</script>


</body>
</html>
