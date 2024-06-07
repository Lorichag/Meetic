<?php
session_start();
if (!isset($_SESSION['mdp'])) {
    header('Location: login.php');
}

$bdd = new PDO('mysql:host=prc-students-mysql.cy-tech.fr;port=3306;dbname=rencontres;charset=utf8', 'guesdonaxe', 'pho2eacoo0Vei2e');

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
  <html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="NavBar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <img src="logo.png" class="icon"></img>
        <div class="logo_name">AniMate</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        
          <i class='bx bx-search' ></i>
          <form method="GET" action="connecting.php?id="<?= $_SESSION['id']; ?>>
          <input type="search" name="q" placeholder="Recherche..." />
          </form>
      </li>
      <li>
        <a href="connecting.php?id=<?= $_SESSION['id']; ?>">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Accueil</span>
        </a>
      </li>
      <li>
       <a href="profil.php?id=<?= $_SESSION['id']; ?>">
         <i class='bx bx-user' ></i>
         <span class="links_name">Profile</span>
       </a>
     </li>
     <li>
       <a href="messagerie.php?id=<?= $_SESSION['id']; ?>">
         <i class='bx bx-chat' ></i>
         <span class="links_name">Messages</span>
       </a>
     </li>
     <li>
     <li>
        <a href="page-abo.php?id=<?= $_SESSION['id']; ?>">
          <i class='bx bxl-paypal'></i>
          <span class="links_name">Abonnement</span>
        </a>
      </li>
    <li>
       <a href="Paramètres.php?id=<?= $_SESSION['id']; ?>">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Paramètres</span>
       </a>
     </li>
     <li class="profile">
         <div class="profile-details">
           <img src="profile.jpg">
           <div class="name_job">
             <div class="name"><?= $_SESSION['pseudo']; ?></div>
           </div>
         </div>
         <form method="POST" action="" id="logout-form" style="display: inline;">
                <input type="hidden" name="d" value="logout">
                <i class='bx bx-log-out' id="log_out" style="cursor: pointer;"></i>
          </form>
     </li>
    </ul>
  </div>

  <div class="decaler">

    <div class="Tableau">
    <table class="rwd-table">
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

    </div>



</div>

</body>
</html>

<style>

body{
    background: radial-gradient(circle, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 90%);;
}

@font-face {
  font-family: "Ghibo";
  src:
    url("Ghibo Talk.otf") format("opentype");
}   

.Tableau{
    margin-left:78px;
    display:flex;
    margin-top:auto;
    justify-content:center;
}

.rwd-table {
  background: #34495E;
  color: #fff;
  border-radius: 10px;
  padding:10px;
  border-spacing:20px;
  text-align:center;
}

tr:first-child{
    color: #dd5;
}

.rwd-table tr{
    padding:50px;
    margin-top:100px;
}

input{
    
}



