<?php 
session_start(); 



include("connectPDO.php"); 
include("global.php"); 





$stmt=$bdd->prepare('INSERT INTO users (email, password, username) VALUES (:email, :password, :username)');




$empty=0;
if(isset($_POST["email"])) {

	if(empty($_POST["email"])) {

		echo "Vous n'avez pas rempli le champ email."; 
		$empty++;
	}
	else {
		$mailV=$bdd->prepare('SELECT * FROM users WHERE email = ?'); 
		$mailV->bindValue(1, $_POST['email']); 
		if($mailV->execute()) {

			echo "select effectué"; 
		}

		if($vMail=$mailV->fetch()) {


			echo "le email existe déjà, veuillez créer un compte, veuillez utiliser un autre email<br/>"; 
			$id=$vMail['id']; 
			$empty++;
			$mail=true;
		} 

		else {

			echo "l'email n'existe pas.<br/>"; 
			$mail=false; 
		}


		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		    echo 'Cet email est correct.';
		} else {
		    echo 'Cet email a un format non adapté. <br/>';
		    $empty++;
		}
	}


	if(empty($_POST['user'])) {


		echo "Vous n'avez pas rempli le champ user.<br/>"; 
		$empty++;

	}

	if(strlen($_POST['user'] < 4)) {


		echo "Votre username est trop court <br/>"; 


	} 

	if(empty($_POST['password'])) {


		echo "Vous n'avez pas rempli le champ mot de passe.<br/>"; 
		$empty++;

	}

	if (is_numeric($_POST['password'])) {

		echo "votre mot de passe ne contient que des chiffres. Veuillez inclure des charactères.<br/>"; 
		$empty++; 
	}


	if(strlen($_POST['password'] < 6)) {


		echo "Votre password est trop court <br/>"; 


	} 



	if ($_POST['password'] != $_POST['password2']) {


		echo "Les mots de passes ne sont pas pareil<br/>"; 
		$empty++; 
	}


	if(empty($_POST['password2'])) {


		echo "Vous n'avez pas rempli le champ mot de passe2.<br/>"; 
		$empty++;

	}

	if($empty==0) {

		$stmt->bindValue(":email", htmlspecialchars($_POST['email']), PDO::PARAM_STR); 
		$stmt->bindValue(":password", htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT)), PDO::PARAM_STR); 
		$stmt->bindValue(":username", htmlspecialchars($_POST['user']), PDO::PARAM_STR); 

		if($stmt->execute()) {

			$_SESSION['auth']=true;  
			$_SESSION['ip']= $_SERVER['REMOTE_ADDR'];
			$_SESSION['user']=$vMail; 

			header("Location: index.php" ); 

			echo "votre compte a bien été créé<br/>"; 
		}

		else {

			echo "erreur lors de la création de votre compte<br/>"; 
		} 

	}


}





include("headType.php"); 
include("navBarType.php"); 



?>
<div class="container">
	<form method="post" action="" >
		<label for="email">Adresse E-mail :</label><br/>
		<input type="mail" name="email" placeholder="exemple@mymail.com"><br/>
		<label for="user">Username :</label><br/>
		<input type="text" name="user" placeholder="username..."><br/>
		<label for="password">Mot de passe :</label><br/>
		<input type="password" name="password" placeholder="au moins 8 characters, mélange de chiffres de de lettres"><br/>
		<label for="password2">Répéter mot de passe :</label><br/>
		<input type="password" name="password2" placeholder="au moins 8 characters, mélange de chiffres de de lettres"><br/>
		<input type="submit" value="créer votre compte"><br/>



	</form>
</div>













<?php 

include("footerType.php"); 



?>