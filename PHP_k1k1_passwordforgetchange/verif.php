<?php include_once ("globalPhp.php"); ?>
<?php 
$accesP=true; 

if(!$accesP) {
	echo "Vous n'êtes pas premium"; 
	?> 
	<br/>
	<a href="index.php">retour à l'accueil</a>
	<?php
	exit(); 

}



?>