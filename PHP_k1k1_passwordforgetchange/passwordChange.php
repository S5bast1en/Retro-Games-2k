<?php 
session_start(); 
include("globalPhp.php"); 
include("connectPDO.php"); 


$canChange=false; 
$errors= "";

if(!isset($_POST['pass1'])) {

	$id=$_GET['id'];
	$token=$_GET['getTok']; 


$canChange=checkToken($id, $token); 

}

else {
	$id=$_POST['id'];
	$token=$_POST['token'];
	$pass=$_POST['pass1']; 
	$pass2=$_POST['pass2']; 

	if(empty($pass) || empty($pass2) ){

		$errors .= "Veuillez remplir les 2 champs passwords";



	}

	if($pass != $pass2) {

		$errors .= "Les deux champs password ne sont pas pareils"; 
	}

	if(is_numeric($pass)) {

		$errors .= "Veuillez mettre au moins 1 charactère non-numerique dans votre password"; 
	}

	if(strlen($pass) < 8) {

		$errors .= "Votre password doit au moins avoir 8 chiffres et/ou charactère"; 
	}


	if(checkToken($id, $token) && empty($errors)) {

		$stmt=$bdd->prepare('UPDATE users SET reset_token = NULL, reset_expire = NULL, password = ? WHERE id = ?');
		

		$stmt->bindValue(1, htmlspecialchars(password_hash($_POST['pass1'], PASSWORD_DEFAULT)), PDO::PARAM_STR); 
		$stmt->bindValue(2, $id); 

		$stmt->execute(); 

	


	}










}









include("headType.php");
include("navBarType.php");  
// if(!empty($errors)){

// 	echo $errors; 
// }

if($canChange) {
?>
<div>
	<form method="post" action="passwordChange.php">
		<label for="pass1">Votre nouveau password :</label><br/>
		<input type="password" name="pass1"/><br/>
		<label for="pass2">Répéter mot de passe :</label><br/>
		<input type="password" name="pass2"/><br/>



		<input name="token" value="<?php echo $_GET['getTok'];?>" hidden/>
		<input name="id" value="<?php echo $_GET['id'];?>" hidden/>
		<input type="submit"><br/>



	</form>
</div>

 <?php 
} else { echo "Token invalide !" ;}

include "footerType.php"; 

?> 




