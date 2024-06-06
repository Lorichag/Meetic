<!DOCTYPE html>
<html lang="fr">
<head>


<h1>Site fait par</h1>
<div class="contact">
<p> Alban Soupaya</p>
<p> Loric Hagard</p>
<p> Mathis Lance-richardo</p>
<p> Axel Guesdon</p>

</div>

<div class="nav">
        <input type="checkbox">
        <span></span>
        <span></span>
        <div class="menu">
            <ul>
                <li><a href="login.php">Accueil</a></li>
                <li><a href="#">A propos de nous</a></li> 
                <li><a href="contact.php">Nos contacts</a></li>
            </ul>
        </div>
    </div>
    
<style>
@font-face {
  font-family: "Ghibo";
  src:
    url("Ghibo Talk.otf") format("opentype");
}
.contact {
display:flex;
justify-content:space-evenly;
font-size:25px;
}
h1{
font-size:110px;
font-family: Ghibo;
margin-top:300px;
text-align:center;
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
    width: 500px;
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
    font-size:20px;
    font-family: Ghibo;
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

</style>







</head>
</html>
