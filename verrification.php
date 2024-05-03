<!DOCTYPE html>
<html>
<body>

<?php

$name= $_POST['Nom'];
$mdp= $_POST['Ps'];

$utilisateurs = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

$la=0;
foreach($utilisateurs as $x => $x_value) {
	if($x==$name){
		if($x_value == $mdp){
			$la=1;
			session_start();
			$_SESSION['name']=$x;
			$_SESSION['mdp']=$x_value;
		}
	} 
}
if($la==1){
	header('location: accueil.php');
}
else{
	header('location: connexion.php');
}

?>

</body>
</html>
