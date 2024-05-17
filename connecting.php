<?php 
session_start();

if(!$_SESSION['mdp']){
    header('Location: login.php');
}

if(isset($_POST['d'])){
    $_SESSION =array();
    session_destroy();
    header('Location: login.php');
}

if(isset($_POST['m'])){
    header('Location: messagerie.php?id='.$_SESSION["id"]);
}

if(isset($_POST['p'])){
    header('Location: profil.php?pseudo='.$_SESSION['pseudo']);
}

echo $_SESSION["pseudo"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Connecting</title>
</head>

<body>
<div>
    <form method="post">
        <input type="submit" name="d" value="Déconnexion">
        <input type="submit" name="m" value="Messagerie">
        <input type="submit" name="p" value="Profil">
    </form>
</div>
</body>
</html>
