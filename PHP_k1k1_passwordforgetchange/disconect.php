<?php 

session_start(); 

if(session_destroy()){
	setcookie('autoauth', " ", time() -1 , null, null, false, true); 

	header('Location: index.php'); 
	$error .= "vous avez bien été déconnecté.<br/>"; 
	?>
	<a href="index.php">Revenir à l'accueil</a>
	<?php 

} 

else {

	echo "deconnexion non-effectué "; 
}


//exit;


?> 