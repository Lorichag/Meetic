if(isset($_POST['d'])){
    $_SESSION = array();
    session_destroy();
    header('Location: login.php');
    exit();

}



$recupUser = $bdd->prepare('SELECT * FROM users WHERE id NOT IN 
    (SELECT id_sig FROM bloquer WHERE id_au = ?) 
    AND id NOT IN (SELECT id_au FROM bloquer WHERE id_sig = ?) 
    AND id != ? ORDER BY id DESC');
$recupUser->execute(array($_SESSION['id'], $_SESSION['id'], $_SESSION['id']));


if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = htmlspecialchars($_GET['q']);
    
    $recupUser = $bdd->prepare('SELECT id, pseudo, profil FROM users 
                                WHERE id NOT IN (SELECT id_sig FROM bloquer WHERE id_au = ?) 
                                AND id NOT IN (SELECT id_au FROM bloquer WHERE id_sig = ?) 
                                AND pseudo LIKE ? 
                                ORDER BY id DESC');
    $recupUser->execute(array($_SESSION['id'], $_SESSION['id'], "%$q%"));
} else {
    $recupUser = $bdd->prepare('SELECT id, pseudo, profil FROM users 
                                WHERE id NOT IN (SELECT id_sig FROM bloquer WHERE id_au = ?) 
                                AND id NOT IN (SELECT id_au FROM bloquer WHERE id_sig = ?) 
                                ORDER BY id DESC');
    $recupUser->execute(array($_SESSION['id'], $_SESSION['id']));
}

<i class='bx bx-search' ></i>
            <form method="GET" action="connecting.php?id=<?= $_SESSION['id']; ?>">
                <input type="search" name="q" placeholder="Recherche..." />
            </form>


            <script>
    let sidebar = document.querySelector(".sidebar");
    let decaler = document.querySelector((".decaler"))
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");
    closeBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("open");
        decaler.classList.toggle("open");
    });
    searchBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("open");
        decaler.classList.toggle("open");
    });

    function redirectMessagerie(userId) {
        window.location.href = "profil.php?id=" + userId;
    }
    document.getElementById('log_out').addEventListener('click', function() {
        document.getElementById('logout-form').submit();
    });
  </script>