<?php
$page = [
    'title' => 'Se déconnecter',
    'premium' => false,
    'admin' => false,
];
require_once "view/app.php";;
	setcookie("autoauth","",time()-1, null,null,false,true );
	session_destroy(); //détruit la session de l'user, mais la mécanique de session est toujours dispo (session open tjr active)
	header("location: index_Gameslist.php");
/*CREA 2017 11 8  */
 ?>
