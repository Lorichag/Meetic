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

$nom_dossier = "uploads";

// Créer un dossier s'il n'existe pas déjà
if (!is_dir($nom_dossier)) {
    mkdir($nom_dossier);
}

if(isset($_POST['valider'])){
    $espece = $_POST['espece'];
    $race = $_POST['race'];

   
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        // Générer un nouveau nom de fichier unique
        $target = 'uploads/';
        $newFileName = uniqid('image_', true) . '.'.$imageFileType;
        $target_file = $target.$newFileName;	
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
    		$insertImage = $bdd->prepare('INSERT INTO image(pseudo,nom_image) VALUES(?, ?)');
    		$insertImage->execute(array($_SESSION['pseudo'],$newFileName));
    	}
    	else {
            echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
        }
    }

	
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
        <form method="POST" action="profil.php" enctype="multipart/form-data">
            <p>Pseudo:<input disabled="disabled" name="pseudo" value="<?= $info['pseudo']; ?>"></p>
            <p>Age: <input disabled="disabled" name="age" value="<?= $info['age']; ?>"></p>
            <p>Sexe: <input disabled="disabled" name="sexe" value="<?= $info['sexe']; ?>"></p>
            <p>Espece: <input type="text" name="espece" value="<?= $info['espece']; ?>"></p>
            <p>Race: <input type="text" name="race" value="<?= $info['race']; ?>"></p>
            <input type="file" name="image" id="fileToUpload">
            <input type="submit" name="valider" value="Enregistrer les modifications">
        </form>
    <?php 
    } 
    ?>
    
    </body>
</html>
