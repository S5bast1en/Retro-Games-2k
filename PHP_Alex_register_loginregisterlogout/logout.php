<?php

	require_once 'src/app.php';
	session_destroy(); //détruit la session de l'user, mais la mécanique de session est toujours dispo (session open tjr actif)
	header("location: list.php");


 ?>
