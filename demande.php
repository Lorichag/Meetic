<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location: login.php');
}

$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
    <table>
        <tr>
            <th>Id message</th>
            <th>Id utilisateur</th>
            <th>Date</th>
            <th>Type</th>
            <th>Motif</th>
            <th>Description</th>
            <th>Utilisateur signalé</th>
        </tr>
        <?php
        $recupDemande = $bdd->query('SELECT * FROM demandes');
        while ($demande = $recupDemande->fetch()) {
                ?>
                <tr>
                    <td><?=$demande['id'] ?></td>
                    <td><?= $demande['utilisateur'] ?></td>
                    <td><?= $demande['date'] ?></td>
                    <td><?=$demande['type'] ?></td>
                    <td><?= $demande['motif'] ?></td>
                    <td><?= $demande['description'] ?></td>
                    <td><?= $demande['utilisateur_signaler'] ?></td>
                    <td>
                        <form method="POST" action="demande.php">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <?php
                            if($demande['type']== "message"){
                            ?>
                            	<button type="button" onclick="window.location.href='messagerie.php?id=<?= $demande['utilisateur'] ?>'">Visiter</button>
                            <?php	
                            } else{
                            ?>
                            <button type="button" onclick="window.location.href='profil.php?id=<?= $demande['utilisateur_signaler'] ?>'">Visiter</button>
                            <?php
                            }
                            ?>
                    </form>
                    </td>
                </tr>
                <?php
        }
        ?>
    </table>
</body>
</html>
