<?php
session_start();

if(!$_SESSION['mdp']){
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
    </head>
    <body>
        <table>
            <tr>
                <th>
                    Id
                </th>
                <th>
                    Pseudo
                </th>
                <th>
                    Mdp
                </th>
                <th>
                    Age
                </th>
                <th>
                    Espece
                </th>
                <th>
                    Race
                </th>
                <th>
                    Abo
                </th>
                <th>
                    Fin_abo
                </th>
                <th>
                    Tribunal
                </th>
            </tr>
        <?php 
        $bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'lancericha', 'neingee8kialohB');
 
        $recupUser = $bdd->query('SELECT * FROM users');
        while($user = $recupUser->fetch()){
        ?>
        <tr>
            <td>
                <?= $user['id']; ?>
            </td>
            <td>
                <?= $user['pseudo']; ?>
            </td>
            <td>
                <?= $user['mdp']; ?>
            </td>
            <td>
                <?= $user['age']; ?>
            </td>
            <td>
                <?= $user['espece']; ?>
            </td>
            <td>
                <?= $user['race']; ?>
            </td>
            <td>
                <?= $user['abo']; ?>
            </td>
            <td>
                <?= $user['fin_abo']; ?>
            </td>
            <td>
            <form method="POST" action="admin.php">
            <input type="button" name="modifier" value="Modifier">
            <input type="button" name="messagerie" value="Messagerie">
            <input type="button" name="supprimer" value="supprimer">
        </form>
            </td>
        </tr>
        <?php
        }
        ?>
        </table>

    </body>
</html>