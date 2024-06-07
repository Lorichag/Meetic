<?php 

session_start();
if(!isset($_SESSION['pseudo'])){
    header('Location: login.php');
    exit();
}

$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');

$recupinfo = $bdd->prepare('SELECT * FROM users WHERE pseudo= ?');
$recupinfo->execute(array($_SESSION['pseudo']));
$info = $recupinfo->fetch();
$pseudo=$_SESSION['pseudo'];
$nom_dossier = "uploads";

if (!is_dir($nom_dossier)) {
    mkdir($nom_dossier);
}

if(isset($_POST['valider'])){
    $espece = $_POST['espece'];
    $race = $_POST['race'];
   
    if (isset($_FILES['profil']) && $_FILES['profil']['error'] == 0) {
        $profilFileType = strtolower(pathinfo($_FILES["profil"]["name"], PATHINFO_EXTENSION));
        // Générer un nouveau nom de fichier unique
        $target1 = 'image/';
        $newProfilName = $_SESSION['pseudo'].'_profil.'.$profilFileType;
        $target_profil = $target1.$newProfilName;
        move_uploaded_file($_FILES["profil"]["tmp_name"], $target_profil);    
    }
    $verife = $bdd->prepare('SELECT * FROM image WHERE pseudo = ?');
    $verife->execute(array($pseudo));
    
    if($verife->rowCount() < 5){
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        // Générer un nouveau nom de fichier unique
        $target = 'uploads/';
        $newFileName = uniqid('image_', true) . '.'.$imageFileType;
        $target_file = $target.$newFileName;    
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                $insertImage = $bdd->prepare('INSERT INTO image(pseudo, nom_image) VALUES(?, ?)');
                $insertImage->execute(array($_SESSION['pseudo'], $newFileName));
            } else {
            echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
        }
        }
    }
    
    $updateUser = $bdd->prepare('UPDATE users SET espece = ? , race = ? , profil = ? WHERE pseudo = ?');
    $updateUser->execute(array($espece, $race, $newProfilName, $_SESSION['pseudo']));

    // Reload the page
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['unblock_user'])) {
    $userIdToUnblock = $_POST['user_id'];
    $deleteBlock = $bdd->prepare('DELETE FROM bloquer WHERE id_au = ? AND id_sig = ?');
    $deleteBlock->execute(array($info['id'], $userIdToUnblock));

    // Reload the page
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch blocked users
$blockedUsers = $bdd->prepare('SELECT users.id, users.pseudo, users.age, users.sexe, users.espece, users.race 
                               FROM bloquer 
                               JOIN users ON bloquer.id_sig = users.id 
                               WHERE bloquer.id_au = ?');
$blockedUsers->execute(array($info['id']));

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Parametre</title>
    </head>
    <body>
    <?php 
    if(!isset($_GET["modifier"])){
    ?>
        <img src="image/<?= $info['profil']; ?>" alt="Profil Image" width="150">
        <p>Pseudo: <?= $info['pseudo']; ?></p>
        <p>Age: <?= $info['age']; ?> ans</p>
        <p>Sexe: <?= $info['sexe']; ?></p>
        <p>Espece: <?= $info['espece']; ?></p>
        <p>Race: <?= $info['race']; ?></p>
        <a href="?modifier=1">Modifier</a>
        <h3>Mes photos:</h3>
        <?php
            $recupImages = $bdd->prepare('SELECT nom_image FROM image WHERE pseudo = ?');
            $recupImages->execute(array($pseudo));
            while ($image = $recupImages->fetch()) {
                echo '<img src="uploads/'.$image['nom_image'].'" alt="User Image" width="150">';
            }
        ?>
        <h3>Personnes bloquées:</h3>
        <ul>
        <?php
            while ($blocked = $blockedUsers->fetch()) {
                echo '<li>Pseudo: ' . $blocked['pseudo'] . ', Age: ' . $blocked['age'] . ', Sexe: ' . $blocked['sexe'] . ', Espece: ' . $blocked['espece'] . ', Race: ' . $blocked['race'];
                echo '<form method="POST" action="">
                        <input type="hidden" name="user_id" value="' . $blocked['id'] . '">
                        <input type="submit" name="unblock_user" value="Débloquer">
                      </form>
                      </li>';
            }
        ?>
        </ul>
    <?php 
    } else { 
    ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <p>Pseudo:<input disabled="disabled" name="pseudo" value="<?= $info['pseudo']; ?>"></p>
            <p>Age: <input disabled="disabled" name="age" value="<?= $info['age']; ?>"></p>
            <p>Sexe: <input disabled="disabled" name="sexe" value="<?= $info['sexe']; ?>"></p>
            <p>Espece: <input type="text" name="espece" value="<?= $info['espece']; ?>"></p>
            <p>Race: <input type="text" name="race" value="<?= $info['race']; ?>"></p>
            <p>Photo de profil: <input type="file" name="profil"></p>
            <p>Ajouter une photo: <input type="file" name="image" id="fileToUpload"></p>
            <input type="submit" name="valider" value="Enregistrer les modifications">
        </form>
    <?php 
    } 
    ?>
    </body>
</html>
