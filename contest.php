<?php
$page = [
    'title' => 'Jeu Concours',
    'premium' => true,
    'admin' => false,
];
require_once "view/app.php";


	$stmt=$db->prepare("SELECT contest_time FROM users WHERE id=? ");
	$stmt->bindValue(1,3);
	$stmt->execute();
	// temps passe au dernier jeu
	$contestTime=strtotime($stmt->fetch()["contest_time"]);
	// var_dump($contestTime);exit();
	// prio soustraction et ensuite comparaison
	if (time() - $contestTime < $contestConfig["delay"]) {
		$canPlay=false;
	} else {
		$canPlay=true;
	}
// Bloc de participation
	 	if (isset($_GET["tryout"]) && $canPlay === true) {
			 if ($_GET["tryout"]==rand( $contestConfig["min"],$contestConfig["max"] ) ) {
				 	//echo "vous avez gagné";
					$stmt=$db->prepare("SELECT * FROM games LEFT JOIN users_game ON games.id=users_game.game_id WHERE users_game.user_id!=? OR users_game.user_id IS NULL ORDER BY RAND() LIMIT 1" );
					$stmt->bindValue(1,3);
					$stmt->execute();
					$wonGame=$stmt->fetch();
					//var_dump( $wonGame);
					$query="INSERT INTO users_game (game_id, user_id) VALUES (?,?)";
					$stmt=$db->prepare($query);
					$stmt->bindValue(1,$wonGame["id"]);
				  $stmt->bindValue(2,3);
					$stmt->execute();

					echo "le jeu ".$wonGame["name"]."(".$wonGame["id"].")";

					$won=true;

				} else {
					// echo "Désolé Vous avez perdu";
					$won=false;
				}
				// a placer ici et non pas dans le if
				$stmt=$db->prepare("UPDATE users SET contest_time=NOW() WHERE users.id=? ");
				$stmt->bindValue(1,3);
				$stmt->execute();
		}

require_once "header.php"; ?>

	<h2> Jouez et gagnez de nombreux lots </h2>
	</br></br>
	<h4>cliquez sur un des boutons et gagnez un jeu : </h3>
	</br></br></br></br>
	<!-- Retirer dans le cadre extension exercice jeu concours  7.11.2017
	<?php for ($nbrBox=1;$nbrBox<=10;$nbrBox++) { ?>
	<p>Boite n°<?php echo$nbrBox; ?></p>
	<button>cliquez ici!</button>
	<?php } ?>
	-->


<!--Bloc template -->
		<div class="container">

		 <!-- Example row of columns -->
			 <div class="row">
				 <?php if(!isset ($won)) { ?>

					 	<div class="col-sm-12">
							 <?php if ($canPlay !==true) { ?>
								 Vous avez déjà joué, retentez dans une semaine !
							 <?php } ?>
						</div>

						<?php for ($nbrBox=1;$nbrBox<=12;$nbrBox++) { ?>
							<div class="col-sm-4 col-md-3">
								 <p>
									 <a href="?tryout=<?php echo rand($contestConfig["min"],$contestConfig["max"]); ?>" class="<?php echo ($canPlay !== true) ? "disable" : ""; ?> btn btn-default btn-lg" role="button">
										 Bouton n° <?php echo $nbrBox; ?>
									 </a>
								 </p>
						 	</div>
						<?php } ?>


					<?php }elseif($won===true) {?>
						<div class="col-sm-12">
							 Bravo, vous avez gagné <?php echo $wonGame["name"]; ?> -
							 <a href="gameDetails.php?indexGamesListTab=<?php echo $wonGame["id"] ?>"> Voir la fiche du jeu </a>
					<?php }else {?>
							 Désolé, vous avez perdu retentez votre chance la semaine prochaine
						</div>
					<?php } ?>

			 </div>
		 </div>



</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>

<?php require_once"footer.php"; ?>
