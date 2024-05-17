<?php 
session_start();
$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'lancericha', 'neingee8kialohB');
if(!$_SESSION['pseudo']){
    header('Location: login.php');

}

if(isset($_GET['id']) and !empty($_GET['id'])){
    $getid = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM users WHERE id= ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount()>0){
        if(isset($_POST["envoyer"])){
            $message=htmlspecialchars($_POST['message']);
            $inseremessage = $bdd->prepare('INSERT INTO messages(message, id_des, id_au)VALUES(?,?,?)');
            $inseremessage->execute(array($message, $getid, $_SESSION['id']));

        }
    }
    else{
        echo " aucun utilisateur";
    }
}
else{
    echo "Aucun id trouvé";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Messagerie</title>
</head>

<body>
<select name="app" multiple onchange="redirectMessagerie(this)">
    <?php 
        $recupUser = $bdd->query('SELECT * FROM users');
        while($user = $recupUser->fetch()){
            if($user['id'] != $_SESSION['id']){
    ?>
    <option value="<?= $user['id']; ?>">
        <p><?= $user['pseudo']; ?></p>
    </option>
    <?php
            }
        }
    ?>
</select>

    <div>
        <section id="message">
            <?php 
                $recupMessage = $bdd->prepare('SELECT * FROM messages WHERE id_au = ? and id_des=? OR id_au = ? and id_des=?');
                $recupMessage->execute(array($_SESSION['id'],$getid, $getid, $_SESSION['id']));
                while($message = $recupMessage->fetch()){
                    ?>
                    <p><?= $message['message']; ?></p>
                    <?php
                }
            ?>

        </section>
        <form method="POST" action="">
            <?php
            if($_SESSION["id"] != $getid){
            ?>
            <textarea name="message"></textarea>
            <input type="submit" name="envoyer">
            <?php
            }
            ?>
        </form>
    <div>

<script>
    function redirectMessagerie(select) {
        var selectedUserId = select.value;
        if(selectedUserId) {
            window.location.href = "messagerie.php?id=" + selectedUserId;
        }
    }
</script>

</body>
</html>