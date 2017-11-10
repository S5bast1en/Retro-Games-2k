<?php
session_start(); 
include("globalPhp.php"); 



$sendMail=false; 

if(isset($_POST['mailForget'])) {

	//echo "3";

	if(empty($_POST['mailForget'])){

		$errors = "<li>Vous n'avez pas rempli le champs \"mail\".</li>"; 
	} 



	if(empty($errors)) {
		include("connectPDO.php");
		$stmt=$bdd->prepare('SELECT * FROM users WHERE email = ?'); 
		$stmt->bindValue(1, $_POST['mailForget']); 
		if($stmt->execute()) {
				//echo "1";
			if($userInfo=$stmt->fetch()){

				//echo "2"; 

				$token=generateResetToken(); 

				$stmt=$bdd->prepare('UPDATE users SET reset_token = :token, reset_expire = :expire WHERE id = :id');
				$stmt->bindValue(":token", $token); 

				$expire=date("Y/m/d/h/i", time()+ 24*3600); 

				$stmt->bindValue(":expire", $expire);
				$stmt->bindValue(":id", $userInfo['id'] );

				if($stmt->execute()) {
					$sendMail=true; 
					//echo "http://localhost:8888/projetPHP/passwordChange.php?id=".$userInfo['id']."&getTok=".$token."";
				}

			}

			else {

				$errors ="<li>L'adresse email n'existe pas.</li>";
			} 

		} 

		else {

			$errors = "<li>l'execution de la base de donné a échoué.</li>"; 
		}

		



	}
}













include("headType.php");
include("navBarType.php"); 
if(!empty($errors)){
echo $errors; 
}
if($sendMail) {

	?> <a href="<?php echo "http://localhost:8888/projetPHP/passwordChange.php?id=".$userInfo['id']."&getTok=".$token."";?>">Lien pour changer mdp</a>
	<?php 
}
?>


<div>
	<form method="post" action="passForget.php" >
		<label for="mailForget">Ecriver votre email : </label><br/>
		<input type="mail" name="mailForget" placeholder="votremail@nomdedomaine.fr"><br/>
		<input type="submit"><br/>
	</form>
</div>











<?php include("footerType.php"); ?>