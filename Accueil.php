<style>

body{
    margin: 0;
    padding: 0;
}

.part1 {
    margin: 0;
    padding: 0;
    background: radial-gradient(circle, rgba(34,193,195,1) 20%, rgba(253,187,45,1) 90%);
    font-family: Ghibo;
    font-size:20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Assurez-vous que le body prend toute la hauteur de la fenêtre */
}

.nav {
    position: fixed; /* Position fixe pour rester en haut à gauche */
    top: 20px;
    left: 20px;
    background-color: #fff;
    padding: 20px;
    transition: 0.5s;
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 8px 15px rgba(0,0,0,.2);
    display: flex;
    align-items: center;
    border: 2px solid #666;
}

.menu {
    display: flex;
    margin: 0;
    padding: 0;
    width: 0;
    height: 40;
    overflow: hidden;
    transition: 0.5s;
}

.nav input:checked ~ .menu {
    width: 750px;
    height: 25;
}

.menu ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.menu li {
    list-style: none;
    margin: 0 15px;
}

.menu li a {
    text-decoration: none;
    color: #666;
    text-transform: uppercase;
    font-weight: 600;
    transition: 0.5s;
}

.menu li a:hover {
    color: black;
}

.nav input {
    width: 40px;
    max-height: 40px;
    cursor: pointer;
    opacity: 0;
}

.nav span {
    position: absolute;
    left: 30px;
    width: 30px;
    height: 4px;
    border-radius: 50px;
    background-color: #666;
    pointer-events: none;
    transition: 0.5s;
}

.nav input:checked ~ span {
    background-color: #f974a1;
}

.nav span:nth-child(2) {
    transform: translateY(8px);
}

.nav input:checked ~ span:nth-child(2) {
    transform: translateY(0) rotate(-45deg);
}

.nav span:nth-child(3) {
    transform: translateY(-8px);
}

.nav input:checked ~ span:nth-child(3) {
    transform: translateY(0) rotate(45deg);
}

.Texte {
    display: flex;
    flex-direction: column;
    justify-content: center; /* Centre verticalement */
    align-items: center; /* Centre horizontalement */
    text-align: center; /* Centre le texte à l'intérieur du div */
    font-size: 60px;
    font-family: Ghibo;
    text-transform: uppercase;
    max-width: 800px; /* Optionnel : pour limiter la largeur du texte */
    margin: auto; /* Centrer le div dans l'espace disponible */
}

.Texte h1, .Texte h2 {
    margin: 5px 0; /* Ajustez les marges pour rapprocher les textes */
    padding: 0; /* Assurez-vous qu'il n'y a pas de padding supplémentaire */
}

#formco {
    position: fixed;
    top: 30px;
    right: 10px;
    padding: 15px 40px;
    background-color: #fff;
    border: 2px solid #666;
    border-radius: 50px;
    font-family: Ghibo;
    font-size: 25px;
    font-weight: 600;
    cursor: pointer;
}

@font-face {
  font-family: "Ghibo";
  src:
    url("Ghibo Talk.otf") format("opentype");
}

</style>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AniMate</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="part1">
    <div class="nav">
        <input type="checkbox">
        <span></span>
        <span></span>
        <div class="menu">
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">A propos de nous</a></li>
                <li><a href="#">Abonnements</a></li>
                <li><a href="#">Forum</a></li>
                <li><a href="#">Nos contacts</a></li>
            </ul>
        </div>
    </div>

    <div class="Texte">
        <button id="formco">Connexion</button>
        <h2>
            Look-seek
        </h2>
        <h1>
            Find
        </h1>
    </div>
</div>

</body>
</html>
