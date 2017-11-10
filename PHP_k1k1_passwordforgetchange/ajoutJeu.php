

<?php include_once("globalPhp.php"); ?>




<?php include_once("headType.php"); ?>


<?php include_once("navBarType.php"); ?>
<?php include_once("connectPDO.php"); 

$stat=$bdd->query('SELECT * FROM games_type'); 
$gamesType=$stat->fetchAll(); 

$stat=$bdd->query('SELECT * FROM editor'); 
$gamesEditor=$stat->fetchAll(); 

$stat=$bdd->query('SELECT * FROM developer'); 
$gamesDeveloper=$stat->fetchAll(); 



$arrayFiles=array('image/png','image/gif','image/jpg','image/jpeg'); 
$visualVerif=0; 

?> 

<?php 


//include("connectPDO.php"); 

if(isset($_POST['name'])) {
	$empty=0;
	if(empty($_POST['name'])) {

		echo "Vous n'avez pas rempli le champ nom."; 
		$empty++; 
	}

	if(empty($_POST['visual']) && $_FILES['visual2']== NULL) {

		echo "Vous n'avez pas rempli le champ visual."; 
		$empty++; 
	}

	else {
		$files=file_get_contents($_POST['visual']);

		$fichier = "img/".uniqid('test_', true).'.jpg'; 



		file_put_contents($fichier, $files);
		$visualVerif=1; 

	}

	if( isset($_FILES['visual2']) && $_FILES['visual2']['error']==0 && empty($_POST["visual"])) {
		if( $_FILES['visual2']['size'] <= 5000000) {
			if(in_array($_FILES['visual2']['type'],$arrayFiles )) {
				$tmp = $_FILES['visual2']['tmp_name']; 
				$imgName ="img/" . uniqid('doc_', true) . ".png";
				move_uploaded_file($tmp, $imgName); 
				$visualVerif=2;
			} 
		}

		else {

			echo "Votre fichier est trop gros.";
		}
	}

	else {

		echo "error lors de l'upload.";
	}

	if(empty($_POST['description'])) {

		echo "Vous n'avez pas rempli le champ description."; 
		$empty++; 
	}

	if(empty($_POST['editor'])) {

		echo "Vous n'avez pas rempli le champ éditeur."; 
		$empty++; 
	}

	if(empty($_POST['developer'])) {

		echo "Vous n'avez pas rempli le champ développeur."; 
		$empty++; 
	}

	if(empty($_POST['type'])) {

		echo "Vous n'avez pas rempli le champ type."; 
		$empty++; 
	}


	if( $empty==0) {

		$req=$bdd->prepare('INSERT INTO games (name, visual, description, release_date, press_note, player_note, editor_id, developer_id, type_id ) VALUES(:name, :visual, :description, :release_date, :press_note, :player_note, :editor_id, :developer_id, :type_id)');


		$req->bindValue(':name', htmlspecialchars($_POST['name']),PDO::PARAM_STR); 
		if($visualVerif==1) 
			{//$req->bindValue(':visual', htmlspecialchars($_POST['visual']),PDO::PARAM_STR);
			$req->bindValue(':visual', htmlspecialchars($fichier),PDO::PARAM_STR);
		}

		else if($visualVerif==2) 
			{$req->bindValue(':visual', htmlspecialchars($imgName),PDO::PARAM_STR);
		}


		$req->bindValue(':description', htmlspecialchars($_POST['description']),PDO::PARAM_STR); 
		$req->bindValue(':release_date', htmlspecialchars($_POST['date']),PDO::PARAM_INT);
		$req->bindValue(':press_note', htmlspecialchars($_POST['pressNote']),PDO::PARAM_INT); 
		$req->bindValue(':player_note', htmlspecialchars($_POST['playerNote']),PDO::PARAM_INT); 
		$req->bindValue(':editor_id', htmlspecialchars($_POST['editor']),PDO::PARAM_INT); 
		$req->bindValue(':developer_id', htmlspecialchars($_POST['developer']),PDO::PARAM_INT); 
		$req->bindValue(':type_id', htmlspecialchars($_POST['type']),PDO::PARAM_INT);
		

		//var_dump($req); 
		if($req->execute()){

			echo "Good job ! Jeu ajouté.";

			logFile(date("d/m/Y H:i")."Game adding = ".$_POST['name']."\n");

			// $fileLog=fopen("addGame".date("d-m-Y").".log", 'a+');
			// fputs($fileLog, date("d/m/Y H:i")."Game adding = ".$_POST['name']."\n");
			// fclose($fileLog); 
		} 

	}
}


// if($req->execute()) {

// 	echo "Le jeu a bien été rajouté.";
// 	//$bdd->lastInsertId(); 
// }

?>









<form method="post" class="row" action="ajoutJeu.php" enctype="multipart/form-data">
	<div class="col-md-3 labelForm">
		<label for="name"> Nom du jeu :</label><br/>
		<label for="type"> Type de jeu :</label><br/>

		<label for="description"> Decription :</label><br/></br>

		<label for="editeur"> Editeur : </label><br/>

		<label for="developpeur"> Developpeur : </label><br/>

		<label for="visual"> Visuel : </label><br/><br/>

		<label for="visual2"> Visuel upload : </label><br/><br/>

		<label for="date"> Date de sortie : </label><br/>

		<label for="pressNote"> Note presse : </label><br/>

		<label for="playerNote"> Note joueur : </label><br/>






	</div>





	<div class="col-md-9">

		<input type="text" name="name" placeholder="Nom du jeu..."><br/>
		<select name="type">
			<?php foreach ($gamesType as $type) {

				?> <option value="<?php echo $type['id'];?>"><?php echo $type['genre']; ?> </option>

				<?php 
			} ?>
			

		</select><br/>
		<textarea name="description" placeholder="Entrez la description du jeu..."></textarea><br/>
			<select name="editor">
			<?php foreach ($gamesEditor as $editor) {

				?> <option value="<?php echo $editor['id'];?>"><?php echo $editor['editor']; ?> </option>

				<?php 
			} ?>
			

		</select><br/>

			<select name="developer">
			<?php foreach ($gamesDeveloper as $developer) {

				?> <option value="<?php echo $developer['id'];?>"><?php echo $developer['developer']; ?> </option>

				<?php 
			} ?>
			

		</select><br/>

		
		<input type="text" name="visual"><br/>
		<input type="file" name="visual2"><br/>
		<input type="date" name="date"><br/>

		<input type="number" name="pressNote" placeholder="Note presse"><br/>
		<input type="number" name="playerNote" placeholder="Note joueur"><br/>
		<input type="submit" value="Rajouter Jeu">



	</div>



</form>






		<?php include("footerType.php"); ?>