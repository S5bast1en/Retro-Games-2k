<?php 
session_start();


	


require_once "connectPDO.php";


include "globalPhp.php"; 


// if($_SESSION['auth']==true && $_SESSION['ip']==$_SERVER['REMOTE_ADDR']) {

// 	$error = "bravo, vous êtes bien connecté !! <br/>"; 
// }

// else {

// 	$error .= "Vous n'êtes pas connecté. <br/>"; 
// }


if(isset($_POST['email'])) {
	if(empty($_POST['email'])) {

		$error = "Veuillez remplir le champ email <br/>";
	}

	else {
		$stmt=$bdd->prepare('SELECT * FROM users WHERE email = ?'); 
		$stmt->bindValue(1, $_POST['email']); 
		if($stmt->execute()) {

			$error = "select effectué <br/>"; 
		}

		if($vMail=$stmt->fetch()) {


			$error .= "le email existe <br/>"; 
			$id=$vMail['id']; 

			$mail=true;
		} 

		else {

			$error .= "l'email n'existe pas. <br/>"; 
			$mail=false; 
		}




	}

	if(empty($_POST['password'])) {

		$error .= "Vous n'avez pas rempli le champ password <br/>"; 
	}

	elseif($mail==true) {

		if(password_verify($_POST['password'], $vMail['password'] )){


			$error .= "Connexion effectué <br/>";
				 // $_SESSION['auth']=true;  
				 // $_SESSION['ip']= $_SERVER['REMOTE_ADDR'];
				 // $_SESSION['user']=$vMail;

				 // $keychain = generateCookieKeychain($vMail); 

				 // setcookie('autoauth', $keychain, time() + 15*24*3600, null, null, false, true);  

				login($vMail); 

				header('Location: index.php');




			

				//exit();
		}

		else {

			$error .= "mauvais mot de passe <br/>"; 
		} 

	}


}

include("headType.php"); 
include("navBarType.php"); 



?>


<div class="container">
	<form method="post" action="" >
		<label for="email">E-mail : </label><br/>
		<input type="mail" name="email" placeholder="Votre username..."><br/>
		<label for="password">Password :</label><br/>
		<input type="password" name="password" placeholder="Votre mot de passe..."><br/>
		<input type="submit" value="LOGIN"><br/>

	</form>
</div>



<?php 

include("footerType.php"); 

?>

