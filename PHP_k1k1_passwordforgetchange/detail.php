<?php 
session_start(); 
	if(!isset( $_GET['numGame'])) {

		header('Location: liste.php');
		exit(); 
	}

    include("connectPDO.php"); 


	include_once ("globalPhp.php"); 
	$idG= (int)$_GET['numGame']; 



	$reponse=$bdd->query('SELECT * FROM games LEFT JOIN games_type ON games.type_id = games_type.id LEFT JOIN editor ON games.editor_id = editor.id LEFT JOIN developer ON games.developer_id = developer.id WHERE games.id = '.$idG.'');
	
	$game=$reponse->fetch(); 
	// export des commentaires dans la BDD 
	$newComment=$bdd->prepare('INSERT INTO comment (user_id, game_id, textComment, dateComment) VALUES (:user_id, :game_id, :textComment, NOW())');
	// récupération des commentaires 
	$getComment=$bdd->prepare('SELECT * FROM comment LEFT JOIN users ON comment.user_id = users.id WHERE game_id = ?');
	$getComment->bindValue(1, $_GET['numGame']); 
	

	if(isset($_POST['comment']) && !empty($_POST['comment'])) {

	$newComment->bindValue(':user_id', $_SESSION['user']['id']);
	$newComment->bindValue(':game_id', htmlspecialchars($_GET['numGame']));
	$newComment->bindValue(':textComment', htmlspecialchars($_POST['comment'])); 




	if($newComment->execute()) {

		echo "Votre commentaire a bien été posté."; 
	}

}
		$getComment->execute(); 
		$comments=$getComment->fetchAll();  
	// var_dump($reponse); 
	// var_dump($game); 


// 	$idg=(int)$_GET["numGame"];

// $getgames = $dbh->prepare("SELECT *, games.id AS gid FROM games
// LEFT JOIN games_type ON games.type_id=games_type.id
// LEFT JOIN developer ON games.developor_id=developer.id
// LEFT JOIN editor ON games.editor_id=editor.id WHERE games.id=?");
// $getgames->bindValue(1, $idg);
// $getgames->execute();
// $game = $getgames->fetch();

			?>
	<?php include ("headType.php"); ?>
	<?php include ("navBarType.php"); ?>

<?php //while($game=$reponse->fetch()) {

	

	//if($idG==$game['id']) { ?>



<div class="row">
	
			

		<!--  -->
	<div class="col-md-offset-1 col-md-9 detailFiche row">
		<div class="col-md-offset-1 col-md-4">

			<img src="<?php echo $game["visual"]; ?>" width="300" heigth="200"/>
		</div>
		<div class="col-md-6">

			<h2> <?php echo strtoupper($game["name"]); ?></h2>
			
				<?php if($game['genre'] == "Horreur" || $game['genre'] == "Adulte") {

						echo "Ce jeu contient du contenu innaprorié ou offensant ";

				}

				

				?> 

			<p> <?php echo returnChar($game["description"]);?>...</p>

			<p>Editeur : <?php echo $game["editor"];?></p>

			<p>Développeur : <?php echo $game["developer"];?></p>

			<p>Genre : <?php echo gameType($game["genre"]);?></p>

			<p>Date de sortie :<?php echo $game["release_date"];?></p>

			<p>Note presse :<?php echo $game["press_note"];?></p>

			<p>Note joueur :<?php echo $game["player_note"];?></p>

			<p>La moyenne est :<?php echo average($game["press_note"], $game["player_note"]) ;?></p>

			<p>Nombre de secondes écoulé depuis la date de sortie <?php echo nbDeSec($games[$_GET['numGame']]["date_de_sortie"]);?></p>

			<p><?php 

			echo "Moyenne de la communité : " .averageArray($communityNoteArray); 

			?></p>

			<p><?php echo $smileyNote ?></p>

			

		</div>
			<div class="buttonHolder">
			  <a href="#" class="button tick"></a>
			  <a href="#" class="button cross"></a>
			  <a href="#" class="button heart"></a>
			  <a href="#" class="button flower"></a>
			</div>

	</div>
</div>

<?php //} 
	//}

	if($sessionConnected) { ?>
<div class="commentDiv">
		<form method="post" action="">
			<label for="comment">Laisser un commentaire :</label>
			<br/>
			<textarea name="comment" placeholder="Votre commentaire..."></textarea>
			<br>
			<input type="submit" value="Envoyer commentaire">
		</form>
</div>

<?php } ?>
<div class="commentDiv">

	<?php foreach ($comments as $comment) {
	# code... ?>

		<div class="coment">
			<?php echo $comment['username']; ?> <br/>
			<?php echo $comment['email']; ?> : <br/>
			<?php echo $comment['dateComment']; ?>
			<hr>
			<p><?php 

			// if(isset($_POST["comment"])) {

			echo $comment['textComment']; 
		// }
			?>

		</p>

		</div>
		<?php
	} 
?>
</div>	

		<?php include ("footerType.php"); ?>





