<?php
session_start();
if (!isset($_SESSION['mdp'])) {
    header('Location: login.php');
}

$bdd = new PDO('mysql:host=localhost;dbname=espace membres;charset=utf8;', 'root', '');

if (isset($_POST['enregistrer'])) {
    $id = $_POST['id'];
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $age = $_POST['age'];
    $espece = $_POST['espece'];
    $race = $_POST['race'];
    $abo = $_POST['abo'];
    $fin_abo = $_POST['fin_abo'];

    $updateUser = $bdd->prepare('UPDATE users SET pseudo = ?, mdp = ?, age = ?, espece = ?, race = ?, abo = ?, fin_abo = ? WHERE id = ?');
    $updateUser->execute(array($pseudo, $mdp, $age, $espece, $race, $abo, $fin_abo, $id));

    header('Location: admin.php');
}


if (isset($_POST['supprimer'])) {
    $id = $_POST['id'];
    $User = $bdd->prepare('DELETE FROM users WHERE id = ?');
    $suppUser->execute([$id]);

    header('Location: admin.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
    <a href="demandes.php">Demande</a>
    <table>
        <tr>
            <th>Id</th>
            <th>Pseudo</th>
            <th>Mdp</th>
            <th>Age</th>
            <th>Espece</th>
            <th>Race</th>
            <th>Abo</th>
            <th>Fin_abo</th>
            <th>Actions</th>
        </tr>
        <?php
        $recupUser = $bdd->query('SELECT * FROM users');
        while ($user = $recupUser->fetch()) {
            if (isset($_GET['modifier']) && $_GET['modifier'] == $user['id']) {
                ?>
                <tr>
                    <form method="POST" action="admin.php">
                        <td><?= $user['id'] ?><input type="hidden" name="id" value="<?= $user['id'] ?>"></td>
                        <td><input type="text" name="pseudo" value="<?= $user['pseudo'] ?>"></td>
                        <td><input type="text" name="mdp" value="<?= $user['mdp'] ?>"></td>
                        <td><input type="number" name="age" value="<?= $user['age'] ?>"></td>
                        <td><input type="text" name="espece" value="<?= $user['espece'] ?>"></td>
                        <td><input type="text" name="race" value="<?= $user['race'] ?>"></td>
                        <td><input type="text" name="abo" value="<?= $user['abo'] ?>"></td>
                        <td><input type="date" name="fin_abo" value="<?= $user['fin_abo'] ?>"></td>
                        <td>
                            <input type="submit" name="enregistrer" value="Enregistrer">
                        </td>
                    </form>
                </tr>
                <?php
            } else {
                ?>
                <tr>
                    <td><?=$user['id'] ?></td>
                    <td><?= $user['pseudo'] ?></td>
                    <td><?= $user['mdp'] ?></td>
                    <td><?=$user['age'] ?></td>
                    <td><?= $user['espece'] ?></td>
                    <td><?= $user['race'] ?></td>
                    <td><?= $user['abo'] ?></td>
                    <td><?= $user['fin_abo'] ?></td>
                    <td>
                        <form method="POST" action="admin.php">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button type="button" onclick="window.location.href='?modifier=<?= $user['id'] ?>'">Modifier</button>
                            <button type="button" onclick="window.location.href='messagerie.php?id=<?= $user['id'] ?>'">Messagerie</button>
                            <input type="submit" name="supprimer" value="Supprimer">
                    </form>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</body>
</html>

