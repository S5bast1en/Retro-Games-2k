<?php 


session_start(); 

require_once('verif.php'); ?>

<?php include_once ("globalPhp.php"); ?>


<?php 

include("headType.php");
include("navBarType.php"); 

	
include("connectPDO.php"); 


//var_dump($_SESSION['user']['id']); 

if(!$sessionConnected) {

	echo "veuillez vous connecter ou vous enregistrer pour accèder au concours"; 
}


else {

	$stmt=$bdd->prepare('SELECT * FROM users WHERE id = ?'); 
	$stmt->bindValue(1,$_SESSION['user']['id']); 
	$stmt->execute(); 
	$dateContest=$stmt->fetch(); 


	     
	if( time()-strtotime($dateContest['contest_time']) < (7*24*60*60)) {

		$canPlay = false; 
	}else{

		$canPlay = true; 
	}

	if(isset($_GET['isCliqued']) && $canPlay) {


		$luckyNumber=rand(1,10);

		if($luckyNumber==5) {

			
			$req=$bdd->prepare('SELECT * FROM games LEFT JOIN users_game ON games.id = users_game.game_id WHERE users_game.user_id IS NULL OR users_game.user_id != ? ORDER BY RAND() LIMIT 1');
			$req->bindValue(1,$_SESSION['user']['id']); 
			$req->execute(); 
			$winGame=$req->fetch(); 

			$insertID=$bdd->prepare('INSERT INTO users_game (game_id, user_id) VALUES (:game_id, :user_id)');
			$insertID->bindValue(":game_id", htmlspecialchars($winGame['id'])); 
			$insertID->bindValue(":user_id", $_SESSION['user']['id']);
			if($insertID->execute()){


				echo "Le jeu a bien été rajouté à votre bibliothèque."; 
			}

			echo "Bien joué, vous avez gagné le jeu ".$winGame['name']. " !";
			logFile(date("d/m/Y H:i")."Game won = ".$winGame['name']."\n");
			// $fileLog=fopen("gamesWon".date("d-m-Y").".log", 'a+');
			// fputs($fileLog, date("d/m/Y H:i")."Game won = ".$winGame['name']."\n"); 
			// fclose($fileLog); 
			$won=true;
		}

		else {

			echo "YOU LOSE FUCKING NOOB ! KURWA !!";
			$won=false; 
		}

		$stmt = $bdd->prepare("UPDATE users SET contest_time = NOW() WHERE id = ?"); 
		$stmt->bindValue(1, $_SESSION['user']['id']); 
		if($stmt->execute()) {

			echo "update de l'heure effectué."; 

		}
	}


		?>




		<?php 
	if (!isset( $won )) {

		if($canPlay !== true) {

			echo "Vous avez déjà joué cette semaine.";
		}

		for($i = 0 ; $i<10 ; $i++) {
			?>
		<br/>
			<button><a class="<?php echo ($canPlay !== true) ? 'disable' : ' '; ?>" href="premium.php?isCliqued=1">Boite <?php echo $i+1 ;?> Cliquez !</a></button>
			<br/>

		<?php

		}
	}

	elseif($won=== true) { ?>
	<div>
		<p>Bien joué, vous avez gagné le jeu <?php echo $winGame['name'];?> !</p>

	</div>

	<?php
	} else { ?>
	<div>
		<p>Vous avez perdu, vous pourrez rejouer la semaine prochaine.</p>

	</div>

	<?php 
	}
}
	?>



<?php 
include("footerType.php");
?>