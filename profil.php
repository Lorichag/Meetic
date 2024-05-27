<?php 

session_start();
if(!$_SESSION['pseudo']){
    header('Location: login.php');
}

$bdd= new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');

$recupinfo = $bdd->prepare('SELECT * FROM users WHERE pseudo= ?');
$recupinfo->execute(array($_SESSION['pseudo']));
$info = $recupinfo->fetch();

if(isset($_POST['valider'])){
    $espece = $_POST['espece'];
    $race = $_POST['race'];

    $updateUser = $bdd->prepare('UPDATE users SET espece = ? , race = ? WHERE pseudo = ?');
    $updateUser->execute(array($espece,$race,$_SESSION['pseudo']));
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profil</title>
    </head>
    <body>
    <?php 
    if(!isset($_GET["modifier"])){
    ?>
        <p>Pseudo: <?= $info['pseudo']; ?></p>
        <p>Age: <?= $info['age']; ?> ans</p>
        <p>Sexe: <?= $info['sexe']; ?></p>
        <p>Espece: <?= $info['espece']; ?></p>
        <p>Race: <?= $info['race']; ?></p>
        <a href="?modifier=1">Modifier</a>
    <?php 
    } 
    else { 
    ?>
        <form method="POST" action="profil.php">
            <p>Pseudo:<input disabled="disabled" name="pseudo" value="<?= $info['pseudo']; ?>"></p>
            <p>Age: <input disabled="disabled" name="age" value="<?= $info['age']; ?>"></p>
            <p>Sexe: <input disabled="disabled" name="sexe" value="<?= $info['sexe']; ?>"></p>
            <p>Espece: <input type="text" name="espece" value="<?= $info['espece']; ?>"></p>
            <p>Race: <input type="text" name="race" value="<?= $info['race']; ?>"></p>
            <input type="submit" name="valider" value="Enregistrer les modifications">
        </form>
    <?php 
    } 
    ?>
    
    </body>
</html>
