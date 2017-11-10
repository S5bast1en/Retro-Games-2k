<?php
session_start(); 
include("globalPhp.php"); 



include("headType.php");


 include("navBarType.php"); 

			
// if(isset($_SESSION['auth'])) {
// 	if($_SESSION['auth']==true && $_SERVER['REMOTE_ADDR']==$_SESSION['ip']) {

// 		echo "bravo, vous êtes bien connecté !!"; 
// 	}

// 	else {

// 		echo "Vous n'êtes pas connecté."; 
// 	}
// }




?>




		<h1><?php 






		$titre = "TheBestSite";
		echo "Hello, bienvenue sur " .$titre; ?></h1>

		<?php if($isConnected) {

			echo "Vous êtes connecté";
		}

		else {

			echo "Veuillez vous connecter :"; 
			?> <a href="connexion.php">Connection</a> <?php
		}
		?>

		<?php if ($isPremium){
			?><a href="premium.php">Accès premium</a><?php

		}

		?>

		<?php include("footerType.php"); ?>